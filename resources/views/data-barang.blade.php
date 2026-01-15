@extends('layout')

@section('konten')
<div class="card shadow m-2">
    <div class="card-header text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5>📦 Data Barang</h5>

            <a href="{{ route('barang.tambah') }}" class="btn btn-info btn-sm">
                Tambah Barang
            </a>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Suplier</th>
                    <th>Stok</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($barang as $item)
                <tr>
                    <td>{{ $item->id_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->suplier->nama_suplier ?? '-' }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>Rp {{ number_format($item->harga_beli,0,',','.') }}</td>
                    <td>Rp {{ number_format($item->harga_jual,0,',','.') }}</td>
                    <td>
                        <a href="{{ route('barang.ubah', $item->id_barang) }}"
                           class="btn btn-warning btn-sm">Ubah</a>

                        <form action="{{ route('barang.hapus', $item->id_barang) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        Data barang masih kosong
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
