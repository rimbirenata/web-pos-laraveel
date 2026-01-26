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
                'regex:/^[^0-9.;!?\/]+$/'
            ],
            'no_hp'  => 'required',
            'alamat' => [
                'required',
                'regex:/^[^0-9.;!?\/]+$/'
            ],
        ], [
            'nama_suplier.regex' => 'Nama suplier tidak boleh mengandung angka, titik koma, tanda seru, tanda tanya atau slash',
            'alamat.regex'      => 'Alamat tidak boleh mengandung angka, titik koma, tanda seru, tanda tanya atau slash',
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
            'regex:/^[^0-9,\.!?\/]+$/'
        ],
        'no_hp' => [
            'required',
            'regex:/^[0-9]+$/'
        ],
        'alamat' => [
            'required',
            'regex:/^[^0-9,\.!?\/]+$/'
        ],
    ], [
        'nama_suplier.regex' => 'Nama suplier tidak boleh mengandung angka, koma, titik, tanda tanya, tanda seru, atau slash',
        'no_hp.regex' => 'Nomor HP harus berupa angka saja, tanpa huruf atau simbol',
        'alamat.regex' => 'Alamat tidak boleh mengandung angka, koma, titik, tanda tanya, tanda seru, atau slash',
    ]);

    Suplier::findOrFail($id)->update($request->all());

    return redirect()->route('suplier.index')
        ->with('success', 'Suplier berhasil diubah');
}

}
