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
    // SIMPAN DATA BARU (FIX)
    // =====================
    public function simpan_pelanggan(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_hp'          => 'required|regex:/^[0-9]{10,13}$/',
            'alamat'         => 'required'
        ]);

        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp'          => $request->no_hp,
            'alamat'         => $request->alamat,
        ]);

        return redirect('/pelanggan')->with('success', 'Data berhasil ditambahkan');
    }

    // =====================
    // FORM UBAH
    // =====================
    public function ubah($id_pelanggan)
    {
        $pelanggan = Pelanggan::where('id_pelanggan', $id_pelanggan)->first();

        if (!$pelanggan) {
            return redirect('/pelanggan')->with('error', 'Data tidak ditemukan');
        }

        return view('ubah-pelanggan', compact('pelanggan'));
    }

    // =====================
    // SIMPAN PERUBAHAN
    // =====================
    public function simpan_ubah(Request $request, $id_pelanggan)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_hp'          => 'required|regex:/^[0-9]{10,13}$/',
            'alamat'         => 'required'
        ]);

        $pelanggan = Pelanggan::where('id_pelanggan', $id_pelanggan)->first();

        if (!$pelanggan) {
            return redirect('/pelanggan')->with('error', 'Data tidak ditemukan');
        }

        $pelanggan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp'          => $request->no_hp,
            'alamat'         => $request->alamat,
        ]);

        return redirect('/pelanggan')->with('success', 'Data berhasil diubah');
    }

    // =====================
    // HAPUS
    // =====================
    public function hapus_pelanggan($id_pelanggan)
    {
        Pelanggan::where('id_pelanggan', $id_pelanggan)->delete();
        return redirect('/pelanggan')->with('success', 'Data berhasil dihapus');
    }
}
