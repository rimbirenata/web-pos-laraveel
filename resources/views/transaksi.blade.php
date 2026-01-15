@extends('layout')

@section('konten')
<div class="row">

    {{-- DATA BARANG --}}
    <div class="col-5">
        <h3>📦 Data Barang</h3>

        <input type="text" id="scanBarang" class="form-control mb-2"
            placeholder="Scan / Ketik ID Barang lalu Enter" autofocus>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>ID</th><th>Nama</th><th>Stok</th><th>Harga</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barang as $b)
                <tr
                    data-id="{{ $b->id_barang }}"
                    data-nama="{{ $b->nama_barang }}"
                    data-harga="{{ $b->harga_jual }}"
                    data-stok="{{ $b->stok }}"
                >
                    <td>{{ $b->id_barang }}</td>
                    <td>{{ $b->nama_barang }}</td>
                    <td>{{ $b->stok }}</td>
                    <td>Rp {{ number_format($b->harga_jual,0,',','.') }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary btn-tambah">
                            Tambah
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- TRANSAKSI --}}
    <div class="col-7">
        <h3>🛒 Transaksi</h3>

        {{-- TAMPIL PESAN ERROR --}}
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="/transaksi/proses" id="formTransaksi">
            @csrf

            <label>No HP Pelanggan</label>
            <input type="text" id="hp" class="form-control mb-1"
                placeholder="isi disini">

            <input type="hidden" name="id_pelanggan" id="id_pelanggan">

            <small id="infoPelanggan" class="text-muted d-block mb-2">
                Pelanggan Umum
            </small>

            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th width="80">Qty</th>
                        <th>Subtotal</th>
                        <th width="60">Aksi</th>
                    </tr>
                </thead>
                <tbody id="keranjang">
                    <tr>
                        <td colspan="5" class="text-center">Keranjang kosong</td>
                    </tr>
                </tbody>
            </table>

            <h5>Total: <b id="totalText">Rp 0</b></h5>
            <input type="hidden" name="total_bayar" id="total">

            <label>Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" id="bayar"
                class="form-control" required>

            <label class="mt-2">Kembalian</label>
            <input type="text" id="kembalian" class="form-control" readonly>

            <button type="submit" class="btn btn-success mt-3 w-100">
                💰 Bayar
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let keranjang = [];

    const tbody = document.getElementById('keranjang');
    const totalText = document.getElementById('totalText');
    const totalInput = document.getElementById('total');
    const bayarInput = document.getElementById('bayar');
    const kembalianInput = document.getElementById('kembalian');
    const scanInput = document.getElementById('scanBarang');

    const hpInput = document.getElementById('hp');
    const infoPelanggan = document.getElementById('infoPelanggan');
    const idPelanggan = document.getElementById('id_pelanggan');

    // Tambah dengan tombol
    document.querySelectorAll('.btn-tambah').forEach(btn => {
        btn.onclick = () => tambahKeKeranjang(btn.closest('tr'));
    });

    // Scan / Enter
    scanInput.addEventListener('keydown', e => {
        if (e.key === 'Enter') {
            e.preventDefault();
            const id = scanInput.value.trim();
            if (!id) return;

            const tr = document.querySelector(`tr[data-id="${id}"]`);
            if (!tr) {
                alert('Barang tidak ditemukan');
                scanInput.value = '';
                return;
            }

            tambahKeKeranjang(tr);
            scanInput.value = '';
        }
    });

    function tambahKeKeranjang(tr) {
        const id = tr.dataset.id;
        const nama = tr.dataset.nama;
        const harga = parseInt(tr.dataset.harga);
        const stok = parseInt(tr.dataset.stok);

        let item = keranjang.find(i => i.id === id);

        if (item) {
            if (item.qty >= stok) return alert('Stok tidak cukup');
            item.qty++;
        } else {
            if (stok < 1) return alert('Stok habis');
            keranjang.push({ id, nama, harga, qty: 1, stok });
        }

        render();
    }

    function render() {
        if (keranjang.length === 0) {
            tbody.innerHTML = `<tr><td colspan="5" class="text-center">Keranjang kosong</td></tr>`;
            totalText.innerText = 'Rp 0';
            totalInput.value = 0;
            hitungKembalian();
            return;
        }

        tbody.innerHTML = '';
        let total = 0;

        keranjang.forEach((item, idx) => {
            const subtotal = item.harga * item.qty;
            total += subtotal;

            tbody.innerHTML += `
                <tr>
                    <td>${item.nama}</td>
                    <td>Rp ${item.harga.toLocaleString('id-ID')}</td>
                    <td>
                        <input type="number" class="form-control form-control-sm input-qty"
                            value="${item.qty}" min="1" max="${item.stok}"
                            data-idx="${idx}">
                    </td>
                    <td>Rp ${subtotal.toLocaleString('id-ID')}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger btn-hapus"
                            data-idx="${idx}">✕</button>
                    </td>
                </tr>

                <input type="hidden" name="keranjang[${idx}][id]" value="${item.id}">
                <input type="hidden" name="keranjang[${idx}][jumlah]" value="${item.qty}">
            `;
        });

        totalText.innerText = 'Rp ' + total.toLocaleString('id-ID');
        totalInput.value = total;
        hitungKembalian();
        pasangEvent();
    }

    function pasangEvent() {
        document.querySelectorAll('.input-qty').forEach(input => {
            input.onchange = () => {
                const idx = input.dataset.idx;
                let val = parseInt(input.value);
                if (val < 1) val = 1;
                if (val > keranjang[idx].stok) val = keranjang[idx].stok;
                keranjang[idx].qty = val;
                render();
            };
        });

        document.querySelectorAll('.btn-hapus').forEach(btn => {
            btn.onclick = () => {
                keranjang.splice(btn.dataset.idx, 1);
                render();
            };
        });
    }

    function hitungKembalian() {
        const bayar = parseInt(bayarInput.value) || 0;
        const total = parseInt(totalInput.value) || 0;
        kembalianInput.value = bayar >= total ? bayar - total : 0;
    }

    bayarInput.addEventListener('input', hitungKembalian);

    // 🟡 VALIDASI SEBELUM SUBMIT
    document.getElementById('formTransaksi').addEventListener('submit', function(e) {
        const total = parseInt(totalInput.value) || 0;
        const bayar = parseInt(bayarInput.value) || 0;
        if (bayar < total) {
            e.preventDefault();
            alert('Uang Anda kurang! Isi jumlah bayar yang cukup.');
        }
    });

    // =========================================
    // PENCARIAN PELANGGAN
    hpInput.addEventListener('keyup', () => {
        const hp = hpInput.value.trim();
        if (hp.length < 4) {
            infoPelanggan.innerText = 'Pelanggan Umum';
            idPelanggan.value = '';
            return;
        }

        fetch(`/pelanggan/cari/${encodeURIComponent(hp)}`)
            .then(res => res.json())
            .then(data => {
                if (data && data.nama_pelanggan) {
                    infoPelanggan.innerText = `Pelanggan: ${data.nama_pelanggan}`;
                    idPelanggan.value = data.id_pelanggan;
                } else {
                    infoPelanggan.innerText = 'Pelanggan Umum';
                    idPelanggan.value = '';
                }
            })
            .catch(() => {
                infoPelanggan.innerText = 'Pelanggan Umum';
                idPelanggan.value = '';
            });
    });

});
</script>
@endsection
