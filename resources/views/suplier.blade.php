@extends('layout')

@section('konten')
<div class="card shadow m-2">
    <div class="card-header bg-primary d-flex justify-content-between align-items-center">
        <h5 class="text-white mb-0">Data Suplier</h5>
        <a href="{{ route('suplier.tambah') }}" class="btn btn-info btn-sm">
            Tambah Suplier
        </a>
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
                    <th width="50">No</th>
                    <th>Nama Suplier</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suplier as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->nama_suplier }}</td>
                    <td>{{ $s->alamat }}</td>
                    <td>{{ $s->no_hp }}</td>
                    <td>
                        {{-- TOMBOL UBAH --}}
                        <a href="{{ route('suplier.ubah', $s->id_suplier) }}"
                           class="btn btn-warning btn-sm">
                            Ubah
                        </a>

                        {{-- TOMBOL HAPUS --}}
                        <form action="{{ route('suplier.hapus', $s->id_suplier) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus data ini?')">
                                Hapus
                            </button>
                        </form>
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
