<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
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
}
