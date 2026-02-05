@extends('layout')

@section('konten')
<div class="card shadow m-2">
    <div class="card-header bg-primary d-flex justify-content-between">
        <h5 class="text-white mb-0">Data Suplier</h5>
        <a href="/suplier/tambah" class="btn btn-info btn-sm">Tambah Suplier</a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>

            @foreach ($suplier as $s)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $s->nama_suplier }}</td>
                <td>{{ $s->alamat }}</td>
                <td>{{ $s->no_hp }}</td>
                <td>
                    <a href="/suplier/{{ $s->id_suplier }}/ubah"
                       class="btn btn-warning btn-sm">Ubah</a>

                    <a href="/suplier/{{ $s->id_suplier }}/hapus"
                       onclick="return confirm('Yakin hapus?')"
                       class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
