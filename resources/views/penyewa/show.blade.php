@extends('layouts.app')

@section('title', 'Detail Penyewa')

@section('content')
<div class="space-y-6 max-w-3xl">

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
        <div class="flex items-start justify-between mb-5">
            <div>
                <h2 class="text-lg font-semibold text-white">{{ $penyewa->nama }}</h2>
                <p class="text-sm text-zinc-500">{{ $penyewa->kamar->gedung->nama_gedung }} - Kamar {{ $penyewa->kamar->nomor_kamar }}</p>
            </div>
            <span class="px-2 py-1 rounded-md text-xs font-medium
                {{ $penyewa->status === 'AKTIF' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-zinc-700/40 text-zinc-400' }}">
                {{ $penyewa->status === 'AKTIF' ? 'Aktif' : 'Tidak Aktif' }}
            </span>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-zinc-500 mb-1">Tempat Kerja</p>
                <p class="text-white">{{ $penyewa->tempat_kerja ?? '-' }}</p>
            </div>
            <div>
                <p class="text-zinc-500 mb-1">No. Telepon</p>
                <p class="text-white">{{ $penyewa->no_telepon ?? '-' }}</p>
            </div>
            <div>
                <p class="text-zinc-500 mb-1">Email</p>
                <p class="text-white">{{ $penyewa->email ?? '-' }}</p>
            </div>
            <div>
                <p class="text-zinc-500 mb-1">Jenis Sewa</p>
                <p class="text-white">{{ $penyewa->jenis_sewa }} - Rp{{ number_format($penyewa->harga_sewa, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-zinc-500 mb-1">Tanggal Masuk</p>
                <p class="text-white">{{ $penyewa->tanggal_masuk->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="text-zinc-500 mb-1">Tanggal Keluar</p>
                <p class="text-white">{{ $penyewa->tanggal_keluar ? $penyewa->tanggal_keluar->format('d/m/Y') : '-' }}</p>
            </div>
            <div class="col-span-2">
                <p class="text-zinc-500 mb-1">Alamat Asal</p>
                <p class="text-white">{{ $penyewa->alamat_asal ?? '-' }}</p>
            </div>
        </div>

        @if($penyewa->status === 'AKTIF')
            <div class="mt-5 pt-5 border-t border-zinc-800">
                <a href="{{ route('penyewa.keluar.form', $penyewa->id) }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg bg-red-500/10 text-red-400 text-sm font-semibold hover:bg-red-500/20 transition">
                    Proses Penyewa Keluar
                </a>
            </div>
        @endif
    </div>

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden">
        <div class="px-5 py-4 border-b border-zinc-800">
            <h3 class="text-sm font-semibold text-white">Riwayat Pembayaran</h3>
        </div>
        <div class="divide-y divide-zinc-800">
            @forelse($penyewa->pembayarans as $p)
                <div class="px-5 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-white font-medium">{{ $p->periode }}</p>
                        <p class="text-xs text-zinc-500">{{ $p->tanggal_bayar->format('d/m/Y') }} · {{ $p->nomor_pembayaran }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-white">Rp{{ number_format($p->jumlah_dibayar, 0, ',', '.') }}</p>
                        <p class="text-xs {{ $p->status === 'LUNAS' ? 'text-emerald-400' : 'text-amber-400' }}">{{ $p->status }}</p>
                    </div>
                </div>
            @empty
                <p class="px-5 py-6 text-sm text-zinc-500 text-center">Belum ada riwayat pembayaran</p>
            @endforelse
        </div>
    </div>

    <a href="{{ route('penyewa.index') }}" class="inline-flex items-center text-sm text-zinc-400 hover:text-white transition">
        ← Kembali ke daftar penyewa
    </a>

</div>
@endsection