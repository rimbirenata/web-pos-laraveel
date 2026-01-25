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
        $pelanggan = \App\Models\Pelanggan::all(); // Ambil semua pelanggan
        return view('transaksi', compact('barang','pelanggan'));
    }

    public function proses(Request $request)
    {
        // Validasi awal
        if (!$request->keranjang || count($request->keranjang) == 0) {
            return back()->with('error', 'Keranjang masih kosong');
        }

        if ($request->jumlah_bayar < $request->total_bayar) {
            return back()->withInput()->with('error', 'Uang tidak mencukupi');
        }

        DB::beginTransaction();

        try {
            $transaksi = Transaksi::create([
                'id_pelanggan' => $request->id_pelanggan,
                'tanggal_transaksi' => now(),
                'total_bayar' => $request->total_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
                'kembalian' => $request->jumlah_bayar - $request->total_bayar,
                'total_keuntungan' => 0
            ]);

            $totalKeuntungan = 0;

            foreach ($request->keranjang as $item) {
                $barang = Barang::find($item['id']);
                if (!$barang) {
                    throw new \Exception('Barang tidak ditemukan');
                }
                if ($barang->stok < $item['jumlah']) {
                    throw new \Exception("Stok barang {$barang->nama_barang} tidak mencukupi");
                }

                $subtotal = $barang->harga_jual * $item['jumlah'];
                $untung = ($barang->harga_jual - $barang->harga_beli) * $item['jumlah'];

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_barang' => $barang->id_barang,
                    'jumlah' => $item['jumlah'],
                    'jumlah_beli' => $item['jumlah'],
                    'harga_saat_beli' => $barang->harga_jual,
                    'subtotal' => $subtotal,
                    'keuntungan_item' => $untung
                ]);

                // Kurangi stok
                $barang->stok -= $item['jumlah'];
                $barang->save();

                $totalKeuntungan += $untung;
            }

            $transaksi->update(['total_keuntungan' => $totalKeuntungan]);

            DB::commit();

            // Ambil ulang data detail transaksi lengkap dari DB, relasi barang juga dimuat
            $detail = DetailTransaksi::with('barang')
                ->where('id_transaksi', $transaksi->id_transaksi)
                ->get();

            return view('transaksi_struk', [
                'detail' => $detail,
                'total' => $transaksi->total_bayar,
                'bayar' => $transaksi->jumlah_bayar,
                'kembalian' => $transaksi->kembalian,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
