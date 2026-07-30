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
            {{-- Preserve sort params when filtering --}}
            <input type="hidden" name="sort" value="{{ request('sort') }}">
            <input type="hidden" name="direction" value="{{ request('direction') }}">
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
                        @php
                            $sort = request('sort');
                            $direction = request('direction', 'asc');
                            $nextDirection = ($sort && $direction === 'asc') ? 'desc' : 'asc';

                            function sortIcon($column, $sort, $direction) {
                                if ($sort !== $column) {
                                    return '<svg class="w-3 h-3 inline-block opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" /></svg>';
                                }
                                if ($direction === 'asc') {
                                    return '<svg class="w-3 h-3 inline-block text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 15l4-4 4 4" /></svg>';
                                }
                                return '<svg class="w-3 h-3 inline-block text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4 4 4-4" /></svg>';
                            }
                        @endphp

                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                            <a href="{{ route('kamar.index', array_merge(request()->except(['sort','direction']), ['sort' => 'nomor_kamar', 'direction' => $sort === 'nomor_kamar' ? $nextDirection : 'asc'])) }}"
                               class="flex items-center gap-1 hover:text-white transition">
                                Nomor Kamar {!! sortIcon('nomor_kamar', $sort, $direction) !!}
                            </a>
                        </th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                            <a href="{{ route('kamar.index', array_merge(request()->except(['sort','direction']), ['sort' => 'gedung_id', 'direction' => $sort === 'gedung_id' ? $nextDirection : 'asc'])) }}"
                               class="flex items-center gap-1 hover:text-white transition">
                                Gedung {!! sortIcon('gedung_id', $sort, $direction) !!}
                            </a>
                        </th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                            <a href="{{ route('kamar.index', array_merge(request()->except(['sort','direction']), ['sort' => 'harga_harian', 'direction' => $sort === 'harga_harian' ? $nextDirection : 'asc'])) }}"
                               class="flex items-center gap-1 hover:text-white transition">
                                Harga Harian {!! sortIcon('harga_harian', $sort, $direction) !!}
                            </a>
                        </th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                            <a href="{{ route('kamar.index', array_merge(request()->except(['sort','direction']), ['sort' => 'harga_bulanan', 'direction' => $sort === 'harga_bulanan' ? $nextDirection : 'asc'])) }}"
                               class="flex items-center gap-1 hover:text-white transition">
                                Harga Bulanan {!! sortIcon('harga_bulanan', $sort, $direction) !!}
                            </a>
                        </th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                            <a href="{{ route('kamar.index', array_merge(request()->except(['sort','direction']), ['sort' => 'status', 'direction' => $sort === 'status' ? $nextDirection : 'asc'])) }}"
                               class="flex items-center gap-1 hover:text-white transition">
                                Status {!! sortIcon('status', $sort, $direction) !!}
                            </a>
                        </th>
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