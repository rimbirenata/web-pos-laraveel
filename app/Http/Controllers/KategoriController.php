<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // Tampilkan semua kategori
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori', compact('kategori'));
    }

    // Form tambah kategori
    public function form_tambah_kategori()
    {
        return view('tambah-kategori');
    }

    // Simpan kategori baru dengan validasi
    public function simpan_kategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi'
        ]);

        Kategori::create($request->all());

        return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Form ubah kategori
    public function ubah($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('ubah-kategori', compact('kategori'));
    }

    // Simpan perubahan kategori dengan validasi
    public function simpan_ubah(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect('/kategori')->with('success', 'Kategori berhasil diubah!');
    }

    // Hapus kategori
    public function hapus_kategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect('/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
