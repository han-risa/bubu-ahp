<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Desain;

class RankingController extends Controller
{
    public function rankingDesain()
    {
        $desain = Desain::all();
        return view('ranking.ranking_desain', compact('desain'));
    }
}
