@extends('layout')

@section('konten')
<div class="container mt-5">
    {{-- Header --}}
    <div class="text-center mb-5">
        <div class="p-4 rounded-4 shadow-sm bg-gradient" style="background: linear-gradient(90deg,#4e73df,#1cc88a); color:black;">
            <h2 class="fw-bold display-5">🌟 Sistem Informasi Penjualan Kabasa</h2>
            <p class="fs-5">Versi 11.2.0 — Laravel & Bootstrap</p>
        </div>
    </div>
    {{-- Grid Cards --}}
    
    <div class="row g-4 mb-5">
        {{-- Tentang Aplikasi --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header py-3 rounded-top-4 text-dark" style="background: linear-gradient(90deg,#4e73df,#224abe);">
                    <h5><i class="fas fa-info-circle me-2"></i>Tentang Aplikasi</h5>
                </div>
                <div class="card-body">
                    <p>
                        <strong>Sistem Informasi Penjualan Kabasa</strong> membantu usaha dalam
                        pencatatan transaksi, pengelolaan barang, pelanggan, supplier, serta laporan harian
                        secara cepat & akurat.
                    </p>
                    <div class="row mt-3">
                        <div class="col-6">
                            <ul class="list-unstyled mb-0">
                                <li><strong>Nama Aplikasi:</strong> Kabasa SIP</li>
                                <li><strong>Versi:</strong> 11.2.0</li>
                                <li><strong>Platform:</strong> Web</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled mb-0">
                                <li><strong>Laravel:</strong> 11 & PHP 8.1</li>
                                <li><strong>Database:</strong> MySQL</li>
                                <li><strong>Server:</strong> Laragon</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Fitur Utama --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header py-3 rounded-top-4 text-white" style="background: linear-gradient(90deg,#1cc88a,#17a673);">
                    <h5><i class="fas fa-tools me-2"></i>Fitur Utama</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item hover-shadow"><i class="fas fa-boxes me-2 text-success"></i>Manajemen barang lengkap</li>
                        <li class="list-group-item hover-shadow"><i class="fas fa-shopping-cart me-2 text-success"></i>Transaksi penjualan dengan keranjang</li>
                        <li class="list-group-item hover-shadow"><i class="fas fa-users me-2 text-success"></i>Pelanggan & Supplier</li>
                        <li class="list-group-item hover-shadow"><i class="fas fa-chart-line me-2 text-success"></i>Laporan penjualan harian</li>
                        <li class="list-group-item hover-shadow"><i class="fas fa-id-badge me-2 text-success"></i>Profil & informasi sistem</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Teknologi --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header py-3 rounded-top-4 text-white" style="background: linear-gradient(90deg,#36b9cc,#2c9faf);">
                    <h5><i class="fas fa-code me-2"></i>Teknologi Digunakan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled mb-0">
                                <li><i class="fab fa-laravel me-2 text-info"></i>Laravel 11</li>
                                <li><i class="fab fa-php me-2 text-info"></i>PHP 8.1</li>
                                <li><i class="fab fa-bootstrap me-2 text-info"></i>Bootstrap</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled mb-0">
                                <li><i class="fas fa-database me-2 text-info"></i>MySQL</li>
                                <li><i class="fas fa-desktop me-2 text-info"></i>Laragon</li>
                                <li><i class="fab fa-js me-2 text-info"></i>JavaScript</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cara Penggunaan --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header py-3 rounded-top-4 text-white" style="background: linear-gradient(90deg,#f6c23e,#dda20a);">
                    <h5><i class="fas fa-book me-2"></i>Cara Penggunaan</h5>
                </div>
                <div class="card-body">
                    <ol class="ps-3 mb-0">
                        <li>Login ke dalam aplikasi (user terdaftar).</li>
                        <li>Buka <strong>Data Barang</strong> untuk tambah/ubah/hapus barang.</li>
                        <li>Kelola <strong>Pelanggan</strong> & <strong>Supplier</strong> sesuai kebutuhan.</li>
                        <li>Pilih menu <strong>Transaksi</strong>, input barang, lalu proses pembayaran.</li>
                        <li>Lihat <strong>Laporan Penjualan</strong> untuk ringkasan harian.</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Tentang Developer --}}
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header py-3 rounded-top-4 text-white" style="background: linear-gradient(90deg,#5a5c69,#2e2f3e);">
                    <h5><i class="fas fa-users me-2"></i>Tentang Tim Developer kami</h5>
                </div>
                <div class="card-body">
                    <p>
                        Aplikasi ini dibuat oleh <strong>Tim 18 Kabasa</strong> sebagai project Sistem Informasi Penjualan.
                        Bila ada pertanyaan atau fitur tambahan:
                    </p>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Email:</strong> tim18.kabasa@gmail.com</li>
                        <li><strong>Telepon:</strong> 0812-7549-3227</li>
                        <li><strong>GitHub:</strong> <a href="https://github.com/tim18-kabasa" target="_blank">github.com/tim18-kabasa</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3 rounded-pill">← Kembali</a>
    </div>

    {{-- Footer --}}
   
        <br>

</div>

{{-- CSS tambahan --}}
<style>
.hover-shadow:hover {
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    transition: all 0.3s;
}
</style>
@endsection
