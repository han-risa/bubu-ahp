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
        return view('dataset_add', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'desain' => 'required',
            'terjual' => 'required',
            'pembeli' => 'required',
            'bulan' => 'required',
        ]);

        $data = new Dataset;
        $data->desain = $request->desain;
        $data->harga = $request->terjual;
        $data->stok = $request->pemmbeli;
        $data->bulan = $request->bulan;
        $data->save();

        return redirect()->route('dataset');
    }

    public function edit($id)
    {
        $data = Dataset::find($id);
        $desain = Desain::all();
        return view('dataset_edit', compact('data', 'desain'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'desain_id' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'required',
        ]);

        $data = Dataset::find($id);
        $data->nama = $request->nama;
        $data->desain_id = $request->desain_id;
        $data->harga = $request->harga;
        $data->stok = $request->stok;
        $data->gambar = $request->gambar;
        $data->save();

        return redirect()->route('dataset');
    }

    public function destroy($id)
    {
        $data = Dataset::find($id);
        $data->delete();

        return redirect()->route('dataset');
    }

    public function show($id)
    {
        // $data = Dataset::find($id);
        // return view('dataset_show', compact('data'));
    }

    public function search(Request $request)
    {
        $data = Dataset::where('nama', 'like', "%$request->nama%")->get();
        return view('dataset', compact('data'));
    }

    public function filter(Request $request)
    {
        $data = Dataset::where('harga', '>=', $request->harga)->get();
        return view('dataset', compact('data'));
    }



}
