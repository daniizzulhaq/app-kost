@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    <!-- Stat Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5">
            <p class="text-xs text-zinc-500 mb-1">Total Kamar</p>
            <p class="text-2xl font-bold text-white">{{ $totalKamar }}</p>
        </div>
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5">
            <p class="text-xs text-zinc-500 mb-1">Kamar Kosong</p>
            <p class="text-2xl font-bold text-white">{{ $kamarKosong }}</p>
        </div>
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5">
            <p class="text-xs text-zinc-500 mb-1">Kamar Terisi</p>
            <p class="text-2xl font-bold text-white">{{ $kamarTerisi }}</p>
        </div>
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5">
            <p class="text-xs text-zinc-500 mb-1">Penyewa Aktif</p>
            <p class="text-2xl font-bold text-white">{{ $totalPenyewa }}</p>
        </div>
    </div>

    <!-- Pendapatan -->
    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5">
        <p class="text-xs text-zinc-500 mb-1">Pendapatan Bulan Ini</p>
        <p class="text-3xl font-bold text-amber-400">Rp{{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        <!-- Pembayaran Terbaru -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden">
            <div class="px-5 py-4 border-b border-zinc-800">
                <h3 class="text-sm font-semibold text-white">Pembayaran Terbaru</h3>
            </div>
            <div class="divide-y divide-zinc-800">
                @forelse($pembayaranTerbaru as $p)
                    <div class="px-5 py-3 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-white font-medium">{{ $p->penyewa->nama }}</p>
                            <p class="text-xs text-zinc-500">{{ $p->kamar->nomor_kamar }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-white">Rp{{ number_format($p->jumlah_dibayar, 0, ',', '.') }}</p>
                            <p class="text-xs {{ $p->status === 'LUNAS' ? 'text-emerald-400' : 'text-amber-400' }}">{{ $p->status }}</p>
                        </div>
                    </div>
                @empty
                    <p class="px-5 py-6 text-sm text-zinc-500 text-center">Belum ada pembayaran</p>
                @endforelse
            </div>
        </div>

        <!-- Kwitansi Belum Dicetak -->
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden">
            <div class="px-5 py-4 border-b border-zinc-800 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-white">Kwitansi Belum Dicetak</h3>
                @if($kwitansiBelumDicetak->count())
                    <a href="{{ route('kwitansi.banyak.form') }}" class="text-xs text-amber-400 hover:text-amber-300 font-medium">Cetak Semua</a>
                @endif
            </div>
            <div class="divide-y divide-zinc-800">
                @forelse($kwitansiBelumDicetak as $k)
                    <div class="px-5 py-3 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-white font-medium">{{ $k->pembayaran->penyewa->nama }}</p>
                            <p class="text-xs text-zinc-500">{{ $k->nomor_kwitansi }}</p>
                        </div>
                        <a href="{{ route('kwitansi.cetak', $k->id) }}" class="text-xs text-zinc-400 hover:text-white">Cetak →</a>
                    </div>
                @empty
                    <p class="px-5 py-6 text-sm text-zinc-500 text-center">Semua kwitansi sudah dicetak</p>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection