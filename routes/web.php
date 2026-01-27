<?php
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\TransaksiController;
use App\Models\Kategori;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanPenjualanController;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'proses_login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});









// menampilkan barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang-index');
Route::get('/barang/tambah', [BarangController::class, 'tambah'])->name('barang-tambah');
Route::post('/barang/simpan', [BarangController::class, 'simpan'])->name('barang-simpan');

Route::get('/barang/edit/{id_barang}', [BarangController::class, 'edit'])->name('barang-edit');
Route::put('/barang/update/{id_barang}', [BarangController::class, 'update'])->name('barang-update');

Route::delete('/barang/hapus/{id_barang}', [BarangController::class, 'hapus'])->name('barang-hapus');


// ini punya suplier ya

Route::get('/suplier', [SuplierController::class, 'index'])
    ->name('suplier.index');

Route::get('/suplier/tambah', [SuplierController::class, 'tambah'])
    ->name('suplier.tambah');

Route::post('/suplier/simpan', [SuplierController::class, 'simpan'])
    ->name('suplier.simpan');

Route::get('/suplier/{id}/ubah', [SuplierController::class, 'ubah'])
    ->name('suplier.ubah');

Route::put('/suplier/{id}', [SuplierController::class, 'simpan_ubah'])
    ->name('suplier.update');

Route::delete('/suplier/{id}', [SuplierController::class, 'hapus_suplier'])
    ->name('suplier.hapus');

// ini kategori ya

Route::get('/kategori',[KategoriController::class,'index']);
Route::get('/kategori/tambah',[KategoriController::class,'form_tambah_kategori']);
Route::post('/kategori/simpan',[KategoriController::class,'simpan_kategori']);
Route::get('/kategori/{id_kategori}/ubah',[KategoriController::class,'ubah']);
Route::put('/kategori/ubah/{id_kategori}', [KategoriController::class,'simpan_ubah']);
route::delete('/kategori/hapus/{id_kategori}',[KategoriController::class,'hapus_kategori']);

// ini pelanggan ya
Route::get('/pelanggan', [PelangganController::class, 'index']);
Route::get('/pelanggan/tambah', [PelangganController::class, 'form_tambah_pelanggan']);
Route::post('/pelanggan/simpan', [PelangganController::class, 'simpan_pelanggan']);

Route::get('/pelanggan/{id_pelanggan}/ubah', [PelangganController::class, 'ubah']);
Route::post('/pelanggan/{id_pelanggan}/ubah', [PelangganController::class, 'simpan_ubah']);

Route::get('/pelanggan/{id_pelanggan}/hapus', [PelangganController::class, 'hapus_pelanggan']);

//ini tansaksi ya
Route::get('/transaksi', [TransaksiController::class, 'index'])->middleware('auth');
Route::get('/transaksi/tambah', [TransaksiController::class, 'tambah'])->middleware('auth');
Route::post('/transaksi/simpan', [TransaksiController::class, 'simpan'])->middleware('auth');

Route::get('/transaksi/{id_transaksi}/ubah', [TransaksiController::class, 'ubah'])->middleware('auth');
Route::put('/transaksi/{id_transaksi}/proses', [TransaksiController::class, 'update'])->middleware('auth');
Route::delete('/transaksi/hapus/{id_transaksi}', [TransaksiController::class, 'hapus'])->middleware('auth');
Route::post('/transaksi/proses', [TransaksiController::class, 'proses'])->middleware('auth');
Route::get('/pelanggan/cari/{hp}', [PelangganController::class, 'cari'])->middleware('auth');


//laporan
Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])
    ->name('laporan-penjualan');

//profile
// Profile Sistem
Route::get('/profile', function () {
    return view('profile');
})->name('profile');



