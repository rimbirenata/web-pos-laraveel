<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StrukController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// =====================
// LOGIN
// =====================
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'proses_login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// =====================
// SEMUA YANG WAJIB LOGIN
// =====================
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [HalamanController::class, 'dashboard'])
        ->name('dashboard');

    // =====================
    // BARANG
    // =====================
    Route::get('/barang', [BarangController::class, 'index'])
    ->name('barang');

Route::get('/barang/tambah', [BarangController::class, 'tambah'])
    ->name('barang-tambah');

Route::post('/barang/simpan', [BarangController::class, 'simpan'])
    ->name('barang-simpan');

Route::get('/barang/edit/{id_barang}', [BarangController::class, 'edit'])
    ->name('barang-edit');

Route::put('/barang/update/{id_barang}', [BarangController::class, 'update'])
    ->name('barang-update');

Route::delete('/barang/hapus/{id_barang}', [BarangController::class, 'hapus'])
    ->name('barang-hapus');
    // =====================
    // SUPLIER
    // =====================
    Route::get('/suplier', [SuplierController::class, 'index']);
    Route::get('/suplier/tambah', [SuplierController::class, 'create']);
    Route::post('/suplier/simpan', [SuplierController::class, 'store']);
    Route::get('/suplier/{id}/ubah', [SuplierController::class, 'ubah']);
    Route::post('/suplier/simpan-ubah/{id}', [SuplierController::class, 'update']);
    Route::get('/suplier/{id}/hapus', [SuplierController::class, 'destroy']);

    // =====================
    // KATEGORI
    // =====================
    Route::get('/kategori', [KategoriController::class,'index']);
    Route::get('/kategori/tambah', [KategoriController::class,'form_tambah_kategori']);
    Route::post('/kategori/simpan', [KategoriController::class,'simpan_kategori']);
    Route::get('/kategori/{id_kategori}/ubah', [KategoriController::class,'ubah']);
    Route::put('/kategori/ubah/{id_kategori}', [KategoriController::class,'simpan_ubah']);
    Route::delete('/kategori/hapus/{id_kategori}', [KategoriController::class,'hapus_kategori']);

    // =====================
    // PELANGGAN
    // =====================
    Route::get('/pelanggan', [PelangganController::class, 'index']);
    Route::get('/pelanggan/tambah', [PelangganController::class, 'form_tambah_pelanggan']);
    Route::post('/pelanggan/simpan', [PelangganController::class, 'simpan_pelanggan']);
    Route::get('/pelanggan/{id_pelanggan}/ubah', [PelangganController::class, 'ubah']);
    Route::post('/pelanggan/{id_pelanggan}/ubah', [PelangganController::class, 'simpan_ubah']);
    Route::get('/pelanggan/{id_pelanggan}/hapus', [PelangganController::class, 'hapus_pelanggan']);
    Route::get('/pelanggan/cari/{hp}', [PelangganController::class, 'cari']);

    // =====================
    // TRANSAKSI
    // =====================
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::post('/transaksi/proses', [TransaksiController::class, 'proses']);
    Route::post('/transaksi/simpan', [TransaksiController::class, 'simpan']);

    // =====================
    // STRUK (INI YANG FIX)
    // =====================
    Route::get('/struk/{id}', [StrukController::class, 'cetak'])
        ->name('struk.cetak');

    // =====================
    // USER
    // =====================
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/tambah', [UserController::class, 'form_tambah']);
    Route::post('/user/simpan', [UserController::class, 'simpan_user']);

    // =====================
    // LAPORAN
    // =====================
Route::get('/laporan/penjualan', [LaporanController::class, 'penjualan'])
    ->name('laporan.penjualan');

    // =====================
    // PROFILE
    // =====================
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

});
