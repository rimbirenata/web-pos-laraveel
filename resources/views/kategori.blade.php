@extends('layout')
@section('konten')

<h4 class="mb-3">Data Kategori</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="/kategori/tambah" class="btn btn-primary btn-sm mb-3">Tambah Data Kategori</a>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>ID Kategori</th>
            <th>Nama Kategori</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kategori as $item)
        <tr>
            <td>{{ $item->id_kategori }}</td>
            <td>{{ $item->nama_kategori }}</td>
            <td>
                <a href="/kategori/{{ $item->id_kategori }}/ubah" class="btn btn-warning btn-sm">Ubah</a>
                <form action="/kategori/hapus/{{ $item->id_kategori }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus kategori {{ $item->nama_kategori }} ?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Data kategori belum ada</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
