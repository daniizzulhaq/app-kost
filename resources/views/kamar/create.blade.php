@extends('layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
<div class="max-w-2xl">

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
        <form action="{{ route('kamar.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Gedung</label>
                <select name="gedung_id"
                        class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                    <option value="">Pilih Gedung</option>
                    @foreach($gedungs as $gedung)
                        <option value="{{ $gedung->id }}" {{ old('gedung_id') == $gedung->id ? 'selected' : '' }}>
                            {{ $gedung->nama_gedung }}
                        </option>
                    @endforeach
                </select>
                @error('gedung_id')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Nomor Kamar</label>
                <input type="text" name="nomor_kamar" value="{{ old('nomor_kamar') }}"
                       class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500"
                       placeholder="Contoh: A01">
                @error('nomor_kamar')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Tipe Kamar</label>
                <select name="tipe_kamar"
                        class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                    <option value="Regular" {{ old('tipe_kamar') === 'Regular' ? 'selected' : '' }}>Regular</option>
                    <option value="VIP" {{ old('tipe_kamar') === 'VIP' ? 'selected' : '' }}>VIP</option>
                </select>
                @error('tipe_kamar')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-zinc-300 mb-1.5">Harga Harian</label>
                    <input type="number" name="harga_harian" value="{{ old('harga_harian') }}" step="1000" min="0"
                           class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500"
                           placeholder="50000">
                    @error('harga_harian')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-300 mb-1.5">Harga Bulanan</label>
                    <input type="number" name="harga_bulanan" value="{{ old('harga_bulanan') }}" step="1000" min="0"
                           class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500"
                           placeholder="800000">
                    @error('harga_bulanan')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Status</label>
                <select name="status"
                        class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                    <option value="KOSONG" {{ old('status') === 'KOSONG' ? 'selected' : '' }}>Kosong</option>
                    <option value="TERISI" {{ old('status') === 'TERISI' ? 'selected' : '' }}>Terisi</option>
                    <option value="RENOVASI" {{ old('status') === 'RENOVASI' ? 'selected' : '' }}>Renovasi</option>
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
                <a href="{{ route('kamar.index') }}"
                   class="px-5 py-2.5 rounded-lg bg-zinc-800 text-zinc-300 text-sm font-semibold hover:bg-zinc-700 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection