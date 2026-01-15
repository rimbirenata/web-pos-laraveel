@extends('layout')

@section('konten')
<div class="card shadow m-2">
    <div class="card-header bg-primary text-white">
        <h5>Tambah Barang</h5>
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

        <form id="formBarang" action="{{ route('barang.simpan') }}" method="POST">
            @csrf

            <div class="mb-2">
                <label>ID Barang</label>
                <input type="text" name="id_barang" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Suplier</label>
                <select name="id_suplier" class="form-control" required>
                    @foreach ($suplier as $s)
                        <option value="{{ $s->id_suplier }}">{{ $s->nama_suplier }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" id="harga_beli" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" id="harga_jual" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</div>

<script>
document.getElementById('formBarang').addEventListener('submit', function(e) {
    const hargaBeli = parseFloat(document.getElementById('harga_beli').value);
    const hargaJual = parseFloat(document.getElementById('harga_jual').value);

    if (hargaJual < hargaBeli) {
        e.preventDefault();
        alert('Harga jual tidak boleh lebih rendah dari harga beli!');
    }
});
</script>
@endsection
