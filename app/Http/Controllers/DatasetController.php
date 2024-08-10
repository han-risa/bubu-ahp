<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Desain;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    //
    public function index()
    {
        $data = Dataset::all();
        return view('dataset', compact('data'));
    }
    public function getAllData(Request $request)
    {
        $data = Dataset::all();
        return $data;
    }

    public function create()
    {
        $data = Desain::all();
        return view('dataset_create', compact('data'));
    }
}
