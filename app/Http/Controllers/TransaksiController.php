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
        // ===============================
        // 1️⃣ VALIDASI AWAL
        // ===============================
        if (!$request->keranjang || count($request->keranjang) == 0) {
            return back()->with('error', '❌ Keranjang masih kosong');
        }

        if ($request->jumlah_bayar < $request->total_bayar) {
            return back()
                ->withInput()
                ->with('error', '❌ Uang tidak mencukupi');
        }

        DB::beginTransaction();

        try {
            // ===============================
            // 2️⃣ SIMPAN TRANSAKSI
            // ===============================
            $transaksi = Transaksi::create([
                'id_pelanggan'        => $request->id_pelanggan,
                'tanggal_transaksi'   => now(),
                'total_bayar'         => $request->total_bayar,
                'jumlah_bayar'        => $request->jumlah_bayar,
                'kembalian'           => $request->jumlah_bayar - $request->total_bayar,
                'total_keuntungan'    => 0
            ]);

            $totalUntung = 0;
            $detail = [];

            // ===============================
            // 3️⃣ LOOP KERANJANG
            // ===============================
            foreach ($request->keranjang as $k) {
                $barang = Barang::find($k['id']);

                if (!$barang) {
                    throw new \Exception('Barang tidak ditemukan');
                }

                if ($barang->stok < $k['jumlah']) {
                    throw new \Exception('❌ Stok '.$barang->nama_barang.' tidak mencukupi');
                }

                $subtotal = $barang->harga_jual * $k['jumlah'];
                $untung   = ($barang->harga_jual - $barang->harga_beli) * $k['jumlah'];

                DetailTransaksi::create([
                    'id_transaksi'    => $transaksi->id_transaksi,
                    'id_barang'       => $barang->id_barang,
                    'jumlah'          => $k['jumlah'],
                    'jumlah_beli'     => $k['jumlah'],
                    'harga_saat_beli' => $barang->harga_jual,
                    'subtotal'        => $subtotal,
                    'keuntungan_item' => $untung
                ]);

                // Kurangi stok
                $barang->stok -= $k['jumlah'];
                $barang->save();

                $totalUntung += $untung;

                $detail[] = [
                    'nama'     => $barang->nama_barang,
                    'jumlah'   => $k['jumlah'],
                    'harga'    => $barang->harga_jual,
                    'subtotal' => $subtotal
                ];
            }

            // ===============================
            // 4️⃣ UPDATE TOTAL KEUNTUNGAN
            // ===============================
            $transaksi->update([
                'total_keuntungan' => $totalUntung
            ]);

            DB::commit();

            // ===============================
            // 5️⃣ TAMPIL STRUK
            // ===============================
            return view('transaksi_struk', [
                'detail'     => $detail,
                'total'      => $request->total_bayar,
                'bayar'      => $request->jumlah_bayar,
                'kembalian'  => $request->jumlah_bayar - $request->total_bayar
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
