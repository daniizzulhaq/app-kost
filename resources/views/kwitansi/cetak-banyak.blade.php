@extends('layouts.app')

@section('title', 'Cetak Banyak Kwitansi')

@section('content')
<div class="space-y-6">

    <form method="GET" action="{{ route('kwitansi.banyak.form') }}" class="flex items-center gap-2">
        <select name="status_cetak" onchange="this.form.submit()"
                class="px-3 py-2 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
            <option value="">Semua Kwitansi</option>
            <option value="belum" {{ request('status_cetak') === 'belum' ? 'selected' : '' }}>Belum Dicetak</option>
            <option value="sudah" {{ request('status_cetak') === 'sudah' ? 'selected' : '' }}>Sudah Dicetak</option>
        </select>
    </form>

    <form action="{{ route('kwitansi.banyak.proses') }}" method="POST" target="_blank">
        @csrf

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden mb-5">
            <div class="px-5 py-4 border-b border-zinc-800 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-white">Pilih Kwitansi</h3>
                <label class="flex items-center gap-2 text-xs text-zinc-400">
                    <input type="checkbox" id="checkAll" class="rounded bg-zinc-800 border-zinc-700 text-amber-500 focus:ring-amber-500/50">
                    Pilih Semua
                </label>
            </div>

            <div class="divide-y divide-zinc-800">
                @forelse($kwitansis as $k)
                    <label class="px-5 py-3 flex items-center gap-4 hover:bg-zinc-800/40 transition cursor-pointer">
                        <input type="checkbox" name="kwitansi_ids[]" value="{{ $k->id }}"
                               class="kwitansi-check rounded bg-zinc-800 border-zinc-700 text-amber-500 focus:ring-amber-500/50">
                        <div class="flex-1">
                            <p class="text-sm text-white font-medium flex items-center gap-2">
                                {{ $k->pembayaran->penyewa->nama }}
                                @if($k->sudah_dicetak)
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-zinc-700/50 text-zinc-400">Sudah Dicetak</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-emerald-500/10 text-emerald-400">Belum Dicetak</span>
                                @endif
                            </p>
                            <p class="text-xs text-zinc-500">{{ $k->pembayaran->kamar->nomor_kamar }} - {{ $k->pembayaran->kamar->gedung->nama_gedung }} · {{ $k->pembayaran->periode }}</p>
                        </div>
                        <p class="text-sm text-white">Rp{{ number_format($k->pembayaran->jumlah_dibayar, 0, ',', '.') }}</p>
                    </label>
                @empty
                    <p class="px-5 py-10 text-center text-zinc-500 text-sm">Tidak ada data kwitansi.</p>
                @endforelse
            </div>
        </div>

        @if($kwitansis->isNotEmpty())
            <div class="flex items-center gap-3">
                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-amber-500 text-zinc-950 text-sm font-semibold hover:bg-amber-400 transition">
                    Cetak Kwitansi Terpilih
                </button>
                <a href="{{ route('kwitansi.index') }}"
                   class="px-5 py-2.5 rounded-lg bg-zinc-800 text-zinc-300 text-sm font-semibold hover:bg-zinc-700 transition">
                    Batal
                </a>
            </div>
        @endif
    </form>

</div>

<script>
    const checkAll = document.getElementById('checkAll');
    const checks = document.querySelectorAll('.kwitansi-check');

    checkAll?.addEventListener('change', () => {
        checks.forEach(c => c.checked = checkAll.checked);
    });
</script>
@endsection