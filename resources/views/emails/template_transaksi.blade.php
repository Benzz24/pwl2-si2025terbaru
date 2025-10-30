<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi #{{ $transaksi->id }}</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background:#f7f9fc; color:#333; margin:0; padding:0; }
        .container { max-width:700px; margin:30px auto; background:#fff; border-radius:12px; box-shadow:0 3px 8px rgba(0,0,0,0.08); padding:24px; }
        h1 { color:#007bff; text-align:center; margin-bottom:16px; font-size:22px; }
        .info p { margin:6px 0; }
        .label { display:inline-block; width:160px; color:#555; font-weight:600; }
        table { width:100%; border-collapse:collapse; margin-top:18px; }
        th { text-align:left; background:#e9f2ff; padding:10px; font-weight:600; }
        td { padding:10px; border-bottom:1px solid #eee; }
        .total { text-align:right; margin-top:18px; font-size:1.2em; color:#007bff; font-weight:700; }
        .footer { text-align:center; color:#888; margin-top:20px; font-size:13px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Transaksi #{{ $transaksi->id }}</h1>

        <div class="info">
            <p><span class="label">Tanggal:</span> {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }}</p>
            <p><span class="label">Kasir:</span> {{ $transaksi->kasir ?? 'Admin' }}</p>
            <p><span class="label">Pembeli:</span> {{ $transaksi->nama_pembeli ?? '-' }}</p>
            <p><span class="label">Metode Pembayaran:</span> {{ $transaksi->metode_pembayaran ?? '-' }}</p>
        </div>

        <h3>Item yang Dibeli</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @forelse($details as $detail)
                    @php
                        $harga = $detail->product->price ?? 0;
                        $jumlah = $detail->jumlah_pembelian ?? 0;
                        $subtotal = $harga * $jumlah;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $detail->product->name ?? 'Produk tidak ditemukan' }}</td>
                        <td>{{ $jumlah }}</td>
                        <td>Rp {{ number_format($harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:#888;">Tidak ada item pada transaksi ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="total">
            Total Tagihan: Rp {{ number_format($total, 0, ',', '.') }}
        </div>

        <div class="footer">
            Terima kasih telah bertransaksi di <strong>Mofu Café</strong>.
        </div>
    </div>
</body>
</html>
