<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desain;

class DesainController extends Controller
{
    public function index()
    {
        $data = Desain::all();
        return view('desain', compact('data'));
    }
    public function getAllData(Request $request)
    {
        $data = Desain::all();
        return $data;
    }

    public function add()
    {
        return view('desain_create');
    }
}
