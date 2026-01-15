@extends('layout')
@section('konten')

<h4 class="mb-3">Data Pelanggan</h4>

<a href="/pelanggan/tambah" class="btn btn-primary btn-sm mb-3">
    Tambah Data Pelanggan
</a>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>ID Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($pelanggan as $item)
        <tr>
            <td>{{ $item->id_pelanggan }}</td>
            <td>{{ $item->nama_pelanggan }}</td>
            <td>{{ $item->no_hp }}</td>
            <td>{{ $item->alamat }}</td>
            <td>
                <a href="/pelanggan/{{ $item->id_pelanggan }}/ubah"
                   class="btn btn-warning btn-sm">
                    Ubah
                </a>

                <form action="/pelanggan/hapus/{{ $item->id_pelanggan }}"
                      method="POST"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus data pelanggan {{ $item->nama_pelanggan }} ?')">
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
