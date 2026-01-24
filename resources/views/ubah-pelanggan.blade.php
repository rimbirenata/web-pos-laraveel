@extends('layout')
@section('konten')

<div class="card">
    <div class="card-header">
        <h4>Ubah Pelanggan</h4>
    </div>

    <div class="card-body">
        <form action="/pelanggan/ubah/{{ $pelanggan->id_pelanggan }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>ID Pelanggan</label>
                <input type="text" class="form-control"
                       value="{{ $pelanggan->id_pelanggan }}" readonly>
            </div>

            <div class="mb-3">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan"
                    class="form-control @error('nama_pelanggan') is-invalid @enderror"
                    value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}">
                @error('nama_pelanggan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp"
                    class="form-control"
                    value="{{ old('no_hp', $pelanggan->no_hp) }}">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat"
                    class="form-control">{{ old('alamat', $pelanggan->alamat) }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="/pelanggan" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</div>

@endsection
