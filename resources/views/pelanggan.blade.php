@extends('layout')

@section('konten')
<h4 class="mb-3">Data Pelanggan</h4>

<a href="/pelanggan/tambah" class="btn btn-primary mb-3">
    + Tambah Pelanggan
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pelanggan as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->nama_pelanggan }}</td>
            <td>{{ $p->no_hp }}</td>
            <td>{{ $p->alamat }}</td>
            <td>
                <a href="/pelanggan/{{ $p->id_pelanggan }}/ubah"
                   class="btn btn-warning btn-sm">
                    Ubah
                </a>

                <a href="/pelanggan/{{ $p->id_pelanggan }}/hapus"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus?')">
                    Hapus
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
