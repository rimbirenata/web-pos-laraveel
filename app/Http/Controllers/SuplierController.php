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

    public function tambah()
    {
        return view('suplier_tambah');
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'nama_suplier' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        Suplier::create($data);

        return redirect('/suplier')
            ->with('success', 'Suplier berhasil ditambahkan');
    }

    public function ubah($id_suplier)
    {
        $suplier = Suplier::findOrFail($id_suplier);
        return view('suplier_ubah', compact('suplier'));
    }

    public function simpan_ubah(Request $request, $id_suplier)
    {
        $data = $request->validate([
            'nama_suplier' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        Suplier::findOrFail($id_suplier)->update($data);

        return redirect('/suplier')
            ->with('success', 'Suplier berhasil diubah');
    }

    public function hapus_suplier($id_suplier)
    {
        Suplier::findOrFail($id_suplier)->delete();

        return redirect('/suplier')
            ->with('success', 'Suplier berhasil dihapus');
    }
}
