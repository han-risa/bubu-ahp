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
    $selectedIds = $request->input('desain_ids');

    // Log the passed data
    Log::info('Selected Desain IDs:', $selectedIds);

    if ($selectedIds) {
        // Process the selected IDs, e.g., delete or update the items
        // Desain::whereIn('id', $selectedIds)->delete(); // Example of bulk delete

        return redirect()->route('ranking.index')->with('success', 'Selected items have been inputed.');
    }

    return redirect()->route('ranking.index')->with('error', 'No items selected.');
}

}
