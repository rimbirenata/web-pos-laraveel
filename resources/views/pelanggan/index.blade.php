@extends('layout')

@section('konten')

<h4 class="fw-bold mb-4">👥 Data Pelanggan</h4>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="fw-bold">Daftar Pelanggan</span>
        <a href="#" class="btn btn-sm btn-primary">
            ➕ Tambah Pelanggan
        </a>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover table-bordered mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th width="60">No</th>
                    <th>Nama Pelanggan</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggan as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->nama_pelanggan }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ $p->alamat ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        Belum ada data pelanggan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
