@extends('layout')

@section('konten')

<div class="container">

    <!-- HEADER PROFILE -->
    <div class="card shadow-lg border-0 mb-4"
         style="background: linear-gradient(135deg,#4f46e5,#06b6d4); border-radius:20px;">
        <div class="card-body text-center text-white p-5">

            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                 width="110"
                 class="rounded-circle shadow mb-3">

            <h2 class="fw-bold mb-1">{{ Auth::user()->name ?? 'PROGREMMER KABASA' }}</h2>
            <p class="mb-2">Developer</p>

            <span class="badge bg-light text-dark px-3 py-2">
                🟢 Sistem Aktif & Normal
            </span>

        </div>
    </div>

    <div class="row">

        <!-- INFO USER -->
        <div class="col-md-6 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-primary text-white fw-bold">
                    👤 Informasi Akun
                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="180">Nama</th>
                            <td>{{ Auth::user()->name ?? 'RIMBI' }}</td>
                        </tr>

                        <tr>
                            <th>Username</th>
                            <td>{{ Auth::user()->username ?? 'RIMBIRENATA' }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ Auth::user()->email ?? 'rimbi.renata5@gmail.com' }}</td>
                        </tr>

                        <tr>
                            <th>Role</th>
                            <td><span class="badge bg-success">PROGREMMER FULLSTACK</span></td>
                        </tr>

                        <tr>
                            <th>Bergabung</th>
                            <td>{{ Auth::user()->created_at ?? '22 DESEMBER 2025' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

       <!-- STAT SISTEM -->
<div class="col-md-6 mb-4">
    <div class="card shadow border-0 h-100">
        <div class="card-header bg-success text-white fw-bold">
            📊 Status & Informasi Sistem
        </div>

        <div class="card-body">

            <div class="mb-3">
                <label class="fw-bold">Versi Aplikasi</label>
                <div class="progress">
                    <div class="progress-bar bg-primary" style="width:100%">
                        Sistem Penjualan Kabasa v1.0.0
                    </div>
                </div>
                <small class="text-muted">
                    Versi pertama sistem berbasis web untuk manajemen penjualan toko
                </small>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Database</label>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width:100%">
                        MySQL Database Connected
                    </div>
                </div>
                <small class="text-muted">
                    Semua data barang, transaksi, pelanggan, dan laporan tersimpan aman di database MySQL
                </small>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Server & Framework</label>
                <div class="progress">
                    <div class="progress-bar bg-warning" style="width:100%">
                        Laravel 11 - PHP 8 Aktif
                    </div>
                </div>
                <small class="text-muted">
                    Sistem dibangun menggunakan Laravel sebagai backend dan Bootstrap sebagai tampilan
                </small>
            </div>

            <hr>

            <h6 class="fw-bold">🧾 Fungsi Utama Program</h6>
            <ul class="small">
                <li>Manajemen data barang dan stok</li>
                <li>Pencatatan transaksi penjualan</li>
                <li>Data pelanggan dan supplier</li>
                <li>Laporan penjualan harian & bulanan</li>
                <li>Perhitungan otomatis untung dan modal</li>
                <li>Cetak struk pembayaran</li>
                <li>Dashboard statistik penjualan</li>
            </ul>

            <div class="alert alert-info mt-3">
                🚀 Sistem Informasi Penjualan Kabasa membantu toko dalam mengelola penjualan secara cepat, rapi,
                dan akurat.
            </div>

        </div>
    </div>
</div>
        <!-- CARD ABOUT -->
<div class="card shadow border-0">
    <div class="card-header bg-dark text-white fw-bold">
        💻 Tim Developer Sistem Penjualan Kabasa
    </div>

    <div class="card-body">

        <div class="row text-center">

            <!-- DEVELOPER 1 -->
            <div class="col-md-6 mb-4">
                <img src="{{ asset('public/images/lubna.png') }}" width="90" class="rounded-circle shadow mb-2">
                <h5 class="fw-bold mb-0">LUBNAYA ARIFAH HANUM</h5>
                <small class="text-muted">Fullstack Developer</small>

                <div class="mt-2">
                    <span class="badge bg-primary">Laravel</span>
                    <span class="badge bg-success">MySQL</span>
                    <span class="badge bg-dark">Bootstrap</span>
                </div>
            </div>

            <!-- DEVELOPER 2 -->
            <div class="col-md-6 mb-4">
            <img src="{{ asset('images/rimbi.png') }}" width="90" class="rounded-circle shadow mb-2">
                 <h5 class="fw-bold mb-0">NURALIFAH NAZLATUL AZIZAH</h5>
                <small class="text-muted">UI Designer & Programmer</small>

                <div class="mt-2">
                    <span class="badge bg-warning">UI Design</span>
                    <span class="badge bg-info">Frontend</span>
                    <span class="badge bg-success">Database</span>
                </div>
            </div>

        </div>

        <hr>

        <div class="text-center">
            <p class="mb-0">
                Sistem Informasi Penjualan Kabasa dibuat sebagai project pengembangan
                aplikasi berbasis web untuk mempermudah pengelolaan transaksi, barang,
                dan laporan penjualan secara digital.
            </p>
        </div>

    </div>
</div>

        <hr>

        <div class="text-center">
            <p class="mb-0">
                🚀 Sistem Informasi Penjualan Kabasa dibuat untuk tugas/project sekolah
                oleh 2 developer.
            </p>
        </div>

    </div>
</div>


</div>

@endsection
