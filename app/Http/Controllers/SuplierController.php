<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suplier;

class SuplierController extends Controller
{
    public function index()
    {
        $suplier = Suplier::all();
        return view('suplier', compact('suplier'));
    }

    public function create()
    {
        return view('tambah-suplier');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        Suplier::create($request->all());

        return redirect('/suplier')->with('success', 'Data suplier berhasil ditambahkan');
    }

    public function ubah($id)
    {
        $suplier = Suplier::findOrFail($id);
        return view('ubah-suplier', compact('suplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        $suplier = Suplier::findOrFail($id);
        $suplier->update($request->all());

        return redirect('/suplier')->with('success', 'Data suplier berhasil diubah');
    }

    public function destroy($id)
    {
        Suplier::findOrFail($id)->delete();
        return redirect('/suplier')->with('success', 'Data suplier berhasil dihapus');
    }
}
