<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Desain;
use App\Models\Dataset;
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

        return redirect()->route('ranking.index')->with('success', 'Data has been processed successfully.');
    }

    public function entropy(Request $request)
{
    $dataset = Dataset::all();

    // Convert the dataset to an array
    $dataset = $dataset->toArray();

    // Initialize arrays for jumlah_terjual, jumlah_pembeli, and omset
    $jumlahTerjuals = [];
    $jumlahPembelis = [];
    $omsets = [];

    // Loop through the dataset and populate the arrays
    foreach ($dataset as $data) {
        $jumlahTerjuals[] = $data['jumlah_terjual'];
        $jumlahPembelis[] = $data['jumlah_pembeli'];
        $omsets[] = $data['omset'];
    }

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

    // Log the results
    Log::info('Z-Score Jumlah Terjuals:', $zscoreJumlahTerjuals);
    Log::info('Z-Score Jumlah Pembelis:', $zscoreJumlahPembelis);
    Log::info('Z-Score Omsets:', $zscoreOmsets);
    Log::info('Shifted Jumlah Terjuals:', $shiftedJumlahTerjuals);
    Log::info('Shifted Jumlah Pembelis:', $shiftedJumlahPembelis);
    Log::info('Shifted Omsets:', $shiftedOmsets);
    Log::info('Entropies:', $entropies);
    Log::info('Weights:', $weights);


    // Output the results
    echo "Average Jumlah Terjuals: " . $averageJumlahTerjuals . "\n";
    echo "Average Jumlah Pembelis: " . $averageJumlahPembelis . "\n";
    echo "Average Omsets: " . $averageOmsets . "\n";
}



}
