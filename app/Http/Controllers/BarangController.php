<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Suplier;
use Illuminate\Http\Request;

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

    public function simpan(Request $request)
    {
        $request->validate([
            'nama_barang' => [
                'required',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'id_kategori' => 'required',
            'id_suplier'  => 'required',
            'stok'        => 'required|numeric',
            'harga_beli'  => 'required|numeric',
            'harga_jual'  => 'required|numeric',
        ], [
            'nama_barang.regex' =>
                'Tidak boleh angka dan tanda titik koma seru tanya dan slash'
        ]);

        Barang::create($request->all());
        return redirect()->route('barang-index');
    }

    public function edit($id_barang)
    {
        return view('ubah-barang', [
            'barang'   => Barang::findOrFail($id_barang),
            'kategori' => Kategori::all(),
            'suplier'  => Suplier::all()
        ]);
    }

    public function update(Request $request, $id_barang)
    {
        $request->validate([
            'nama_barang' => [
                'required',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'id_kategori' => 'required',
            'id_suplier'  => 'required',
            'stok'        => 'required|numeric',
            'harga_beli'  => 'required|numeric',
            'harga_jual'  => 'required|numeric',
        ], [
            'nama_barang.regex' =>
                'Tidak boleh angka dan tanda titik koma seru tanya dan slash'
        ]);

        Barang::findOrFail($id_barang)->update($request->all());
        return redirect()->route('barang-index');
    }

    public function hapus($id_barang)
    {
        Barang::findOrFail($id_barang)->delete();
        return redirect()->route('barang-index');
    }
}
