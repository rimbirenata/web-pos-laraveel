@extends('layout')
@section('konten')

<h4 class="mb-3">Data Pelanggan</h4>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="/pelanggan/tambah" class="btn btn-primary btn-sm mb-3">
    Tambah Data Pelanggan
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pelanggan as $p)
        <tr>
            <td>{{ $p->id_pelanggan }}</td>
            <td>{{ $p->nama_pelanggan }}</td>
            <td>{{ $p->no_hp }}</td>
            <td>{{ $p->alamat }}</td>
            <td>
                <a href="/pelanggan/{{ $p->id_pelanggan }}/ubah"
                   class="btn btn-warning btn-sm">Ubah</a>

                <form action="/pelanggan/hapus/{{ $p->id_pelanggan }}"
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus {{ $p->nama_pelanggan }} ?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">
                Data pelanggan belum ada
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
