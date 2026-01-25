@extends('layout')

@section('konten')
<div class="card">
    <div class="card-header">
        <h4>Ubah Pelanggan</h4>
    </div>

    <div class="card-body">
        <form action="{{ url('/pelanggan/'.$pelanggan->id_pelanggan.'/ubah') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Pelanggan</label>
                <input type="text"
                       name="nama_pelanggan"
                       value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}"
                       class="form-control @error('nama_pelanggan') is-invalid @enderror">
                @error('nama_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text"
                       name="no_hp"
                       value="{{ old('no_hp', $pelanggan->no_hp) }}"
                       class="form-control @error('no_hp') is-invalid @enderror">
                @error('no_hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat"
                          class="form-control @error('alamat') is-invalid @enderror"
                          rows="3">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="/pelanggan" class="btn btn-warning">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
