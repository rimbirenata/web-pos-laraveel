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
use App\Http\Controllers\AuthController;
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

route::get('/',function(){
    return redirect('login');



});

//ini login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'proses_login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');




route::middleware('auth')->group(function(){






//halaman dashboard
route::get('/dashboard',[HalamanController::class,'index']);






// menampilkan barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/tambah', [BarangController::class, 'tambah'])->name('barang.tambah');
Route::post('/barang/simpan', [BarangController::class, 'simpan'])->name('barang.simpan');
Route::get('/barang/ubah/{id_barang}', [BarangController::class, 'ubah'])->name('barang.ubah');
Route::put('/barang/simpan/{id_barang}', [BarangController::class, 'simpan_ubah'])->name('barang.simpan_ubah');
Route::delete('/barang/hapus/{id_barang}', [BarangController::class, 'hapus'])->name('barang.hapus');








// ini punya suplier ya
route::get('/suplier',[SuplierController::class,'index']);
route::get('/suplier/tambah',[SuplierController::class,'tambah_suplier']);
route::post('/suplier/simpan',[SuplierController::class,'simpan_suplier']);
route::get('/suplier/{id_suplier}/ubah',[SuplierController::class,'ubah']);
Route::put('/suplier/ubah/{id_suplier}', [SuplierController::class,'simpan_ubah']);
route::delete('/suplier/hapus/{id_suplier}',[SuplierController::class,'hapus_suplier']);


// ini kategori ya

route::get('/kategori',[KategoriController::class,'index']);
route::get('/kategori/tambah',[KategoriController::class,'form_tambah_kategori']);
route::post('/kategori/simpan',[KategoriController::class,'simpan_kategori']);
route::get('/kategori/{id_kategori}/ubah',[KategoriController::class,'ubah']);
Route::put('/kategori/ubah/{id_kategori}', [KategoriController::class,'simpan_ubah']);
route::delete('/kategori/hapus/{id_kategori}',[KategoriController::class,'hapus_kategori']);

// ini pelanggan ya
route::get('/pelanggan',[PelangganController::class,'index']);
route::get('/pelanggan/tambah',[PelangganController::class,'form_tambah_pelanggan']);
route::post('/pelanggan/simpan',[PelangganController::class,'simpan_pelanggan']);
route::get('/pelanggan/{id_pelanggan}/ubah',[PelangganController::class,'ubah']);
Route::put('/pelanggan/ubah/{id_pelanggan}', [PelangganController::class,'simpan_ubah']);
route::delete('/pelanggan/hapus/{id_pelanggan}',[PelangganController::class,'hapus_pelanggan']);


//ini tansaksi ya
Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi/tambah', [TransaksiController::class, 'tambah']);
Route::post('/transaksi/simpan', [TransaksiController::class, 'simpan']);
Route::get('/transaksi/{id_transaksi}/ubah', [TransaksiController::class, 'ubah']);
Route::put('/transaksi/{id_transaksi}/proses', [TransaksiController::class, 'update']);
Route::delete('/transaksi/hapus/{id_transaksi}', [TransaksiController::class, 'hapus']);
Route::post('/transaksi/proses', [TransaksiController::class, 'proses']);
Route::get('/pelanggan/cari/{hp}', [PelangganController::class, 'cari']);


//ini adalh auth
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerProcess']);

//laporan
Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])
    ->name('laporan-penjualan');

//profile
// Profile Sistem
Route::get('/profile', function () {
    return view('profile');
})->name('profile');


});
