@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')
<div class="max-w-2xl">

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
        <form action="{{ route('pembayaran.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Pilih Penyewa</label>
                <select name="penyewa_id" id="penyewa_id"
                        class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                    <option value="">Pilih Penyewa</option>
                    @foreach($penyewas as $penyewa)
                        <option value="{{ $penyewa->id }}"
                                data-kamar-id="{{ $penyewa->kamar_id }}"
                                data-nomor-kamar="{{ $penyewa->kamar->nomor_kamar }}"
                                data-gedung="{{ $penyewa->kamar->gedung->nama_gedung }}"
                                data-jenis-sewa="{{ $penyewa->jenis_sewa }}"
                                data-harga="{{ $penyewa->harga_sewa }}"
                                {{ old('penyewa_id') == $penyewa->id ? 'selected' : '' }}>
                            {{ $penyewa->nama }} - {{ $penyewa->kamar->nomor_kamar }} ({{ $penyewa->kamar->gedung->nama_gedung }})
                        </option>
                    @endforeach
                </select>
                @error('penyewa_id')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
                @if($penyewas->isEmpty())
                    <p class="mt-1 text-xs text-amber-400">Tidak ada penyewa aktif saat ini.</p>
                @endif
            </div>

            <input type="hidden" name="kamar_id" id="kamar_id" value="{{ old('kamar_id') }}">

            <div id="info_kamar" class="hidden px-4 py-3 rounded-lg bg-zinc-800/60 border border-zinc-700 text-sm text-zinc-300">
                <p>Kamar: <span id="info_nomor_kamar" class="text-white font-medium"></span></p>
                <p>Gedung: <span id="info_gedung" class="text-white font-medium"></span></p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-zinc-300 mb-1.5">Jenis Pembayaran</label>
                    <select name="jenis_pembayaran" id="jenis_pembayaran"
                            class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                        <option value="Bulanan" {{ old('jenis_pembayaran') === 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="Harian" {{ old('jenis_pembayaran') === 'Harian' ? 'selected' : '' }}>Harian</option>
                    </select>
                    @error('jenis_pembayaran')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-300 mb-1.5">Periode</label>
                    <input type="text" name="periode" id="periode" value="{{ old('periode') }}"
                           class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500"
                           placeholder="Agustus 2026">
                    @error('periode')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Tanggal Bayar</label>
                <input type="date" name="tanggal_bayar" value="{{ old('tanggal_bayar', date('Y-m-d')) }}"
                       class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                @error('tanggal_bayar')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-zinc-300 mb-1.5">Jumlah Tagihan</label>
                    <input type="number" name="jumlah_tagihan" id="jumlah_tagihan" value="{{ old('jumlah_tagihan') }}" step="1000" min="0"
                           class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500"
                           placeholder="800000">
                    @error('jumlah_tagihan')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-300 mb-1.5">Jumlah Dibayar</label>
                    <input type="number" name="jumlah_dibayar" id="jumlah_dibayar" value="{{ old('jumlah_dibayar') }}" step="1000" min="0"
                           class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500"
                           placeholder="800000">
                    @error('jumlah_dibayar')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <p class="text-xs text-zinc-500">Jika jumlah dibayar kurang dari tagihan, status otomatis menjadi SEBAGIAN.</p>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Keterangan</label>
                <textarea name="keterangan" rows="2"
                          class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500"
                          placeholder="Contoh: Pembayaran kost bulan Agustus (opsional)">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-amber-500 text-zinc-950 text-sm font-semibold hover:bg-amber-400 transition">
                    Simpan Pembayaran
                </button>
                <a href="{{ route('pembayaran.index') }}"
                   class="px-5 py-2.5 rounded-lg bg-zinc-800 text-zinc-300 text-sm font-semibold hover:bg-zinc-700 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>

<script>
    const penyewaSelect = document.getElementById('penyewa_id');
    const kamarIdInput = document.getElementById('kamar_id');
    const infoKamar = document.getElementById('info_kamar');
    const infoNomorKamar = document.getElementById('info_nomor_kamar');
    const infoGedung = document.getElementById('info_gedung');
    const jenisPembayaranSelect = document.getElementById('jenis_pembayaran');
    const jumlahTagihan = document.getElementById('jumlah_tagihan');
    const jumlahDibayar = document.getElementById('jumlah_dibayar');

    function updateFromPenyewa() {
        const selected = penyewaSelect.options[penyewaSelect.selectedIndex];
        if (!selected.value) {
            infoKamar.classList.add('hidden');
            return;
        }

        kamarIdInput.value = selected.dataset.kamarId;
        infoNomorKamar.textContent = selected.dataset.nomorKamar;
        infoGedung.textContent = selected.dataset.gedung;
        infoKamar.classList.remove('hidden');

        jenisPembayaranSelect.value = selected.dataset.jenisSewa;
        jumlahTagihan.value = selected.dataset.harga;
        jumlahDibayar.value = selected.dataset.harga;
    }

    penyewaSelect.addEventListener('change', updateFromPenyewa);
    window.addEventListener('DOMContentLoaded', updateFromPenyewa);
</script>
@endsection