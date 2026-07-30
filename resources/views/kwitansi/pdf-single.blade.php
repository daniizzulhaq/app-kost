<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Times New Roman', serif;
            font-size: 13px;
            color: #1a1a3a;
            margin: 0;
            padding: 30px;
        }
        .kwitansi {
            max-width: 680px;
            margin: 0 auto;
            border: 2px solid #1a1a1a;
            padding: 22px 30px;
            background-color: #f0e6d2;
        }
        .header-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        .header-row .logo {
            height: 55px;
        }
        .header-row .logo img {
            height: 55px;
            width: auto;
            display: block;
        }
        .header-row .no-row {
            font-size: 13px;
            text-align: right;
            padding-top: 8px;
        }
        .header-row .no-row .garis {
            border-bottom: 1px dotted #1a1a1a;
            display: inline-block;
            min-width: 140px;
            padding: 0 4px;
            font-weight: bold;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        .info-table td {
            padding: 8px 0;
            vertical-align: bottom;
            font-size: 13px;
        }
        .info-table .label {
            width: 26%;
            white-space: nowrap;
            font-style: italic;
        }
        .info-table .titik {
            width: 3%;
        }
        .info-table .isian {
            border-bottom: 1px dotted #1a1a1a;
            font-weight: bold;
        }
        .tanggal-row {
            text-align: right;
            font-weight: bold;
            margin-top: 22px;
            margin-bottom: 20px;
            font-size: 13px;
        }
        .bottom-section {
            width: 100%;
            border-collapse: collapse;
        }
        .bottom-section td {
            vertical-align: middle;
        }
        .bottom-section .kiri {
            width: 40%;
            font-style: italic;
            font-size: 14px;
        }
        .bottom-section .kiri .rp-value {
            border-bottom: 1px solid #1a1a1a;
            display: inline-block;
            min-width: 130px;
            font-weight: bold;
            font-style: normal;
            padding: 0 6px 2px;
        }
        .bottom-section .kanan {
            width: 60%;
            text-align: right;
        }
        .ttd-space {
            height: 70px;
        }
        .ttd-nama {
            font-weight: bold;
            font-size: 14px;
        }
        .ttd-kontak {
            font-size: 12px;
            font-weight: bold;
            margin-top: 3px;
        }
    </style>
</head>
<body>
    <div class="kwitansi">

        <div class="header-row">
            <div class="logo">
                @if($logoData)
                    <img src="{{ $logoData }}" alt="Logo">
                @endif
            </div>
            <div class="no-row">
                No. <span class="garis">{{ $kwitansi->nomor_kwitansi }}</span>
            </div>
        </div>

        <table class="info-table">
            <tr>
                <td class="label">Telah terima dari</td>
                <td class="titik">:</td>
                <td class="isian">{{ $kwitansi->pembayaran->penyewa->nama }}</td>
            </tr>
            <tr>
                <td class="label">Uang sejumlah</td>
                <td class="titik">:</td>
                <td class="isian">{{ ucwords(\App\Helpers\Terbilang::make($kwitansi->pembayaran->jumlah_dibayar)) }} Rupiah</td>
            </tr>
            <tr>
                <td class="label">Untuk pembayaran</td>
                <td class="titik">:</td>
                <td class="isian">
                    Kost Bulan {{ $kwitansi->pembayaran->periode }}
                </td>
            </tr>
        </table>

        <div class="tanggal-row">
            {{ $kwitansi->lokasi ?? 'Sangatta' }}, {{ $kwitansi->pembayaran->tanggal_bayar->format('d F Y') }}
        </div>

        <table class="bottom-section">
            <tr>
                <td class="kiri">
                    Rp. <span class="rp-value">{{ number_format($kwitansi->pembayaran->jumlah_dibayar, 0, ',', '.') }}</span>
                </td>
                <td class="kanan">
                    <div class="ttd-space"></div>
                    <div class="ttd-nama">{{ $kwitansi->diterima_oleh ?? 'Ibu Agus' }}</div>
                    <div class="ttd-kontak">{{ $kwitansi->kontak_penerima ?? '0812-5481-2785' }}</div>
                </td>
            </tr>
        </table>

    </div>
</body>
</html>