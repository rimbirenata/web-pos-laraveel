@extends('layout')

@section('konten')
<a href="{{ route('barang-tambah') }}" class="btn btn-primary mb-2">➕ Tambah Barang</a>

<table class="table table-bordered">
    <tr>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Suplier</th>
        <th>Stok</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Aksi</th>
    </tr>

    @foreach($barang as $b)
    <tr>
        <td>{{ $b->nama_barang }}</td>
        <td>{{ $b->kategori->nama_kategori }}</td>
        <td>{{ $b->suplier->nama_suplier }}</td>
         <td>{{ $b->stok }}</td>
        <td>Rp {{ number_format($b->harga_beli) }}</td>
        <td>Rp {{ number_format($b->harga_jual) }}</td>
        <td>
            <a href="{{ route('barang-edit', $b->id_barang) }}" class="btn btn-warning btn-sm">Ubah</a>

            <form action="{{ route('barang-hapus', $b->id_barang) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
