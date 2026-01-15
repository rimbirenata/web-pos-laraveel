<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    public function index()
    {
        $suplier = Suplier::all();
        return view('suplier', compact('suplier'));
    }

    public function tambah_suplier()
    {
        return view('tambah-suplier');
    }

    public function simpan_suplier(Request $request)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'no_hp'        => 'required',
            'alamat'       => 'required',
        ]);

        Suplier::create([
            'nama_suplier' => $request->nama_suplier,
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
        ]);

        return redirect('/suplier')->with('success', 'Data berhasil ditambahkan');
    }

    public function ubah($id_suplier)
    {
        $suplier = Suplier::findOrFail($id_suplier);
        return view('ubah-suplier', compact('suplier'));
    }

    public function simpan_ubah(Request $request, $id_suplier)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'no_hp'        => 'required',
            'alamat'       => 'required',
        ]);

        $suplier = Suplier::findOrFail($id_suplier);
        $suplier->update($request->only('nama_suplier','no_hp','alamat'));

        return redirect('/suplier')->with('success', 'Data berhasil diubah');
    }

    public function hapus_suplier($id_suplier)
    {
        Suplier::findOrFail($id_suplier)->delete();
        return redirect('/suplier')->with('success', 'Data berhasil dihapus');
    }
}
