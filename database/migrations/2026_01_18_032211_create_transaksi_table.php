<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
      Schema::create('transaksi', function (Blueprint $table) {
    $table->id('id_transaksi');
    $table->unsignedBigInteger('id_pelanggan')->nullable();
    $table->dateTime('tanggal_transaksi');
    $table->integer('total_bayar');
    $table->integer('jumlah_bayar');
    $table->integer('kembalian');
    $table->integer('total_keuntungan')->default(0);
    $table->string('kasir'); // ⬅️ PENTING
});
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
