<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // =====================
    // TAMPIL DATA
    // =====================
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan', compact('pelanggan'));
    }

    // =====================
    // FORM TAMBAH
    // =====================
    public function form_tambah_pelanggan()
    {
        return view('tambah-pelanggan');
    }

    // =====================
    // SIMPAN DATA BARU
    // =====================
    public function simpan_pelanggan(Request $request)
    {
        $request->validate(
            [
                'id_pelanggan'   => 'required|numeric|unique:pelanggan,id_pelanggan',
                'nama_pelanggan' => 'required|string',
                'no_hp'          => 'required|regex:/^[0-9]{10,13}$/',
                'alamat'         => 'required'
            ],
            [
                'id_pelanggan.required' => 'ID Pelanggan wajib diisi',
                'id_pelanggan.numeric'  => 'ID Pelanggan hanya boleh angka (tidak boleh huruf atau simbol)',
                'id_pelanggan.unique'   => 'ID Pelanggan sudah digunakan',

                'nama_pelanggan.required' => 'Nama Pelanggan wajib diisi',

                'no_hp.required' => 'Nomor HP wajib diisi',
                'no_hp.regex'    => 'Nomor HP harus berupa angka 10–13 digit',

                'alamat.required' => 'Alamat wajib diisi'
            ]
        );

        Pelanggan::create([
            'id_pelanggan'   => $request->id_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp'          => $request->no_hp,
            'alamat'         => $request->alamat,
        ]);

        return redirect('/pelanggan')
            ->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    // =====================
    // FORM UBAH
    // =====================
    public function ubah($id_pelanggan)
    {
        $pelanggan = Pelanggan::findOrFail($id_pelanggan);
        return view('ubah-pelanggan', compact('pelanggan'));
    }

    // =====================
    // SIMPAN PERUBAHAN
    // =====================
   public function simpan_ubah(Request $request, $id)
{
    $request->validate(
        [
            'nama_pelanggan' => [
                'required',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'no_hp' => [
                'required',
                'regex:/^[0-9]+$/'
            ],
            'alamat' => [
                'required',
                'regex:/^[A-Za-z\s]+$/'
            ],
        ],
        [
            'nama_pelanggan.required' =>
                'Nama pelanggan wajib diisi',
            'nama_pelanggan.regex' =>
                'Nama pelanggan tidak boleh mengandung angka atau tanda ? ! . , ;',

            'no_hp.required' =>
                'No HP wajib diisi',
            'no_hp.regex' =>
                'No HP harus berupa angka',

            'alamat.required' =>
                'Alamat wajib diisi',
            'alamat.regex' =>
                'Alamat tidak boleh mengandung angka atau tanda ? ! . , ;',
        ]
    );

    $pelanggan = Pelanggan::findOrFail($id);
    $pelanggan->update([
        'nama_pelanggan' => $request->nama_pelanggan,
        'no_hp' => $request->no_hp,
        'alamat' => $request->alamat,
    ]);

    return redirect('/pelanggan')
        ->with('success', 'Data pelanggan berhasil diubah');
}

}
