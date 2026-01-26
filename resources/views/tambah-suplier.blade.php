@extends('layout')

@section('konten')
<div class="card shadow m-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tambah Suplier</h5>
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

        <form action="{{ route('suplier.simpan') }}" method="POST">
            @csrf

            {{-- Nama Suplier --}}
            <div class="mb-3">
                <label class="form-label">Nama Suplier</label>
                <input type="text"
                       name="nama_suplier"
                       id="nama_suplier"
                       class="form-control"
                       value="{{ old('nama_suplier') }}"
                       required>
                <small id="peringatan-nama"
                       class="text-danger"
                       style="display:none;">
                    Nama suplier tidak boleh mengandung angka, titik koma, tanda seru, tanda tanya atau slash
                </small>
            </div>

            {{-- No HP --}}
            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text"
                       name="no_hp"
                       class="form-control"
                       value="{{ old('no_hp') }}"
                       required>
            </div>

            {{-- Alamat --}}
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat"
                          id="alamat"
                          class="form-control"
                          rows="3"
                          required>{{ old('alamat') }}</textarea>
                <small id="peringatan-alamat"
                       class="text-danger"
                       style="display:none;">
                    Alamat tidak boleh mengandung angka, titik koma, tanda seru, tanda tanya atau slash
                </small>
            </div>

            <button class="btn btn-success" id="btn-simpan">Simpan</button>
            <a href="{{ route('suplier.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

{{-- JAVASCRIPT VALIDASI --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const namaSuplier = document.getElementById('nama_suplier');
    const alamat      = document.getElementById('alamat');
    const peringatanNama   = document.getElementById('peringatan-nama');
    const peringatanAlamat = document.getElementById('peringatan-alamat');
    const tombol = document.getElementById('btn-simpan');

    // regex karakter terlarang: angka, . ; ! ? /
    const regexTerlarang = /[0-9.;!?\/]/;

    function validasi() {
        let valid = true;

        if (regexTerlarang.test(namaSuplier.value)) {
            peringatanNama.style.display = 'block';
            valid = false;
        } else {
            peringatanNama.style.display = 'none';
        }

        if (regexTerlarang.test(alamat.value)) {
            peringatanAlamat.style.display = 'block';
            valid = false;
        } else {
            peringatanAlamat.style.display = 'none';
        }

        tombol.disabled = !valid;
    }

    namaSuplier.addEventListener('input', validasi);
    alamat.addEventListener('input', validasi);
});
</script>
@endsection
