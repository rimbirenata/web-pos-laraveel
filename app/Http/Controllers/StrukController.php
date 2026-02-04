<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class StrukController extends Controller
{
    public function cetak(Request $request, $id_transaksi)
    {

        // Ambil data transaksi total
        $transaksi = DB::table('transaksi')
            ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->join('barang', 'barang.id_barang', '=', 'detail_transaksi.id_barang')
            ->where('transaksi.id_transaksi', $id_transaksi)
            ->select(
                'transaksi.id_transaksi',
                'transaksi.tanggal_transaksi',
                DB::raw('SUM(detail_transaksi.jumlah * barang.harga_jual) as total_bayar'),
                DB::raw('SUM((barang.harga_jual - barang.harga_modal) * detail_transaksi.jumlah) as total_keuntungan')
            )
            ->groupBy('transaksi.id_transaksi', 'transaksi.tanggal_transaksi')
            ->first();

        // Ambil detail per item
        $detail = DB::table('detail_transaksi')
            ->join('barang', 'barang.id_barang', '=', 'detail_transaksi.id_barang')
            ->where('detail_transaksi.id_transaksi', $id_transaksi)
            ->select('barang.nama_barang', 'barang.harga_jual', 'detail_transaksi.jumlah')
            ->get();

        // ===============================
        // Hitung kembalian
        // Jika tidak dikirim lewat request, default = total bayar
        // ===============================
        $uangDibayar = $request->input('uang_bayar', $transaksi->total_bayar);
        $kembalian = $uangDibayar - $transaksi->total_bayar;

        $kasir = Auth::check() ? Auth::user()->name : 'Kasir';

        return view('struk.cetak', compact('transaksi', 'detail', 'uangDibayar', 'kembalian','kasir'));
    }
}
