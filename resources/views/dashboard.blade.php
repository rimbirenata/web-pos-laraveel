@extends('layout')

@section('konten')

<h5 class="fw-bold mb-4">E - PENJUALAN KABASA</h5>

<div class="row g-3">

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-semibold">
                Nama Pelanggan
            </div>
            <div class="card-body bg-warning text-center">
                <h2 class="fw-bold">6</h2>
                <a href="/barang" class="text-dark">Tabel pelanggan »</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-semibold">
                Stok Barang
            </div>
            <div class="card-body bg-info text-center">
                <h2 class="fw-bold">5</h2>
                <a href="/barang" class="text-dark">Tabel Barang »</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-semibold">
                Telah Terjual
            </div>
            <div class="card-body bg-secondary text-center">
                <h2 class="fw-bold">32</h2>
                <a href="/laporan-penjualan" class="text-dark">Tabel Laporan »</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-semibold">
                Kategori Barang
            </div>
            <div class="card-body bg-success text-center">
                <h2 class="fw-bold">8</h2>
                <a href="/kategori" class="text-dark">Tabel Kategori »</a>
            </div>
        </div>
    </div>

</div>

@endsection
