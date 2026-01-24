@extends('layout')

@section('konten')
<div class="card m-3 shadow">
    <div class="card-header bg-primary text-white">
        <h4>Form Ubah Suplier</h4>
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

        <form action="/suplier/ubah/{{ $suplier->id_suplier }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>ID Suplier</label>
                <input type="text" class="form-control"
                       value="{{ $suplier->id_suplier }}" readonly>
            </div>

            <div class="mb-3">
                <label>Nama Suplier</label>
                <input type="text" name="nama_suplier"
                       class="form-control"
                       value="{{ old('nama_suplier', $suplier->nama_suplier) }}">
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp"
                       class="form-control"
                       value="{{ old('no_hp', $suplier->no_hp) }}">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control">{{ old('alamat', $suplier->alamat) }}</textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="/suplier" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>
@endsection
