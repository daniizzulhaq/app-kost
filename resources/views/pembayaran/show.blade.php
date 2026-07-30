@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="max-w-2xl space-y-6">

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
        <div class="flex items-start justify-between mb-5">
            <div>
                <h2 class="text-lg font-semibold text-white">{{ $pembayaran->nomor_pembayaran }}</h2>
                <p class="text-sm text-zinc-500">{{ $pembayaran->penyewa->nama }}</p>
            </div>
            <span class="px-2 py-1 rounded-md text-xs font-medium
                {{ $pembayaran->status === 'LUNAS' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-amber-500/10 text-amber-400' }}">
                {{ $pembayaran->status }}
            </span>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-zinc-500 mb-1">Kamar</p>
                <p class="text-white">{{ $pembayaran->kamar->nomor_kamar }} - {{ $pembayaran->kamar->gedung->nama_gedung }}</p>
            </div>
            <div>
                <p class="text-zinc-500 mb-1">Jenis Pembayaran</p>
                <p class="text-white">{{ $pembayaran->jenis_pembayaran }}</p>
            </div>
            <div>
                <p class="text-zinc-500 mb-1">Periode</p>
                <p class="text-white">{{ $pembayaran->periode }}</p>
            </div>
            <div>
                <p class="text-zinc-500 mb-1">Tanggal Bayar</p>
                <p class="text-white">{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="text-zinc-500 mb-1">Jumlah Tagihan</p>
                <p class="text-white">Rp{{ number_format($pembayaran->jumlah_tagihan, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-zinc-500 mb-1">Jumlah Dibayar</p>
                <p class="text-white">Rp{{ number_format($pembayaran->jumlah_dibayar, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-zinc-500 mb-1">Sisa Tagihan</p>
                <p class="text-white">Rp{{ number_format($pembayaran->sisa_tagihan, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-zinc-500 mb-1">No. Kwitansi</p>
                <p class="text-white">{{ $pembayaran->kwitansi->nomor_kwitansi ?? '-' }}</p>
            </div>
            <div class="col-span-2">
                <p class="text-zinc-500 mb-1">Keterangan</p>
                <p class="text-white">{{ $pembayaran->keterangan ?? '-' }}</p>
            </div>
        </div>

        @if($pembayaran->kwitansi)
            <div class="mt-5 pt-5 border-t border-zinc-800">
                <a href="{{ route('kwitansi.cetak', $pembayaran->kwitansi->id) }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg bg-amber-500 text-zinc-950 text-sm font-semibold hover:bg-amber-400 transition">
                    Cetak Kwitansi
                </a>
            </div>
        @endif
    </div>

    <a href="{{ route('pembayaran.index') }}" class="inline-flex items-center text-sm text-zinc-400 hover:text-white transition">
        ← Kembali ke daftar pembayaran
    </a>

</div>
@endsection