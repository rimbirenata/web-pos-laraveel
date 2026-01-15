<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Suplier;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with(['kategori', 'suplier'])->get();
        return view('data-barang', compact('barang'));
    }

    public function tambah()
    {
        $kategori = Kategori::all();
        $suplier  = Suplier::all();
        return view('tambah-barang', compact('kategori','suplier'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'id_barang'   => 'required|unique:barang,id_barang',
            'nama_barang' => 'required',
            'id_kategori' => 'required',
            'id_suplier'  => 'required',
            'stok'        => 'required|integer|min:0',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|gte:harga_beli',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil disimpan');
    }

    public function ubah($id_barang)
    {
        $barang   = Barang::findOrFail($id_barang);
        $kategori = Kategori::all();
        $suplier  = Suplier::all();
        return view('ubah-barang', compact('barang','kategori','suplier'));
    }

    public function simpan_ubah(Request $request, $id_barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'id_kategori' => 'required',
            'id_suplier'  => 'required',
            'stok'        => 'required|integer|min:0',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|gte:harga_beli',
        ]);

        $barang = Barang::findOrFail($id_barang);
        $barang->update($request->all());

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diubah');
    }

    public function hapus($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}
