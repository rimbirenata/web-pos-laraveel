@extends('layout')

@section('konten')
<div class="card shadow m-3">
    <div class="card-header bg-primary text-white">
        <h5>➕ Tambah Barang</h5>
    </div>

    <div class="card-body">

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('barang-simpan') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Suplier</label>
                <select name="id_suplier" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($suplier as $s)
                        <option value="{{ $s->id_suplier }}">{{ $s->nama_suplier }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control" required>
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('barang-index') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>
@endsection
