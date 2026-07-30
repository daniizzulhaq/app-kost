@extends('layouts.app')

@section('title', 'Data Penyewa')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <form method="GET" action="{{ route('penyewa.index') }}" class="flex items-center gap-2">
            <select name="status" onchange="this.form.submit()"
                    class="px-3 py-2 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                <option value="">Semua Status</option>
                <option value="AKTIF" {{ request('status') === 'AKTIF' ? 'selected' : '' }}>Aktif</option>
                <option value="TIDAK_AKTIF" {{ request('status') === 'TIDAK_AKTIF' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </form>

        <a href="{{ route('penyewa.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-500 text-zinc-950 text-sm font-semibold hover:bg-amber-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Penyewa
        </a>
    </div>

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-800 text-left">
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Nama</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Kamar</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Gedung</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Jenis Sewa</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Tgl Masuk</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @forelse($penyewas as $penyewa)
                        <tr class="hover:bg-zinc-800/40 transition">
                            <td class="px-5 py-3 text-white font-medium">{{ $penyewa->nama }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $penyewa->kamar->nomor_kamar }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $penyewa->kamar->gedung->nama_gedung }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $penyewa->jenis_sewa }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $penyewa->tanggal_masuk->format('d/m/Y') }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-1 rounded-md text-xs font-medium
                                    {{ $penyewa->status === 'AKTIF' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-zinc-700/40 text-zinc-400' }}">
                                    {{ $penyewa->status === 'AKTIF' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('penyewa.show', $penyewa->id) }}" class="text-zinc-400 hover:text-white transition text-xs font-medium">Detail</a>
                                    <a href="{{ route('penyewa.edit', $penyewa->id) }}" class="text-zinc-400 hover:text-amber-400 transition text-xs font-medium">Edit</a>
                                    @if($penyewa->status === 'AKTIF')
                                        <a href="{{ route('penyewa.keluar.form', $penyewa->id) }}" class="text-zinc-400 hover:text-red-400 transition text-xs font-medium">Keluar</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-zinc-500 text-sm">Belum ada data penyewa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($penyewas->hasPages())
        <div>
            {{ $penyewas->appends(request()->query())->links() }}
        </div>
    @endif

</div>
@endsection