<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id('id_detail_transaksi'); // HARUS ADA INI
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_barang');
            $table->integer('jumlah');
            $table->integer('harga_saat_beli');
            $table->integer('subtotal');

            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi');
            $table->foreign('id_barang')->references('id_barang')->on('barang');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_transaksi');
    }
}
