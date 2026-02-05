<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('barang')->get();
        return view('kategori', compact('kategori'));
    }

    public function form_tambah_kategori()
    {
        return view('tambah-kategori');
    }

    public function simpan_kategori(Request $request)
    {
        $request->validate(
            [
                'nama_kategori' => ['required', 'regex:/^[A-Za-z\s]+$/']
            ],
            [
                'nama_kategori.required' => 'Nama kategori wajib diisi',
                'nama_kategori.regex' => 'Nama kategori tidak boleh mengandung angka atau simbol'
            ]
        );

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function ubah($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('ubah-kategori', compact('kategori'));
    }

    public function simpan_ubah(Request $request, $id)
    {
        $request->validate(
            [
                'nama_kategori' => ['required', 'regex:/^[A-Za-z\s]+$/']
            ]
        );

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil diubah');
    }

    // 🔐 INI INTINYA
    public function hapus_kategori($id)
    {
        $kategori = Kategori::findOrFail($id);

        // CEK MASIH DIPAKAI BARANG ATAU TIDAK
        if ($kategori->barang()->count() > 0) {
            return redirect('/kategori')
                ->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh barang');
        }

        $kategori->delete();

        return redirect('/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
