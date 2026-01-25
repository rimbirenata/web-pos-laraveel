<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function proses(Request $request)
    {
        // 1️⃣ Validasi form
        $request->validate([
            'keranjang' => 'required|array',
            'total_bayar' => 'required|numeric|min:1',
            'jumlah_bayar' => 'required|numeric|min:1',
        ]);

        // 2️⃣ VALIDASI UANG KURANG
        if ($request->jumlah_bayar < $request->total_bayar) {
            return back()->with('error', '❌ Uang tidak mencukupi');
        }

        DB::beginTransaction();

        try {
            // SIMPAN TRANSAKSI
            $transaksi = Transaksi::create([
                'id_pelanggan' => $request->id_pelanggan,
                'tanggal_transaksi' => now(),
                'total_bayar' => $request->total_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
                'kembalian' => $request->jumlah_bayar - $request->total_bayar,
                'total_keuntungan' => 0
            ]);

            $totalUntung = 0;

            foreach ($request->keranjang as $k) {
                $barang = Barang::find($k['id']);

                if (!$barang || $barang->stok < $k['jumlah']) {
                    throw new \Exception('Stok tidak mencukupi');
                }

                $subtotal = $barang->harga_jual * $k['jumlah'];
                $untung = ($barang->harga_jual - $barang->harga_beli) * $k['jumlah'];

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_barang' => $barang->id_barang,
                    'jumlah' => $k['jumlah'],
                    'jumlah_beli' => $k['jumlah'],
                    'harga_saat_beli' => $barang->harga_jual,
                    'subtotal' => $subtotal,
                    'keuntungan_item' => $untung
                ]);

                $barang->stok -= $k['jumlah'];
                $barang->save();

                $totalUntung += $untung;
            }

            $transaksi->update([
                'total_keuntungan' => $totalUntung
            ]);

            DB::commit();

            return view('transaksi_struk', [
                'detail' => $request->keranjang,
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
