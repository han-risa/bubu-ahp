<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desain;
use App\Models\SkorBobot;
use App\Models\SkorRanking;
use App\Models\BulanRanking;
use Illuminate\Support\Facades\Log;

class RankingController extends Controller
{
    public function rankingDesain()
    {
        $desain = Desain::all();
        return view('ranking.ranking_desain', compact('desain'));
    }

    public function bulkAction(Request $request)
    {
        // Retrieve the selected IDs from the request
        $selectedIds = $request->input('desain_ids');

        // Log the passed IDs
        Log::info('Selected Desain IDs:', $selectedIds);

        if ($selectedIds) {
            // Search all matching records with the selected IDs on the Desain model
            $desain = Desain::whereIn('id', $selectedIds)->get();

            // Log the retrieved records
            Log::info('Selected Desain Records:', $desain->toArray());

            // You can now return the view and pass the $desain data to it
            return view('ranking.ranking_input', compact('desain'))->with('success', 'Selected items have been inputed.');
        }

        return redirect()->route('ranking.index')->with('error', 'No items selected.');
    }

    public function process(Request $request)
    {
        $desainData = $request->input('desain'); // This will capture the array of inputs
        $bulan = $request->input('bulan_penjualan');

        $perItemArray = []; // Array to hold data per item
        $groupedArray = [
            'ids' => [],
            'jumlah_terjuals' => [],
            'jumlah_pembelis' => [],
            'omsets' => []
        ]; // Array to hold grouped data

        foreach ($desainData as $key => $data) {
            // Prepare the per-item array to match the structure of the grouped array
            $perItemArray[] = [
                'id' => $data['id'],
                'jumlah_terjual' => $data['jumlah_terjual'],
                'jumlah_pembeli' => $data['jumlah_pembeli'],
                'omset' => $data['omset']
            ];

            // Fill the grouped array
            $groupedArray['ids'][] = $data['id'];
            $groupedArray['jumlah_terjuals'][] = $data['jumlah_terjual'];
            $groupedArray['jumlah_pembelis'][] = $data['jumlah_pembeli'];
            $groupedArray['omsets'][] = $data['omset'];
        }

        // Logging the results for verification
        Log::info('Per Item Array:', $perItemArray);
        Log::info('Grouped Array:', $groupedArray);

        // You can now use these arrays for further processing, saving to the database, etc.
        $data = new BulanRanking;
        $data->bulan_tahun = $bulan;
        $data->save();
        $insertedId = $data->id;
        // dd($insertedId);


        return redirect()->route('ranking.entropy', compact('perItemArray', 'groupedArray', 'insertedId'))->with('success', 'Data has been processed successfully.');
    }

    public function entropy(Request $request)
    {
        $dataset = $request->input('groupedArray');

        $data = $request->input('perItemArray');

        $dateId = $request->input('insertedId');

        Log::info('Request:', $data);

        // Initialize arrays for jumlah_terjual, jumlah_pembeli, and omset
        $jumlahTerjuals = [];
        $jumlahPembelis = [];
        $omsets = [];

        $jumlahTerjuals = $dataset['jumlah_terjuals'];
        $jumlahPembelis = $dataset['jumlah_pembelis'];
        $omsets = $dataset['omsets'];


        // Function to calculate the average value of an array
        function calculateAverage($array) {
            // Check if the array is empty
            if (count($array) === 0) {
                return 0;
            }

            // Calculate the average
            $sum = array_sum($array);
            $average = $sum / count($array);

            return $average;
        }

        function zscore(array $data)
        {
            // Calculate the mean
            $mean = array_sum($data) / count($data);

            // Calculate the squared differences
            $squaredDifferences = array_map(function($value) use ($mean) {
                return pow($value - $mean, 2);
            }, $data);

            // Calculate the standard deviation
            $standardDeviation = sqrt(array_sum($squaredDifferences) / (count($data) - 1));

            // Calculate the Z-Scores
            $zScores = array_map(function($value) use ($mean, $standardDeviation) {
                return ($standardDeviation != 0) ? ($value - $mean) / $standardDeviation : 0;
            }, $data);


            return $zScores;
        }

        function shiftNormalization(array $zScores)
        {
            // Find the minimum Z-Score
            $minZScore = min($zScores);
            $shiftValue = abs($minZScore) + 1;

            $shiftedScores = array_map(function($zScore) use ($shiftValue) {
                return $zScore + $shiftValue;
            }, $zScores);

            return $shiftedScores;
        }

        function calculateEntropySingle(array $data)
        {
            $n = count($data);  // Number of data points
            if ($n === 0) {
                return 0;
            }

            $k = 1 / log($n);
            $sumPLogP = 0;

            foreach ($data as $pij) {
                $sumPLogP += ($pij > 0) ? $pij * log($pij) : 0; // Avoid log(0)
            }

            $entropy = -$k * $sumPLogP;

            return $entropy;
        }

        function calculateWeight(array $entropies)
        {

            $divergence = array_map(function($e) {
                return 1 - $e;
            }, $entropies);


            $sumDivergence = array_sum($divergence);
            $weights = array_map(function($d) use ($sumDivergence) {
                return $d / $sumDivergence;
            }, $divergence);

            return $weights;
        }

        // Calculate averages for each group
        $averageJumlahTerjuals = calculateAverage($jumlahTerjuals);
        $averageJumlahPembelis = calculateAverage($jumlahPembelis);
        $averageOmsets = calculateAverage($omsets);

        // Calculate Z-Score
        $zscoreJumlahTerjuals = zscore($jumlahTerjuals);
        $zscoreJumlahPembelis = zscore($jumlahPembelis);
        $zscoreOmsets = zscore($omsets);

        // Calculate Shift Normalization
        $shiftedJumlahTerjuals = shiftNormalization($zscoreJumlahTerjuals);
        $shiftedJumlahPembelis = shiftNormalization($zscoreJumlahPembelis);
        $shiftedOmsets = shiftNormalization($zscoreOmsets);

        // Calculate Entropy
        $entropies[0] = calculateEntropySingle($shiftedJumlahTerjuals);
        $entropies[1] = calculateEntropySingle($shiftedJumlahPembelis);
        $entropies[2] = calculateEntropySingle($shiftedOmsets);

        // Calculate Weights
        $weights = calculateWeight($entropies);

        // Store the weights to SkorBobot Model
        $dataBobot = new SkorBobot;
        $dataBobot->jumlah_terjual = $weights[0];
        $dataBobot->jumlah_pembeli = $weights[1];
        $dataBobot->omset = $weights[2];
        $dataBobot->bulan_id = $dateId;
        $dataBobot->save();

        return redirect()->route('ranking.ahp', compact('weights', 'data', 'dateId'));
    }

    public function ahp(Request $request)
    {
        $alternatives = $request->input('data');
        $dateId = $request->input('dateId');
        // dd($alternatives);

        Log::info('Request:', $request->all());

        $alternativesMatrix = [
            'jumlah_terjual' => [],
            'jumlah_pembeli' => [],
            'omset' => []
        ];

        function convertJumlahTerjual($jumlah_terjual) {
            if ($jumlah_terjual < 400) return 1;
            if ($jumlah_terjual < 800) return 3;
            if ($jumlah_terjual < 1200) return 5;
            if ($jumlah_terjual < 1600) return 7;
            return 9;
        }

        function convertJumlahPembeli($jumlah_pembeli) {
            if ($jumlah_pembeli < 25) return 1;
            if ($jumlah_pembeli < 50) return 3;
            if ($jumlah_pembeli < 75) return 5;
            if ($jumlah_pembeli < 100) return 7;
            return 9;
        }

        function convertOmset($omset) {
            if ($omset < 3000000) return 1;
            if ($omset < 7000000) return 3;
            if ($omset < 11000000) return 5;
            if ($omset < 15000000) return 7;
            return 9;
        }

        foreach ($alternatives as $i => $alternative) {
            foreach ($alternatives as $j => $alt) {
                // For jumlah_terjual
                $num = convertJumlahTerjual($alternative['jumlah_terjual']);
                $den = convertJumlahTerjual($alt['jumlah_terjual']);

                if ($num > $den) {
                    $result = $num / $den;
                    $roundedResult = ceil($result);
                    $alternativesMatrix['jumlah_terjual'][$i][$j] = ($roundedResult % 2 === 0) ? $roundedResult + 1 : $roundedResult;
                } else {
                    $result = $den / $num;
                    $roundedResult = ceil($result);
                    $alternativesMatrix['jumlah_terjual'][$i][$j] = 1 / (($roundedResult % 2 === 0) ? $roundedResult + 1 : $roundedResult);
                }

                // For jumlah_pembeli
                $num = convertJumlahPembeli($alternative['jumlah_pembeli']);
                $den = convertJumlahPembeli($alt['jumlah_pembeli']);

                if ($num > $den) {
                    $result = $num / $den;
                    $roundedResult = ceil($result);
                    $alternativesMatrix['jumlah_pembeli'][$i][$j] = ($roundedResult % 2 === 0) ? $roundedResult + 1 : $roundedResult;
                } else {
                    $result = $den / $num;
                    $roundedResult = ceil($result);
                    $alternativesMatrix['jumlah_pembeli'][$i][$j] = 1 / (($roundedResult % 2 === 0) ? $roundedResult + 1 : $roundedResult);
                }

                // For omset
                $num = convertOmset($alternative['omset']);
                $den = convertOmset($alt['omset']);

                if ($num > $den) {
                    $result = $num / $den;
                    $roundedResult = ceil($result);
                    $alternativesMatrix['omset'][$i][$j] = ($roundedResult % 2 === 0) ? $roundedResult + 1 : $roundedResult;
                } else {
                    $result = $den / $num;
                    $roundedResult = ceil($result);
                    $alternativesMatrix['omset'][$i][$j] = 1 / (($roundedResult % 2 === 0) ? $roundedResult + 1 : $roundedResult);
                }
            }
        }



        // Log the resulting matrix
        Log::info('Alternatives Matrix', $alternativesMatrix);

        function normalizeMatrix($matrix)
        {
            $normalizedMatrix = [];
            $columnSums = array_fill(0, count($matrix[0]), 0); // Adjust to count columns correctly

            // Calculate the sum of each column
            foreach ($matrix as $row) {
                foreach ($row as $j => $value) {
                    $columnSums[$j] += $value;
                }
            }

            // Normalize the matrix by dividing each element by the column sum
            foreach ($matrix as $i => $row) {
                foreach ($row as $j => $value) {
                    $normalizedMatrix[$i][$j] = $value / $columnSums[$j];
                }
            }

            return $normalizedMatrix;
        }


        function calculatePriorityVector($matrix)
        {
            $priorityVector = [];

            foreach ($matrix as $row) {
                $priorityVector[] = array_sum($row) / count($row);
            }

            return $priorityVector;
        }

        // Normalize the matrices
        $normalizedAlternativesMatrix = [
            'jumlah_terjual' => normalizeMatrix($alternativesMatrix['jumlah_terjual']),
            'jumlah_pembeli' => normalizeMatrix($alternativesMatrix['jumlah_pembeli']),
            'omset' => normalizeMatrix($alternativesMatrix['omset']),
        ];

        // Calculate priority vectors
        $alternativesPriorityVectors = [
            'jumlah_terjual' => calculatePriorityVector($normalizedAlternativesMatrix['jumlah_terjual']),
            'jumlah_pembeli' => calculatePriorityVector($normalizedAlternativesMatrix['jumlah_pembeli']),
            'omset' => calculatePriorityVector($normalizedAlternativesMatrix['omset']),
        ];

        // Calculate the final scores for each alternative
        $finalScores = array_fill(0, count($alternatives), 0);

        foreach ($alternatives as $i => $alternative) {
            $finalScores[$i] = [
                'id' => $alternative['id'],
                'score' =>
                    $request->weights[0] * $alternativesPriorityVectors['jumlah_terjual'][$i] +
                    $request->weights[1] * $alternativesPriorityVectors['jumlah_pembeli'][$i] +
                    $request->weights[2] * $alternativesPriorityVectors['omset'][$i]
            ];
        }


        // Sort final scores in descending order while maintaining their original indexes
        // dd($finalScores);
        arsort($finalScores);
        // dd($finalScores);

        // Get nama_desain from Dataset Model
        foreach ($finalScores as $item) {
            $desainName = Desain::find($item['id'])->nama_desain;
            $desainNames[] = $desainName;
        }

        // Combine $desain, $finalScores, and $rankedScores into one array
        $rankedData = [];
        $rank = 1;

        foreach ($finalScores as $i => $score) {
            $rankedData[] = [
                'nama_desain' => $desainNames[$i],
                'final_score' => $score['score'],
                'rank' => $rank
            ];

            $rankData = new SkorRanking;
            $rankData->desain_id = $score['id'];
            $rankData->bulan_id = $dateId;
            $rankData->skor_ranking = $score['score'];
            $rankData->posisi_ranking = $rank++;
            $rankData->save();
        }

        return view('ranking.ranking_hasil', compact('rankedData'));
    }

    public function riwayat(Request $request)
    {
        // Get all SkorRanking data and group by bulan_id
        $groupedData = SkorRanking::with(['desain', 'bulan'])->get()->groupBy('bulan_id');
        // dd($groupedData);

        return view('ranking.ranking_history', compact('groupedData'));
    }
}
