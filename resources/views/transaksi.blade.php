@extends('layout')

@section('konten')
<div class="row">

    {{-- ================= DATA BARANG ================= --}}
    <div class="col-5">
        <h3>📦 Data Barang</h3>

        <input type="text" id="scanBarang" class="form-control mb-2"
               placeholder="Scan / Ketik ID Barang lalu Enter" autofocus>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
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

    {{-- ================= TRANSAKSI ================= --}}
    <div class="col-7">

        <h3>🛒 Transaksi</h3>

        {{-- ===== NOTIF DI BAWAH JUDUL TRANSAKSI ===== --}}
        <div class="mb-2">
            <small id="notifKurang" class="text-danger d-none">
                ❌ Uang tidak mencukupi
            </small>
        </div>

        <form method="POST" action="{{ url('/transaksi/proses') }}" id="formTransaksi">
            @csrf

            {{-- Pelanggan --}}
            <label>Pelanggan</label>
            <select id="pelangganSelect" class="form-control mb-2">
                <option value="">Umum</option>
                @foreach($pelanggan as $p)
                    <option value="{{ $p->id_pelanggan }}">
                        {{ $p->nama_pelanggan }} ({{ $p->no_hp }})
                    </option>
                @endforeach
            </select>

            <input type="hidden" name="id_pelanggan" id="id_pelanggan">
            <small id="infoPelanggan" class="text-muted d-block mb-2">
                Pelanggan Umum
            </small>

            {{-- Keranjang --}}
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

            {{-- Total --}}
            <h5>Total: <b id="totalText">Rp 0</b></h5>
            <input type="hidden" name="total_bayar" id="total" value="0">

            <hr>

            {{-- Pembayaran --}}
            <label>Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" id="bayar"
                   class="form-control" required>

            <label class="mt-2">Kembalian</label>
            <input type="text" id="kembalian"
                   class="form-control" readonly>

            <button type="submit"
                    id="btnBayar"
                    class="btn btn-success mt-3 w-100"
                    disabled>
                💰 Bayar
            </button>
        </form>
    </div>
</div>

{{-- ================= JAVASCRIPT ================= --}}
<script>
document.addEventListener('DOMContentLoaded', () => {

    let keranjang = [];

    const tbody = document.getElementById('keranjang');
    const totalInput = document.getElementById('total');
    const totalText  = document.getElementById('totalText');
    const bayarInput = document.getElementById('bayar');
    const kembalianInput = document.getElementById('kembalian');
    const btnBayar = document.getElementById('btnBayar');

    // ================= TAMBAH BARANG =================
    document.querySelectorAll('.btn-tambah').forEach(btn => {
        btn.addEventListener('click', () => {
            const tr = btn.closest('tr');

            const id    = tr.dataset.id;
            const nama  = tr.dataset.nama;
            const harga = parseInt(tr.dataset.harga);
            const stok  = parseInt(tr.dataset.stok);

            let item = keranjang.find(i => i.id === id);

            if (item) {
                if (item.jumlah >= stok) {
                    alert('Stok tidak cukup');
                    return;
                }
                item.jumlah++;
            } else {
                if (stok < 1) {
                    alert('Stok habis');
                    return;
                }
                keranjang.push({
                    id, nama, harga, jumlah: 1, stok
                });
            }

            renderKeranjang();
        });
    });

    // ================= RENDER =================
    function renderKeranjang() {
        tbody.innerHTML = '';
        let total = 0;

        if (keranjang.length === 0) {
            tbody.innerHTML =
                `<tr><td colspan="5" align="center">Keranjang kosong</td></tr>`;
            totalInput.value = 0;
            totalText.innerText = 'Rp 0';
            btnBayar.disabled = true;
            kembalianInput.value = '';
            return;
        }

        keranjang.forEach((item, idx) => {
            const subtotal = item.harga * item.jumlah;
            total += subtotal;

            tbody.innerHTML += `
                <tr>
                    <td>${item.nama}</td>
                    <td>Rp ${item.harga.toLocaleString('id-ID')}</td>
                    <td align="center">${item.jumlah}</td>
                    <td>Rp ${subtotal.toLocaleString('id-ID')}</td>
                    <td>
                        <button type="button"
                            class="btn btn-sm btn-danger"
                            data-idx="${idx}">
                            ✕
                        </button>
                    </td>
                </tr>

                <input type="hidden" name="keranjang[${idx}][id]" value="${item.id}">
                <input type="hidden" name="keranjang[${idx}][jumlah]" value="${item.jumlah}">
            `;
        });

        totalInput.value = total;
        totalText.innerText = 'Rp ' + total.toLocaleString('id-ID');
        hitungKembalian();
        pasangHapus();
    }

    function pasangHapus() {
        document.querySelectorAll('.btn-danger').forEach(btn => {
            btn.addEventListener('click', () => {
                keranjang.splice(btn.dataset.idx, 1);
                renderKeranjang();
            });
        });
    }

    function hitungKembalian() {
        const bayar = parseInt(bayarInput.value || 0);
        const total = parseInt(totalInput.value || 0);

        if (bayar < total || total === 0) {
            btnBayar.disabled = true;
            kembalianInput.value = '';
        } else {
            btnBayar.disabled = false;
            kembalianInput.value =
                (bayar - total).toLocaleString('id-ID');
        }
    }

    bayarInput.addEventListener('input', hitungKembalian);

});
</script>
@endsection
