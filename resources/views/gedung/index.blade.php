@extends('layouts.app')

@section('title', 'Data Gedung')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <p class="text-sm text-zinc-500">Kelola daftar gedung kost</p>
        <a href="{{ route('gedung.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-500 text-zinc-950 text-sm font-semibold hover:bg-amber-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Gedung
        </a>
    </div>

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-800 text-left">
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Nama Gedung</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">No. Telepon</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Jml Kamar</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-xs font-semibold text-zinc-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @forelse($gedungs as $gedung)
                        <tr class="hover:bg-zinc-800/40 transition">
                            <td class="px-5 py-3 text-white font-medium">{{ $gedung->nama_gedung }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $gedung->alamat ?? '-' }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $gedung->no_telepon ?? '-' }}</td>
                            <td class="px-5 py-3 text-zinc-400">{{ $gedung->kamars_count }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-1 rounded-md text-xs font-medium
                                    {{ $gedung->status === 'aktif' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-zinc-700/40 text-zinc-400' }}">
                                    {{ ucfirst($gedung->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('gedung.edit', $gedung->id) }}" class="text-zinc-400 hover:text-amber-400 transition text-xs font-medium">Edit</a>
                                    <form action="{{ route('gedung.destroy', $gedung->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus gedung ini? Semua kamar di dalamnya juga akan terhapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-zinc-400 hover:text-red-400 transition text-xs font-medium">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-zinc-500 text-sm">Belum ada data gedung.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($gedungs->hasPages())
        <div>
            {{ $gedungs->links() }}
        </div>
    @endif

</div>
@endsection