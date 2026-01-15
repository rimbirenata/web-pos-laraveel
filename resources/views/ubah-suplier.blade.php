@extends('layout')

@section('konten')
<div class="card m-2">
    <div class="card-header">
        <h3>Form Ubah Suplier</h3>
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

            <div class="row">

               
                <div class="col-12 mb-3 row">
                    <div class="col-3">
                        <label class="col-form-label">ID Suplier</label>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control"
                               value="{{ $suplier->id_suplier }}" readonly>
                    </div>
                </div>

                <div class="col-12 mb-3 row">
                    <div class="col-3">
                        <label class="col-form-label">Nama Suplier</label>
                    </div>
                    <div class="col-9">
                        <input type="text" name="nama_suplier"
                               class="form-control"
                               value="{{ old('nama_suplier', $suplier->nama_suplier) }}">
                    </div>
                </div>


                <div class="col-12 mb-3 row">
                    <div class="col-3">
                        <label class="col-form-label">No HP</label>
                    </div>
                    <div class="col-9">
                        <input type="number" name="no_hp"
                               class="form-control"
                               value="{{ old('no_hp', $suplier->no_hp) }}">
                    </div>
                </div>

         
                <div class="col-12 mb-3 row">
                    <div class="col-3">
                        <label class="col-form-label">Alamat</label>
                    </div>
                    <div class="col-9">
                        <input type="text" name="alamat"
                               class="form-control"
                               value="{{ old('alamat', $suplier->alamat) }}">
                    </div>
                </div>

           
                <div class="col-12 row mt-3">
                    <div class="col-3"></div>
                    <div class="col-9">
                        <button class="btn btn-primary">Simpan</button>
                        <a href="/suplier" class="btn btn-warning">Kembali</a>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
