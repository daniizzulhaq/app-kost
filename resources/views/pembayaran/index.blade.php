@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <form method="GET" action="{{ route('pembayaran.index') }}" class="flex items-center gap-2">
            <input type="text" name="periode" value="{{ request('periode') }}" placeholder="Cari periode (contoh: Agustus 2026)"
                   class="px-3 py-2 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 w-64">
            <button type="submit" class="px-3 py-2 rounded-lg bg-zinc-800 border border-zinc-700 text-zinc-300 text-sm hover:bg-zinc-700 transition">Cari</button>
        </form>

        <a href="{{ route('pembayaran.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-500 text-zinc-950 text-sm font-semibold hover:bg-amber-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Pembayaran
        </a>
    </div>

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-800 text-left">
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">No. Pembayaran</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Penyewa</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Kamar</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Periode</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Tgl Bayar</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @forelse($pembayarans as $p)
                        <tr class="hover:bg-zinc-800/40 transition">
                            <td class="px-5 py-3 text-white font-medium">{{ $p->nomor_pembayaran }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $p->penyewa->nama }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $p->kamar->nomor_kamar }} - {{ $p->kamar->gedung->nama_gedung }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $p->periode }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $p->tanggal_bayar->format('d/m/Y') }}</td>
                            <td class="px-5 py-3 text-white">Rp{{ number_format($p->jumlah_dibayar, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-1 rounded-md text-xs font-medium
                                    {{ $p->status === 'LUNAS' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-amber-500/10 text-amber-400' }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('pembayaran.show', $p->id) }}" class="text-zinc-400 hover:text-white transition text-xs font-medium">Detail</a>
                                    @if($p->kwitansi)
                                        <a href="{{ route('kwitansi.cetak', $p->kwitansi->id) }}" class="text-zinc-400 hover:text-amber-400 transition text-xs font-medium">Cetak Kwitansi</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-10 text-center text-zinc-500 text-sm">Belum ada data pembayaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($pembayarans->hasPages())
        <div>
            {{ $pembayarans->appends(request()->query())->links() }}
        </div>
    @endif

</div>
@endsection