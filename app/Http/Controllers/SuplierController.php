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

    public function hapus_suplier($id)
    {
        Suplier::findOrFail($id)->delete();

        return redirect()->route('suplier.index')
            ->with('success', 'Data suplier berhasil dihapus');
    }

    public function tambah()
    {
        return view('tambah-suplier');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'no_hp'        => 'required',
            'alamat'       => 'required',
        ]);

        Suplier::create($request->all());

        return redirect()->route('suplier.index');
    }

    public function ubah($id)
    {
        $suplier = Suplier::findOrFail($id);
        return view('ubah-suplier', compact('suplier'));
    }

    public function simpan_ubah(Request $request, $id)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'no_hp'        => 'required',
            'alamat'       => 'required',
        ]);

        Suplier::findOrFail($id)->update($request->all());

        return redirect()->route('suplier.index');
    }
}
