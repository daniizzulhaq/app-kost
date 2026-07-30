@extends('layouts.app')

@section('title', 'Data Kamar')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <form method="GET" action="{{ route('kamar.index') }}" class="flex items-center gap-2">
            <select name="gedung_id" onchange="this.form.submit()"
                    class="px-3 py-2 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                <option value="">Semua Gedung</option>
                @foreach($gedungs as $gedung)
                    <option value="{{ $gedung->id }}" {{ request('gedung_id') == $gedung->id ? 'selected' : '' }}>
                        {{ $gedung->nama_gedung }}
                    </option>
                @endforeach
            </select>
        </form>

        <a href="{{ route('kamar.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-500 text-zinc-950 text-sm font-semibold hover:bg-amber-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Kamar
        </a>
    </div>

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-800 text-left">
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Nomor Kamar</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Gedung</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Harga Harian</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Harga Bulanan</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @forelse($kamars as $kamar)
                        <tr class="hover:bg-zinc-800/40 transition">
                            <td class="px-5 py-3 text-white font-medium">{{ $kamar->nomor_kamar }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $kamar->gedung->nama_gedung }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $kamar->tipe_kamar }}</td>
                            <td class="px-5 py-3 text-zinc-400">Rp {{ number_format($kamar->harga_harian, 0, ',', '.') }}</td>
                            <td class="px-5 py-3 text-zinc-400">Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-1 rounded-md text-xs font-medium
                                    {{ $kamar->status === 'KOSONG' ? 'bg-emerald-500/10 text-emerald-400' : ($kamar->status === 'TERISI' ? 'bg-amber-500/10 text-amber-400' : 'bg-zinc-700/40 text-zinc-400') }}">
                                    {{ $kamar->status }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('kamar.edit', $kamar->id) }}" class="text-zinc-400 hover:text-white transition text-xs font-medium">Edit</a>
                                    <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kamar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-zinc-400 hover:text-red-400 transition text-xs font-medium">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-zinc-500 text-sm">Belum ada data kamar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($kamars->hasPages())
        <div>
            {{ $kamars->appends(request()->query())->links() }}
        </div>
    @endif

</div>
@endsection