@extends('layout')
@section('konten')

<h4 class="mb-3">Data Suplier</h4>

<a href="/suplier/tambah" class="btn btn-primary btn-sm mb-3">
    Tambah Data Suplier
</a>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>ID Suplier</th>
            <th>Nama Suplier</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($suplier as $item)
        <tr>
            <td>{{ $item->id_suplier }}</td>
            <td>{{ $item->nama_suplier }}</td>
            <td>{{ $item->no_hp }}</td>
            <td>{{ $item->alamat }}</td>
            <td>
                <a href="/suplier/{{ $item->id_suplier }}/ubah"
                   class="btn btn-warning btn-sm">
                    Ubah
                </a>

                <form action="/suplier/hapus/{{ $item->id_suplier }}"
                      method="POST"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus data suplier {{ $item->nama_suplier }} ?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">
                Data suplier belum ada
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
