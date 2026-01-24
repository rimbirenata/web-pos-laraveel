<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

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
        return view('pelanggan-tambah',compact('pelanggan'));
    }

    // =====================
    // SIMPAN DATA BARU
    // =====================
    public function simpan_pelanggan(Request $request)
    {
        $request->validate(
            [
                'id_pelanggan'   => 'required|unique:pelanggan,id_pelanggan',
                'nama_pelanggan' => [
                    'required',
                    'regex:/^[A-Za-z\s]+$/'
                ],
                'no_hp'          => 'required|numeric',
                'alamat'         => 'required'
            ],
            [
                'nama_pelanggan.regex' =>
                'Nama pelanggan tidak boleh mengandung angka atau simbol (/, . , ! ?)'
            ]
        );

        Pelanggan::create($request->all());

        return redirect('/pelanggan')->with('success','Data berhasil disimpan');
    }

    // =====================
    // FORM UBAH
    // =====================
    public function ubah($id_pelanggan)
    {
        $pelanggan = Pelanggan::findOrFail($id_pelanggan);
        return view('pelanggan.ubah', compact('pelanggan'));
    }

    // =====================
    // SIMPAN UBAH
    // =====================
    public function simpan_ubah(Request $request, $id_pelanggan)
    {
        $request->validate(
            [
                'nama_pelanggan' => [
                    'required',
                    'regex:/^[A-Za-z\s]+$/'
                ],
                'no_hp'  => 'required|numeric',
                'alamat' => 'required'
            ],
            [
                'nama_pelanggan.regex' =>
                'Nama pelanggan tidak boleh mengandung angka atau simbol (/, . , ! ?)'
            ]
        );

        Pelanggan::where('id_pelanggan', $id_pelanggan)
            ->update($request->only(['nama_pelanggan','no_hp','alamat']));

        return redirect('/pelanggan')->with('success','Data berhasil diubah');
    }

    // =====================
    // HAPUS
    // =====================
    public function hapus_pelanggan($id_pelanggan)
    {
        Pelanggan::where('id_pelanggan', $id_pelanggan)->delete();
        return redirect('/pelanggan')->with('success','Data berhasil dihapus');
    }
}
