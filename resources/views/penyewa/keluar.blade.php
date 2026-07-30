@extends('layouts.app')

@section('title', 'Penyewa Keluar')

@section('content')
<div class="max-w-2xl">

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
        <div class="mb-5">
            <h2 class="text-lg font-semibold text-white">{{ $penyewa->nama }}</h2>
            <p class="text-sm text-zinc-500">{{ $penyewa->kamar->gedung->nama_gedung }} - Kamar {{ $penyewa->kamar->nomor_kamar }}</p>
            <p class="text-sm text-zinc-500">Masuk: {{ $penyewa->tanggal_masuk->format('d/m/Y') }}</p>
        </div>

        <form action="{{ route('penyewa.keluar.proses', $penyewa->id) }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Tanggal Keluar</label>
                <input type="date" name="tanggal_keluar" value="{{ old('tanggal_keluar', date('Y-m-d')) }}"
                       min="{{ $penyewa->tanggal_masuk->format('Y-m-d') }}"
                       class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                @error('tanggal_keluar')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="px-4 py-3 rounded-lg bg-amber-500/10 border border-amber-500/20 text-amber-400 text-sm">
                Kamar {{ $penyewa->kamar->nomor_kamar }} akan otomatis berstatus KOSONG setelah proses ini disimpan.
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-red-500/10 text-red-400 text-sm font-semibold hover:bg-red-500/20 transition">
                    Proses Keluar
                </button>
                <a href="{{ route('penyewa.show', $penyewa->id) }}"
                   class="px-5 py-2.5 rounded-lg bg-zinc-800 text-zinc-300 text-sm font-semibold hover:bg-zinc-700 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection