<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Menampilkan halaman transaksi dengan data barang
    public function index()
    {
        return view('transaksi', [
            'barang' => Barang::all()
        ]);
    }

    // ✨ Hanya satu method proses() yang sudah diperbaiki
    public function proses(Request $request)
    {
        // validasi keranjang
        if (!$request->keranjang || count($request->keranjang) == 0) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        $totalBayar = $request->total_bayar;
        $jumlahBayar = $request->jumlah_bayar;

        // cek apakah jumlah bayar cukup
        if ($jumlahBayar < $totalBayar) {
            return back()->with('error', 'Uang Anda kurang! Silakan isi jumlah bayar yang cukup.');
        }

        DB::beginTransaction();

        try {
            $kembalian = $jumlahBayar - $totalBayar;

            // simpan transaksi utama
            $idTransaksi = DB::table('transaksi')->insertGetId([
                'id_pelanggan' => $request->id_pelanggan ?: null,
                'tanggal_transaksi' => now(),
                'total_bayar' => $totalBayar,
                'jumlah_bayar' => $jumlahBayar,
                'kembalian' => $kembalian,
                'total_keuntungan' => 0
            ]);

            $totalUntung = 0;
            $detail = [];

            foreach ($request->keranjang as $k) {
                $barang = Barang::find($k['id']);
                $jumlah = $k['jumlah'] ?? 1;
                $subtotal = $barang->harga_jual * $jumlah;
                $untung = ($barang->harga_jual - $barang->harga_beli) * $jumlah;

                DB::table('detail_transaksi')->insert([
                    'id_transaksi' => $idTransaksi,
                    'id_barang' => $barang->id_barang,
                    'jumlah' => $jumlah,
                    'jumlah_beli' => $jumlah,
                    'harga_saat_beli' => $barang->harga_jual,
                    'subtotal' => $subtotal,
                    'keuntungan_item' => $untung
                ]);

                // kurangi stok
                $barang->stok -= $jumlah;
                $barang->save();

                $totalUntung += $untung;

                $detail[] = [
                    'nama' => $barang->nama_barang,
                    'harga' => $barang->harga_jual,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal
                ];
            }

            // update total keuntungan
            DB::table('transaksi')
                ->where('id_transaksi', $idTransaksi)
                ->update(['total_keuntungan' => $totalUntung]);

            DB::commit();

            // tampilkan struk
            return view('transaksi_struk', [
                'detail' => $detail,
                'total' => $totalBayar,
                'bayar' => $jumlahBayar,
                'kembalian' => $kembalian
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
