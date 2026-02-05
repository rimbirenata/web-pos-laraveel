@extends('layout')

@section('konten')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Data Kategori</h4>
        <a href="/kategori/tambah" class="btn btn-primary btn-sm">+ Tambah</a>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th class="text-center">Jumlah Barang</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama_kategori }}</td>
                    <td class="text-center">{{ $k->barang_count }}</td>
                    <td class="text-center">

                        <a href="/kategori/{{ $k->id }}/ubah" class="btn btn-warning btn-sm">
                            Ubah
                        </a>

                        @if($k->barang_count > 0)
                            <button class="btn btn-danger btn-sm" disabled
                                title="Masih dipakai barang">
                                Hapus
                            </button>
                        @else
                            <form action="/kategori/{{ $k->id }}/hapus" method="POST" style="display:inline">
                                @csrf
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus kategori?')">
                                    Hapus
                                </button>
                            </form>
                        @endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
