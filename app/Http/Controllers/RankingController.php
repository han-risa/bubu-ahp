<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Desain;
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

}
