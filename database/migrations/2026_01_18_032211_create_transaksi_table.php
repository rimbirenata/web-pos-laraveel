<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->date('tanggal');
            $table->unsignedBigInteger('id_pelanggan')->nullable();
            $table->decimal('total', 12, 2);
            $table->unsignedBigInteger('id_user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
