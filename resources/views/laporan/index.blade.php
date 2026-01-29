@extends('layout')

@section('konten')
<div class="container mt-4">

    <h4 class="fw-bold mb-3 text-primary">📊 Laporan Penjualan</h4>

    <!-- FILTER -->
    <form method="GET" action="{{ route('laporan.penjualan') }}" class="row gy-2 gx-2 mb-3">
        <div class="col-md-3">
            <select name="periode" id="periode" class="form-select">
                <option value="harian" {{ $periode=='harian'?'selected':'' }}>Harian</option>
                <option value="mingguan" {{ $periode=='mingguan'?'selected':'' }}>Mingguan</option>
                <option value="bulanan" {{ $periode=='bulanan'?'selected':'' }}>Bulanan</option>
                <option value="tahunan" {{ $periode=='tahunan'?'selected':'' }}>Tahunan</option>
            </select>
        </div>

        <div class="col-md-3">
            <input type="date" name="tanggal" id="tanggal" value="{{ $tanggal }}" class="form-control">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                <i class="bi bi-search"></i> Lihat
            </button>
        </div>
    </form>

    <!-- INFO PERIODE -->
    <div class="alert alert-info">
        Menampilkan laporan <b>{{ ucfirst($periode) }}</b> :
        <b>{{ $labelPeriode }}</b>
    </div>

    <!-- RINGKASAN -->
    <div class="row mb-3 text-center">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small>Total Transaksi</small>
                    <h4>{{ $totalTransaksi }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small>Total Bayar</small>
                    <h4 class="text-success">
                        Rp {{ number_format($totalBayar,0,',','.') }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small>Total Keuntungan</small>
                    <h4 class="text-info">
                        Rp {{ number_format($totalKeuntungan,0,',','.') }}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL -->
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Waktu Transaksi</th>
                        <th>Total Bayar</th>
                        <th>Keuntungan</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($detail as $i => $d)
                    <tr>
                        <td class="text-center">{{ $i+1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($d->tanggal_transaksi)->translatedFormat('d F Y H:i') }}</td>
                        <td class="text-end text-success">
                            Rp {{ number_format($d->total_bayar,0,',','.') }}
                        </td>
                        <td class="text-end text-info">
                            Rp {{ number_format($d->total_keuntungan,0,',','.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">
                            ❗ Belum ada transaksi pada periode ini
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
document.getElementById('periode').addEventListener('change', function () {
    let tgl = document.getElementById('tanggal');

    if (this.value === 'tahunan') {
        tgl.type = 'number';
        tgl.placeholder = 'Tahun (2026)';
        tgl.value = new Date().getFullYear();
    } else {
        tgl.type = 'date';
    }
});
</script>
@endsection
