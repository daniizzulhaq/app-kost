<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #1a1a1a; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        th { background: #f0f0f0; }
        tfoot td { font-weight: bold; }
    </style>
</head>
<body>
    <h2>Laporan Pembayaran</h2>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kamar</th>
                <th>Gedung</th>
                <th>Tgl Bayar</th>
                <th>Periode</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pembayarans as $p)
                <tr>
                    <td>{{ $p->penyewa->nama }}</td>
                    <td>{{ $p->kamar->nomor_kamar }}</td>
                    <td>{{ $p->kamar->gedung->nama_gedung }}</td>
                    <td>{{ $p->tanggal_bayar->format('d/m/Y') }}</td>
                    <td>{{ $p->periode }}</td>
                    <td>Rp{{ number_format($p->jumlah_dibayar, 0, ',', '.') }}</td>
                    <td>{{ $p->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
        @if($pembayarans->isNotEmpty())
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align:right;">Total</td>
                    <td colspan="2">Rp{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        @endif
    </table>
</body>
</html>