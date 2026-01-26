<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
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
                'nama_kategori' => [
                    'required',
                    'regex:/^[A-Za-z\s]+$/'
                ]
            ],
            [
                'nama_kategori.required' =>
                    'Nama kategori wajib diisi',
                'nama_kategori.regex' =>
                    'Nama kategori tidak boleh mengandung angka atau tanda ? , . ! /'
            ]
        );

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/kategori')
            ->with('success', 'Kategori berhasil ditambahkan');
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
                'nama_kategori' => [
                    'required',
                    'regex:/^[A-Za-z\s]+$/'
                ]
            ],
            [
                'nama_kategori.required' =>
                    'Nama kategori wajib diisi',
                'nama_kategori.regex' =>
                    'Nama kategori tidak boleh mengandung angka atau tanda ? , . ! /'
            ]
        );

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/kategori')
            ->with('success', 'Kategori berhasil diubah');
    }

    public function hapus_kategori($id)
    {
        Kategori::findOrFail($id)->delete();

        return redirect('/kategori')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
