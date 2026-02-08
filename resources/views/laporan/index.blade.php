@extends('layout')

@section('konten')
<div class="container mt-4">

    <h4 class="fw-bold mb-3 text-primary">📊 Laporan Penjualan</h4>

    {{-- FILTER --}}
    <form method="GET" action="{{ url('/laporan') }}" class="row g-2 mb-3">
        <div class="col-md-3">
            <select name="periode" class="form-select">
                <option value="harian" {{ $periode=='harian'?'selected':'' }}>Harian</option>
                <option value="bulanan">Bulanan</option>
                <option value="tahunan">Tahunan</option>
            </select>
        </div>

        <div class="col-md-3">
            <input type="date" name="tanggal" value="{{ $tanggal }}" class="form-control">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">Lihat</button>
        </div>
    </form>

    <div class="alert alert-info">
        Menampilkan laporan <b>{{ ucfirst($periode) }}</b> :
        <b>{{ $labelPeriode }}</b>
    </div>

    {{-- RINGKASAN --}}
    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 rounded-4">
                <small>Total Transaksi</small>
                <h4>{{ $totalTransaksi }}</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3 rounded-4">
                <small>Total Bayar</small>
                <h4 class="text-success">
                    Rp {{ number_format($totalBayar,0,',','.') }}
                </h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3 rounded-4">
                <small>Total Modal</small>
                <h4 class="text-danger">
                    Rp {{ number_format($totalModal,0,',','.') }}
                </h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3 rounded-4">
                <small>Total Keuntungan</small>
                <h4 class="{{ $totalKeuntungan >= 0 ? 'text-success' : 'text-danger' }}">
                    Rp {{ number_format($totalKeuntungan,0,',','.') }}
                </h4>
            </div>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Modal</th>
                        <th>Total Bayar</th>
                        <th>Untung / Rugi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($detail as $i => $d)
                    <tr>
                        <td class="text-center">{{ $i+1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($d->tanggal_transaksi)->translatedFormat('d F Y H:i') }}</td>
                        <td class="text-end text-danger">
                            Rp {{ number_format($d->total_modal,0,',','.') }}
                        </td>
                        <td class="text-end text-success">
                            Rp {{ number_format($d->total_bayar,0,',','.') }}
                        </td>
                        <td class="text-end {{ $d->total_keuntungan >= 0 ? 'text-success' : 'text-danger' }}">
                            Rp {{ number_format($d->total_keuntungan,0,',','.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
