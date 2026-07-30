@extends('layouts.app')

@section('title', 'Edit Penyewa')

@section('content')
<div class="max-w-2xl">

    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
        <form action="{{ route('penyewa.update', $penyewa->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Kamar</label>
                <select name="kamar_id" id="kamar_id"
                        class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                    @foreach($kamars as $kamar)
                        <option value="{{ $kamar->id }}"
                                data-harian="{{ $kamar->harga_harian }}"
                                data-bulanan="{{ $kamar->harga_bulanan }}"
                                {{ old('kamar_id', $penyewa->kamar_id) == $kamar->id ? 'selected' : '' }}>
                            {{ $kamar->gedung->nama_gedung }} - {{ $kamar->nomor_kamar }} ({{ $kamar->tipe_kamar }})
                        </option>
                    @endforeach
                </select>
                @error('kamar_id')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Nama Penyewa</label>
                <input type="text" name="nama" value="{{ old('nama', $penyewa->nama) }}"
                       class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                @error('nama')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Tempat Kerja</label>
                <input type="text" name="tempat_kerja" value="{{ old('tempat_kerja', $penyewa->tempat_kerja) }}"
                       class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                @error('tempat_kerja')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-zinc-300 mb-1.5">No. Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon', $penyewa->no_telepon) }}"
                           class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                    @error('no_telepon')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-300 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email', $penyewa->email) }}"
                           class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                    @error('email')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Alamat Asal</label>
                <textarea name="alamat_asal" rows="2"
                          class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">{{ old('alamat_asal', $penyewa->alamat_asal) }}</textarea>
                @error('alamat_asal')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-zinc-300 mb-1.5">Jenis Sewa</label>
                    <select name="jenis_sewa" id="jenis_sewa"
                            class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                        <option value="Bulanan" {{ old('jenis_sewa', $penyewa->jenis_sewa) === 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="Harian" {{ old('jenis_sewa', $penyewa->jenis_sewa) === 'Harian' ? 'selected' : '' }}>Harian</option>
                    </select>
                    @error('jenis_sewa')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-300 mb-1.5">Harga Sewa</label>
                    <input type="number" name="harga_sewa" id="harga_sewa" value="{{ old('harga_sewa', $penyewa->harga_sewa) }}" step="1000" min="0"
                           class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                    @error('harga_sewa')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $penyewa->tanggal_masuk->format('Y-m-d')) }}"
                       class="w-full px-3 py-2.5 rounded-lg bg-zinc-800 border border-zinc-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                @error('tanggal_masuk')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-amber-500 text-zinc-950 text-sm font-semibold hover:bg-amber-400 transition">
                    Update
                </button>
                <a href="{{ route('penyewa.index') }}"
                   class="px-5 py-2.5 rounded-lg bg-zinc-800 text-zinc-300 text-sm font-semibold hover:bg-zinc-700 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>

<script>
    const kamarSelect = document.getElementById('kamar_id');
    const jenisSewaSelect = document.getElementById('jenis_sewa');
    const hargaInput = document.getElementById('harga_sewa');

    function updateHarga() {
        const selected = kamarSelect.options[kamarSelect.selectedIndex];
        if (!selected.value) return;
        const harian = selected.dataset.harian;
        const bulanan = selected.dataset.bulanan;
        hargaInput.value = jenisSewaSelect.value === 'Harian' ? harian : bulanan;
    }

    kamarSelect.addEventListener('change', updateHarga);
    jenisSewaSelect.addEventListener('change', updateHarga);
</script>
@endsection