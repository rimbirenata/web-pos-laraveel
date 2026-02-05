<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StrukController extends Controller
{
    public function cetak($id_transaksi)
    {
        $transaksi = DB::table('transaksi')
            ->where('id_transaksi', $id_transaksi)
            ->first();

        if (!$transaksi) {
            abort(404);
        }

        $detail = DB::table('detail_transaksi')
            ->join('barang', 'barang.id_barang', '=', 'detail_transaksi.id_barang')
            ->where('detail_transaksi.id_transaksi', $id_transaksi)
            ->select(
                'barang.nama_barang',
                'detail_transaksi.jumlah',
                'detail_transaksi.harga_saat_beli',
                'detail_transaksi.subtotal'
            )
            ->get();

        return view('struk.cetak', compact('transaksi', 'detail'));
    }
}
