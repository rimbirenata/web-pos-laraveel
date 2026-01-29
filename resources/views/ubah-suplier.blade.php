@extends('layout')

@section('konten')
<div class="card shadow m-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Ubah Suplier</h5>
    </div>

    <div class="card-body">

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('suplier.update', $suplier->id_suplier) }}" method="POST" id="form-ubah-suplier">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">ID Suplier</label>
                <input type="text"
                       class="form-control"
                       value="{{ $suplier->id_suplier }}"
                       readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Suplier</label>
                <input type="text"
                       name="nama_suplier"
                       id="nama_suplier"
                       class="form-control"
                       value="{{ old('nama_suplier', $suplier->nama_suplier) }}"
                       required>
                <small id="error-nama" class="text-danger" style="display:none;">
                    Nama suplier tidak boleh mengandung angka, koma, titik, tanda tanya, tanda seru, atau slash
                </small>
            </div>

            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text"
                       name="no_hp"
                       id="no_hp"
                       class="form-control"
                       value="{{ old('no_hp', $suplier->no_hp) }}"
                       required>
                <small id="error-nohp" class="text-danger" style="display:none;">
                    Nomor HP harus berupa angka saja, tanpa huruf atau simbol
                </small>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat"
                          id="alamat"
                          class="form-control"
                          rows="3"
                          required>{{ old('alamat', $suplier->alamat) }}</textarea>
                <small id="error-alamat" class="text-danger" style="display:none;">
                    Alamat tidak boleh mengandung angka, koma, titik, tanda tanya, tanda seru, atau slash
                </small>
            </div>

            <button type="submit" class="btn btn-primary" id="btn-submit">Simpan</button>
            <a href="{{ route('suplier.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaSuplier = document.getElementById('nama_suplier');
    const noHp = document.getElementById('no_hp');
    const alamat = document.getElementById('alamat');
    const btnSubmit = document.getElementById('btn-submit');

    const errorNama = document.getElementById('error-nama');
    const errorNoHp = document.getElementById('error-nohp');
    const errorAlamat = document.getElementById('error-alamat');

    // ❗ NAMA & ALAMAT: HANYA LARANG ANGKA
    const regexAngka = /[0-9]/;

    // NO HP: ANGKA SAJA
    const regexNoHp = /^[0-9]+$/;

    function validasi() {
        let valid = true;

        if (regexAngka.test(namaSuplier.value)) {
            errorNama.style.display = 'block';
            valid = false;
        } else {
            errorNama.style.display = 'none';
        }

        if (!regexNoHp.test(noHp.value)) {
            errorNoHp.style.display = 'block';
            valid = false;
        } else {
            errorNoHp.style.display = 'none';
        }

        if (regexAngka.test(alamat.value)) {
            errorAlamat.style.display = 'block';
            valid = false;
        } else {
            errorAlamat.style.display = 'none';
        }

        btnSubmit.disabled = !valid;
    }

    namaSuplier.addEventListener('input', validasi);
    noHp.addEventListener('input', validasi);
    alamat.addEventListener('input', validasi);

    validasi();
});
</script>

@endsection
