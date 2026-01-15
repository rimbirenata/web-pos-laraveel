@extends('layout')

@section('konten')
<div class="card m-2">
    <div class="card-header">
        <h3>Form Ubah Data Barang</h3>
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

        <form id="formBarangubah"
              action="{{ route('barang.simpan_ubah', $barang->id_barang) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>ID Barang</label>
                <input type="text" class="form-control"
                       value="{{ $barang->id_barang }}" disabled>
                <input type="hidden" name="id_barang" value="{{ $barang->id_barang }}">
            </div>

            <div class="mb-2">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control"
                       value="{{ $barang->nama_barang }}" required>
            </div>

            <div class="mb-2">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}"
                            @if($k->id_kategori == $barang->id_kategori) selected @endif>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Suplier</label>
                <select name="id_suplier" class="form-control" required>
                    @foreach ($suplier as $s)
                        <option value="{{ $s->id_suplier }}"
                            @if($s->id_suplier == $barang->id_suplier) selected @endif>
                            {{ $s->nama_suplier }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control"
                       value="{{ $barang->stok }}" required>
            </div>

            <div class="mb-2">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" id="harga_beli_edit" class="form-control"
                       value="{{ $barang->harga_beli }}" required>
            </div>

            <div class="mb-3">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" id="harga_jual_edit" class="form-control"
                       value="{{ $barang->harga_jual }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<script>
document.getElementById('formBarangubah').addEventListener('submit', function(e) {
    const hargaBeli = parseFloat(document.getElementById('harga_beli_edit').value);
    const hargaJual = parseFloat(document.getElementById('harga_jual_edit').value);

    if (hargaJual < hargaBeli) {
        e.preventDefault();
        alert('Harga jual tidak boleh lebih rendah dari harga beli!');
    }
});
</script>
@endsection
