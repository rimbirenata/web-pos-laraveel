@extends('layout')

@section('konten')
<div class="card m-2">
    <div class="card-header">
        <h3>Form Tambah Pelanggan</h3>
    </div>

    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/pelanggan/simpan" method="post">
            @csrf

            <div class="mb-3">
                <label>ID Pelanggan</label>
                <input type="text" name="id_pelanggan"
                    class="form-control @error('id_pelanggan') is-invalid @enderror"
                    value="{{ old('id_pelanggan') }}">
            </div>

            <div class="mb-3">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan"
                    class="form-control @error('nama_pelanggan') is-invalid @enderror"
                    value="{{ old('nama_pelanggan') }}">
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp"
                    class="form-control @error('no_hp') is-invalid @enderror"
                    value="{{ old('no_hp') }}">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat"
                    class="form-control @error('alamat') is-invalid @enderror"
                    rows="3">{{ old('alamat') }}</textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="/pelanggan" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</div>
@endsection
