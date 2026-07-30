@extends('layouts.app')

@section('title', 'Laporan Pembayaran')

@section('content')
<div class="space-y-6">

    <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-col sm:flex-row sm:items-center gap-3">
        <select name="gedung_id" class="px-3 py-2 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
            <option value="">Semua Gedung</option>
            @foreach($gedungs as $gedung)
                <option value="{{ $gedung->id }}" {{ request('gedung_id') == $gedung->id ? 'selected' : '' }}>
                    {{ $gedung->nama_gedung }}
                </option>
            @endforeach
        </select>

        <input type="text" name="periode" value="{{ request('periode') }}" placeholder="Periode (contoh: Agustus 2026)"
               class="px-3 py-2 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 w-56">

        <button type="submit" class="px-4 py-2 rounded-lg bg-zinc-800 border border-zinc-700 text-zinc-300 text-sm hover:bg-zinc-700 transition">
            Filter
        </button>

        <div class="flex items-center gap-2 sm:ml-auto">
            <a href="{{ route('laporan.pdf', request()->query()) }}" target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-zinc-800 border border-zinc-700 text-zinc-300 text-sm font-medium hover:bg-zinc-700 transition">
                Export PDF
            </a>
            <a href="{{ route('laporan.excel', request()->query()) }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-500 text-zinc-950 text-sm font-semibold hover:bg-amber-400 transition">
                Export Excel
            </a>
        </div>
    </form>

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-800 text-left">
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Nama</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Kamar</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Gedung</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Tgl Bayar</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Periode</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @forelse($pembayarans as $p)
                        <tr class="hover:bg-zinc-800/40 transition">
                            <td class="px-5 py-3 text-white font-medium">{{ $p->penyewa->nama }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $p->kamar->nomor_kamar }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $p->kamar->gedung->nama_gedung }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $p->tanggal_bayar->format('d/m/Y') }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $p->periode }}</td>
                            <td class="px-5 py-3 text-white">Rp{{ number_format($p->jumlah_dibayar, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-1 rounded-md text-xs font-medium
                                    {{ $p->status === 'LUNAS' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-amber-500/10 text-amber-400' }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-zinc-500 text-sm">Tidak ada data untuk filter ini.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if($pembayarans->isNotEmpty())
                    <tfoot>
                        <tr class="border-t border-zinc-800">
                            <td colspan="5" class="px-5 py-3 text-right text-sm text-zinc-400 font-medium">Total</td>
                            <td colspan="2" class="px-5 py-3 text-white font-semibold">Rp{{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

</div>
@endsection