@extends('layout')

@section('konten')
<div class="card m-2">
    <div class="card-header bg-warning">
        <h5>Ubah Suplier</h5>
    </div>

    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

      <form action="/suplier/simpan-ubah/{{ $suplier->id_suplier }}" method="POST">

            @csrf

            <div class="mb-3">
                <label>Nama Suplier</label>
                <input type="text" name="nama_suplier"
                       value="{{ $suplier->nama_suplier }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <input type="text" name="alamat"
                       value="{{ $suplier->alamat }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp"
                       value="{{ $suplier->no_hp }}"
                       class="form-control">
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="/suplier" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>
@endsection
