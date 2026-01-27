<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        $pelanggan = Pelanggan::all();

        return view('transaksi', compact('barang', 'pelanggan'));
    }

    public function proses(Request $request)
    {
        DB::beginTransaction();

        try {
            $transaksi = Transaksi::create([
                'id_pelanggan' => $request->id_pelanggan,
                'tanggal_transaksi' => now(),
                'total_bayar' => $request->total_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
                'kembalian' => $request->jumlah_bayar - $request->total_bayar,
                'total_keuntungan' => 0,
            ]);

            foreach ($request->keranjang as $item) {
                $barang = Barang::findOrFail($item['id']);

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_barang' => $barang->id_barang,
                    'jumlah' => $item['jumlah'],
                    'harga_saat_beli' => $barang->harga_jual,
                    'subtotal' => $barang->harga_jual * $item['jumlah']
                ]);

                $barang->stok -= $item['jumlah'];
                $barang->save();
            }

            DB::commit();

            $detail = DetailTransaksi::with('barang')
                ->where('id_transaksi', $transaksi->id_transaksi)
                ->get();

            return view('transaksi_struk', [
                'detail' => $detail,
                'total' => $transaksi->total_bayar,
                'bayar' => $transaksi->jumlah_bayar,
                'kembalian' => $transaksi->kembalian,
                'kasir' => Auth::check() ? Auth::user()->name : '-'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
