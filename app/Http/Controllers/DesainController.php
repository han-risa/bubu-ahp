<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desain;

class DesainController extends Controller
{
    public function index()
    {
        $data = Desain::all();
        return view('desain.desain', compact('data'));
    }
    public function getAllData(Request $request)
    {
        $data = Desain::all();
        return $data;
    }

    public function create()
    {
        return view('desain.desain_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_desain' => 'required',
        ]);

        $data = new Desain;
        $data->nama_desain = $request->nama_desain;
        $data->save();

        return redirect()->route('desain.index');
    }

    public function edit($id)
    {
        $data = Desain::find($id);
        return view('desain.desain_edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_desain' => 'required',
        ]);

        $data = Desain::find($id);
        $data->nama_desain = $request->nama_desain;
        $data->save();

        return redirect()->route('desain.index');
    }

    public function destroy($id)
    {
        $data = Desain::find($id);
        $data->delete();

        return redirect()->route('desain.index');
    }

    // public function show($id)
    // {
    //     $data = Desain::find($id);
    //     return view('desain.desain_show', compact('data'));
    // }

}
