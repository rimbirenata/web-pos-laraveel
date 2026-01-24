@extends('layout')

@section('konten')
<div class="card shadow m-3">
    <div class="card-header bg-warning text-dark">
        ✏️ Ubah Barang
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

        <form action="{{ route('barang-update', $barang->id_barang) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- NAMA BARANG --}}
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text"
                       name="nama_barang"
                       class="form-control"
                       value="{{ $barang->nama_barang }}"
                       required>
            </div>

            {{-- KATEGORI --}}
            <div class="mb-3">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}"
                            {{ $barang->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- SUPLIER --}}
            <div class="mb-3">
                <label>Suplier</label>
                <select name="id_suplier" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($suplier as $s)
                        <option value="{{ $s->id_suplier }}"
                            {{ $barang->id_suplier == $s->id_suplier ? 'selected' : '' }}>
                            {{ $s->nama_suplier }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- STOK --}}
            <div class="mb-3">
                <label>Stok</label>
                <input type="number"
                       name="stok"
                       class="form-control"
                       value="{{ $barang->stok }}"
                       required>
            </div>

            {{-- HARGA BELI --}}
            <div class="mb-3">
                <label>Harga Beli</label>
                <input type="number"
                       name="harga_beli"
                       class="form-control"
                       value="{{ $barang->harga_beli }}"
                       required>
            </div>

            {{-- HARGA JUAL --}}
            <div class="mb-3">
                <label>Harga Jual</label>
                <input type="number"
                       name="harga_jual"
                       class="form-control"
                       value="{{ $barang->harga_jual }}"
                       required>
            </div>

            <button class="btn btn-warning">Update</button>
            <a href="{{ route('barang-index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>
@endsection
