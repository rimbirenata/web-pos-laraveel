@extends('layout')

@section('konten')
<div class="card">
    <div class="card-header">
        <h4>Tambah Pelanggan</h4>
    </div>

    <div class="card-body">
        <form action="/pelanggan/simpan" method="POST">
            @csrf

            <div class="mb-3">
                <label>ID Pelanggan</label>
                <input type="text" name="id_pelanggan"
                    class="form-control @error('id_pelanggan') is-invalid @enderror"
                    value="{{ old('id_pelanggan') }}">
                @error('id_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan"
                    class="form-control @error('nama_pelanggan') is-invalid @enderror"
                    value="{{ old('nama_pelanggan') }}">
                @error('nama_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp"
                    class="form-control @error('no_hp') is-invalid @enderror"
                    value="{{ old('no_hp') }}">
                @error('no_hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat"
                    class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="/pelanggan" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</div>
@endsection
