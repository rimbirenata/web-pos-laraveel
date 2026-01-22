<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHargaToDetailTransaksiTable extends Migration
{
    public function up()
    {
        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->integer('harga')->after('jumlah');
        });
    }

    public function down()
    {
        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->dropColumn('harga');
        });
    }
}
