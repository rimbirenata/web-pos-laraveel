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
        $barang = Barang::with(['kategori','suplier'])->get();
        return view('data-barang', compact('barang'));
    }

    public function tambah()
    {
        return view('tambah-barang', [
            'kategori' => Kategori::all(),
            'suplier'  => Suplier::all()
        ]);
    }

    // SIMPAN
    public function simpan(Request $request)
{
    $request->validate([
        'nama_barang' => 'required',
        'id_kategori' => 'required',
        'id_suplier'  => 'nullable',
        'stok'        => 'required|integer|min:0',
        'harga_beli'  => 'required|numeric|min:0',
        'harga_jual'  => 'required|numeric|gte:harga_beli',
    ]);

    $suplier = Suplier::find($request->id_suplier);

    Barang::create([
        'nama_barang'  => $request->nama_barang,
        'id_kategori'  => $request->id_kategori,
        'id_suplier'   => $suplier?->id_suplier,
        'nama_suplier' => $suplier?->nama_suplier, // 🔥 PENTING
        'stok'         => $request->stok,
        'harga_beli'   => $request->harga_beli,
        'harga_jual'   => $request->harga_jual,
    ]);

    return redirect()->route('barang.index')
        ->with('success', 'Barang berhasil disimpan');
}


    public function ubah($id_barang)
    {
        return view('ubah-barang', [
            'barang'   => Barang::findOrFail($id_barang),
            'kategori' => Kategori::all(),
            'suplier'  => Suplier::all()
        ]);
    }

    // SIMPAN UBAH
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

        Barang::findOrFail($id_barang)->update([
            'nama_barang' => $request->nama_barang,
            'id_kategori' => $request->id_kategori,
            'id_suplier'  => $request->id_suplier,
            'stok'        => $request->stok,
            'harga_beli'  => $request->harga_beli,
            'harga_jual'  => $request->harga_jual,
        ]);

        return redirect()->route('barang.index')
            ->with('success','Barang berhasil diubah');
    }

    public function hapus($id_barang)
    {
        Barang::findOrFail($id_barang)->delete();

        return redirect()->route('barang.index')
            ->with('success','Barang berhasil dihapus');
    }
}
