@extends('layouts.app')

@section('title', 'Semua Kwitansi')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <form method="GET" action="{{ route('kwitansi.index') }}" class="flex items-center gap-2">
            <select name="status" onchange="this.form.submit()"
                    class="px-3 py-2 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                <option value="">Semua Status</option>
                <option value="dicetak" {{ request('status') === 'dicetak' ? 'selected' : '' }}>Sudah Dicetak</option>
                <option value="belum" {{ request('status') === 'belum' ? 'selected' : '' }}>Belum Dicetak</option>
            </select>
        </form>

        <a href="{{ route('kwitansi.banyak.form') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-500 text-zinc-950 text-sm font-semibold hover:bg-amber-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            Cetak Banyak Kwitansi
        </a>
    </div>

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-800 text-left">
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">No. Kwitansi</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Penyewa</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Kamar</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Periode</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status Cetak</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @forelse($kwitansis as $k)
                        <tr class="hover:bg-zinc-800/40 transition">
                            <td class="px-5 py-3 text-white font-medium">{{ $k->nomor_kwitansi }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $k->pembayaran->penyewa->nama }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $k->pembayaran->kamar->nomor_kamar }} - {{ $k->pembayaran->kamar->gedung->nama_gedung }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $k->pembayaran->periode }}</td>
                            <td class="px-5 py-3 text-white">Rp{{ number_format($k->pembayaran->jumlah_dibayar, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-1 rounded-md text-xs font-medium
                                    {{ $k->sudah_dicetak ? 'bg-emerald-500/10 text-emerald-400' : 'bg-amber-500/10 text-amber-400' }}">
                                    {{ $k->sudah_dicetak ? 'Sudah Dicetak' : 'Belum Dicetak' }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-3">
                                   <a href="{{ route('kwitansi.cetak', $k->id) }}" target="_blank" 
   class="text-zinc-400 hover:text-amber-400 transition text-xs font-medium">Cetak</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-zinc-500 text-sm">Belum ada data kwitansi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($kwitansis->hasPages())
        <div>
            {{ $kwitansis->appends(request()->query())->links() }}
        </div>
    @endif

</div>
@endsection