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
        return view('tambah-suplier');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama_suplier' => [
                'required',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'no_hp'  => 'required',
            'alamat' => [
                'required',
                'regex:/^[A-Za-z\s]+$/'
            ],
        ], [
            'nama_suplier.regex' => 'Nama suplier tidak boleh mengandung angka',
            'alamat.regex'      => 'Alamat tidak boleh mengandung angka',
        ]);

        Suplier::create($request->all());

        return redirect()->route('suplier.index')
            ->with('success', 'Suplier berhasil ditambahkan');
    }

    public function ubah($id)
    {
        $suplier = Suplier::findOrFail($id);
        return view('ubah-suplier', compact('suplier'));
    }

    public function simpan_ubah(Request $request, $id)
    {
        $request->validate([
            'nama_suplier' => [
                'required',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'no_hp'  => 'required',
            'alamat' => [
                'required',
                'regex:/^[A-Za-z\s]+$/'
            ],
        ], [
            'nama_suplier.regex' => 'Nama suplier tidak boleh mengandung angka',
            'alamat.regex'      => 'Alamat tidak boleh mengandung angka',
        ]);

        Suplier::findOrFail($id)->update($request->all());

        return redirect()->route('suplier.index')
            ->with('success', 'Suplier berhasil diubah');
    }

    public function hapus_suplier($id)
    {
        Suplier::findOrFail($id)->delete();

        return redirect()->route('suplier.index')
            ->with('success', 'Suplier berhasil dihapus');
    }
}
