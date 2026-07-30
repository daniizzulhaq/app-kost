@extends('layouts.app')

@section('title', 'Tambah Gedung')

@section('content')
<div class="max-w-2xl">

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
        <form action="{{ route('gedung.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Nama Gedung</label>
                <input type="text" name="nama_gedung" value="{{ old('nama_gedung') }}"
                       class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500"
                       placeholder="Contoh: Gedung A">
                @error('nama_gedung')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Alamat</label>
                <textarea name="alamat" rows="3"
                          class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500"
                          placeholder="Alamat lengkap gedung">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">No. Telepon</label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                       class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500"
                       placeholder="08xxxxxxxxxx">
                @error('no_telepon')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Catatan</label>
                <textarea name="catatan" rows="2"
                          class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500"
                          placeholder="Catatan tambahan (opsional)">{{ old('catatan') }}</textarea>
                @error('catatan')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Status</label>
                <select name="status"
                        class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                    <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-amber-500 text-zinc-950 text-sm font-semibold hover:bg-amber-400 transition">
                    Simpan
                </button>
                <a href="{{ route('gedung.index') }}"
                   class="px-5 py-2.5 rounded-lg bg-zinc-800 text-zinc-300 text-sm font-semibold hover:bg-zinc-700 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection