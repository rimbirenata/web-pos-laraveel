@extends('layout')

@section('konten')
<div class="row">

    {{-- Data Barang --}}
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
                <tr data-id="{{ $b->id_barang }}"
                    data-nama="{{ $b->nama_barang }}"
                    data-harga="{{ $b->harga_jual }}"
                    data-stok="{{ $b->stok }}">
                    <td>{{ $b->id_barang }}</td>
                    <td>{{ $b->nama_barang }}</td>
                    <td>{{ $b->stok }}</td>
                    <td>Rp {{ number_format($b->harga_jual,0,',','.') }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary btn-tambah">Tambah</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Form Transaksi --}}
    <div class="col-7">
        <h3>🛒 Transaksi</h3>

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ url('/transaksi/proses') }}" id="formTransaksi">
            @csrf

            {{-- Pilih pelanggan --}}
            <label>Pelanggan</label>
            <select id="pelangganSelect" class="form-control mb-2">
                <option value="">Umum</option>
                @foreach($pelanggan as $p)
                    <option value="{{ $p->id_pelanggan }}">{{ $p->nama_pelanggan }} ({{ $p->no_hp }})</option>
                @endforeach
            </select>
            <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="">
            <small id="infoPelanggan" class="text-muted d-block mb-2">Pelanggan Umum</small>

            {{-- Keranjang --}}
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Barang</th><th>Harga</th><th width="80">Qty</th><th>Subtotal</th><th width="60">Aksi</th>
                    </tr>
                </thead>
                <tbody id="keranjang">
                    <tr><td colspan="5" class="text-center">Keranjang kosong</td></tr>
                </tbody>
            </table>

            <h5>Total: <b id="totalText">Rp 0</b></h5>
            <input type="hidden" name="total_bayar" id="total" value="0">

            <label>Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" id="bayar" class="form-control" required>

            <small id="notifKurang" class="text-danger d-none">
                ❌ Uang tidak mencukupi
            </small>

            <label class="mt-2">Kembalian</label>
            <input type="text" id="kembalian" class="form-control" readonly>

            <button type="submit" id="btnBayar" class="btn btn-success mt-3 w-100" disabled>💰 Bayar</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let keranjang = [];
    const tbody = document.getElementById('keranjang');
    const totalText = document.getElementById('totalText');
    const totalInput = document.getElementById('total');
    const bayarInput = document.getElementById('bayar');
    const kembalianInput = document.getElementById('kembalian');
    const notifKurang = document.getElementById('notifKurang');
    const btnBayar = document.getElementById('btnBayar');
    const scanInput = document.getElementById('scanBarang');
    const pelangganSelect = document.getElementById('pelangganSelect');
    const infoPelanggan = document.getElementById('infoPelanggan');
    const idPelanggan = document.getElementById('id_pelanggan');

    // Pilih pelanggan
    pelangganSelect.addEventListener('change', () => {
        const selected = pelangganSelect.options[pelangganSelect.selectedIndex];
        idPelanggan.value = selected.value;
        infoPelanggan.innerText = selected.value ? `Pelanggan: ${selected.text}` : 'Pelanggan Umum';
    });

    // Hitung kembalian & cek uang cukup
    function hitungKembalian() {
        const bayar = parseInt(bayarInput.value) || 0;
        const total = parseInt(totalInput.value) || 0;
        if (bayar < total) {
            kembalianInput.value = '';
            notifKurang.classList.remove('d-none');
            btnBayar.disabled = true;
            return false;
        } else {
            kembalianInput.value = (bayar - total).toLocaleString('id-ID');
            notifKurang.classList.add('d-none');
            btnBayar.disabled = keranjang.length === 0;
            return true;
        }
    }
    bayarInput.addEventListener('input', hitungKembalian);

    // Tambah barang
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
        renderKeranjang();
    }

    // Render keranjang
    function renderKeranjang() {
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
                    <td><input type="number" class="form-control form-control-sm input-qty" min="1" max="${item.stok}" value="${item.qty}" data-idx="${idx}"></td>
                    <td>Rp ${subtotal.toLocaleString('id-ID')}</td>
                    <td><button type="button" class="btn btn-sm btn-danger btn-hapus" data-idx="${idx}">✕</button></td>
                </tr>
                <input type="hidden" name="keranjang[${idx}][id]" value="${item.id}">
                <input type="hidden" name="keranjang[${idx}][jumlah]" value="${item.qty}">
            `;
        });

        totalText.innerText = 'Rp ' + total.toLocaleString('id-ID');
        totalInput.value = total;
        hitungKembalian();
        pasangEventInputQty();
    }

    // Event qty & hapus
    function pasangEventInputQty() {
        document.querySelectorAll('.input-qty').forEach(input => {
            input.addEventListener('change', () => {
                const idx = input.dataset.idx;
                let val = parseInt(input.value);
                if (val < 1) val = 1;
                if (val > keranjang[idx].stok) val = keranjang[idx].stok;
                keranjang[idx].qty = val;
                renderKeranjang();
            });
        });

        document.querySelectorAll('.btn-hapus').forEach(btn => {
            btn.addEventListener('click', () => {
                const idx = btn.dataset.idx;
                keranjang.splice(idx, 1);
                renderKeranjang();
            });
        });
    }

    // Tombol tambah pada table
    document.querySelectorAll('.btn-tambah').forEach(btn => {
        btn.addEventListener('click', () => tambahKeKeranjang(btn.closest('tr')));
    });

    // Scan barang
    scanInput.addEventListener('keydown', e => {
        if (e.key === 'Enter') {
            e.preventDefault();
            const id = scanInput.value.trim();
            if (!id) return;
            const tr = document.querySelector(`tr[data-id="${id}"]`);
            if (!tr) return alert('Barang tidak ditemukan');
            tambahKeKeranjang(tr);
            scanInput.value = '';
        }
    });

    // Validasi form submit
    document.getElementById('formTransaksi').addEventListener('submit', e => {
        if (keranjang.length === 0) {
            e.preventDefault();
            alert('Keranjang kosong!');
            return;
        }
        if (!hitungKembalian()) {
            e.preventDefault();
            alert('Uang tidak mencukupi!');
            return;
        }
    });
});
</script>
@endsection
