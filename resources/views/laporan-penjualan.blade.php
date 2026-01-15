@extends('layout')

@section('konten')

<div class="container mt-4">

    <h4 class="fw-bold mb-4 text-primary">📊 Laporan Penjualan</h4>

    <form method="GET" action="{{ route('laporan-penjualan') }}" class="row gy-2 gx-3 align-items-center mb-4">
        <div class="col-auto">
            <input type="date" name="tanggal" value="{{ $tanggal }}" class="form-control">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-search"></i> Lihat
            </button>
        </div>
    </form>

    @if(count($transaksiHariIni) > 0)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Ringkasan {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</h5>
            <div class="row text-center">
                <div class="col-md-4 mb-2">
                    <div class="p-2 bg-light border rounded">
                        <h6>Total Transaksi</h6>
                        <p class="fs-4 fw-bold">{{ $jumlahTransaksi }}</p>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="p-2 bg-light border rounded">
                        <h6>Total Bayar</h6>
                        <p class="fs-4 fw-bold text-success">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="p-2 bg-light border rounded">
                        <h6>Total Keuntungan</h6>
                        <p class="fs-4 fw-bold text-info">Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>#</th>
                    <th>Waktu Transaksi</th>
                    <th class="text-end">Total Bayar</th>
                    <th class="text-end">Keuntungan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksiHariIni as $idx => $t)
                <tr>
                    <td class="text-center">{{ $idx + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->translatedFormat('H:i, d F Y') }}</td>
                    <td class="text-end text-success">Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</td>
                    <td class="text-end text-info">Rp {{ number_format($t->total_keuntungan, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-3">
                        Tidak ada transaksi pada tanggal ini
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
