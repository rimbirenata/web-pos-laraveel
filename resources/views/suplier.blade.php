@extends('layout')

@section('konten')
<div class="card shadow m-2">
    <div class="card-header bg-primary d-flex justify-content-between align-items-center">
        <h5 class="text-white mb-0">Data Suplier</h5>
        <a href="{{ route('suplier.tambah') }}" class="btn btn-info btn-sm">Tambah Suplier</a>
    </div>

    <div class="card-body">

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Suplier</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suplier as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td> {{-- Nomor otomatis --}}
                    <td>{{ $s->nama_suplier }}</td>
                    <td>{{ $s->alamat }}</td>
                    <td>{{ $s->no_hp }}</td>
                    <td>
                        {{-- Tombol Ubah --}}
                        <a href="{{ route('suplier_ubah', $s->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                        {{-- Tombol Hapus --}}
                        <a href="{{ route('suplier.hapus', $s->id) }}"
                           onclick="return confirm('Yakin mau hapus?')"
                           class="btn btn-danger btn-sm">
                           Hapus
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Data suplier masih kosong
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection
