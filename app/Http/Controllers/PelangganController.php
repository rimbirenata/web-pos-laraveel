<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
     public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan', compact('pelanggan'));
    }

    public function form_tambah_pelanggan()
    {
        return view('tambah-pelanggan');
    }

    public function simpan_pelanggan(Request $request)
    {
        $request->validate([
            'id_pelanggan'   => 'required|unique:pelanggan,id_pelanggan',
            'nama_pelanggan' => 'required',
            'no_hp'          => 'required|numeric',
            'alamat'         => 'required',
        ],[
            'required' => ':attribute wajib diisi',
            'numeric'  => ':attribute harus berupa angka',
            'unique'   => ':attribute sudah digunakan',
        ]);

        Pelanggan::create($request->all());
        return redirect('/pelanggan')->with('success','Data berhasil disimpan');
    }

    public function ubah($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('ubah-pelanggan', compact('pelanggan'));
    }

    public function simpan_ubah(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_hp'          => 'required|numeric',
            'alamat'         => 'required',
        ],[
            'required' => ':attribute wajib diisi',
            'numeric'  => ':attribute harus berupa angka',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect('/pelanggan')->with('success','Data berhasil diubah');
    }

    public function hapus_pelanggan($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect('/pelanggan')->with('success','Data berhasil dihapus');
    }

    // ✨ Tambahkan method cari di bawah ini
    public function cari($hp)
    {
        $pelanggan = Pelanggan::where('no_hp', $hp)->first();
        return response()->json($pelanggan ? $pelanggan : null);
    }
}

