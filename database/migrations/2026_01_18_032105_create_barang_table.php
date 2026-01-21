<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       Schema::create('barang', function (Blueprint $table) {
    $table->id('id_barang');
    $table->string('nama_barang');
    $table->unsignedBigInteger('id_kategori');
    $table->unsignedBigInteger('id_suplier');
    $table->integer('stok');
    $table->integer('harga_beli');
    $table->integer('harga_jual');
    $table->timestamps();

    $table->foreign('id_kategori')
          ->references('id_kategori')
          ->on('kategori')
          ->onDelete('restrict');

    $table->foreign('id_suplier')
          ->references('id_suplier')
          ->on('suplier')
          ->onDelete('restrict');
});
    }
};
