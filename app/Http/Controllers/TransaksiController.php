<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('transaksi', compact('barang'));
    }

    public function proses(Request $request)
    {
        if (!$request->keranjang) {
            return back()->with('error', 'Keranjang masih kosong');
        }

        DB::beginTransaction();

        try {

            // 🔥 BUAT ID TRANSAKSI YANG UNIQUE
            $idTransaksi = 'TRX-' . date('YmdHis') . rand(100,999);

            // Simpan data transaksi
            Transaksi::create([
                'id_transaksi' => $idTransaksi,
                'id_pelanggan' => $request->id_pelanggan,
                'tanggal_transaksi' => now(),
                'total_bayar' => $request->total_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
                'kembalian' => $request->jumlah_bayar - $request->total_bayar,
                'total_keuntungan' => 0
            ]);

            $totalUntung = 0;
            $detail = [];

            foreach ($request->keranjang as $k) {
                $barang = Barang::where('id_barang', $k['id'])->first();

                if (!$barang || $barang->stok < $k['jumlah']) {
                    throw new \Exception('Stok tidak mencukupi');
                }

                $subtotal = $barang->harga_jual * $k['jumlah'];
                $untung = ($barang->harga_jual - $barang->harga_beli) * $k['jumlah'];

                // ❗ INI HARUS DETAILTRANSAKSI
                DetailTransaksi::create([
                    'id_transaksi' => $idTransaksi,
                    'id_barang' => $barang->id_barang,
                    'jumlah' => $k['jumlah'],
                    'harga' => $barang->harga_jual,
                    'subtotal' => $subtotal
                ]);

                // Update stok barang
                $barang->stok -= $k['jumlah'];
                $barang->save();

                $totalUntung += $untung;

                $detail[] = [
                    'nama' => $barang->nama_barang,
                    'jumlah' => $k['jumlah'],
                    'harga' => $barang->harga_jual,
                    'subtotal' => $subtotal
                ];
            }

            // Update total keuntungan
            Transaksi::where('id_transaksi', $idTransaksi)
                ->update(['total_keuntungan' => $totalUntung]);

            DB::commit();

            // 🔥 INI BAGIAN UNTUK MENAMPILKAN STRUK
            return view('transaksi.struk', [
                'detail' => $detail,
                'total' => $request->total_bayar,
                'bayar' => $request->jumlah_bayar,
                'kembalian' => $request->jumlah_bayar - $request->total_bayar
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
