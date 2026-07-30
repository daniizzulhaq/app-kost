<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Kamar;
use App\Models\Penyewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyewaController extends Controller
{
    public function index(Request $request)
    {
        $query = Penyewa::with('kamar.gedung');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('gedung_id')) {
            $query->whereHas('kamar', function ($q) use ($request) {
                $q->where('gedung_id', $request->gedung_id);
            });
        }

        $penyewas = $query->latest()->paginate(15);
        $gedungs = Gedung::all();

        return view('penyewa.index', compact('penyewas', 'gedungs'));
    }

    public function create()
    {
        $kamars = Kamar::with('gedung')->where('status', 'KOSONG')->get();
        return view('penyewa.create', compact('kamars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'nama' => 'required|string|max:255',
            'tempat_kerja' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat_asal' => 'nullable|string',
            'jenis_sewa' => 'required|in:Harian,Bulanan',
            'harga_sewa' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date',
        ]);

        DB::transaction(function () use ($validated) {
            $validated['status'] = 'AKTIF';
            Penyewa::create($validated);

            Kamar::where('id', $validated['kamar_id'])->update(['status' => 'TERISI']);
        });

        return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil ditambahkan, kamar sekarang TERISI.');
    }

    public function show(Penyewa $penyewa)
    {
        $penyewa->load('kamar.gedung', 'pembayarans');
        return view('penyewa.show', compact('penyewa'));
    }

    public function formKeluar(Penyewa $penyewa)
    {
        return view('penyewa.keluar', compact('penyewa'));
    }

    public function edit(Penyewa $penyewa)
    {
        $kamars = Kamar::with('gedung')
            ->where(function ($q) use ($penyewa) {
                $q->where('status', 'KOSONG')->orWhere('id', $penyewa->kamar_id);
            })
            ->get();

        return view('penyewa.edit', compact('penyewa', 'kamars'));
    }

    public function update(Request $request, Penyewa $penyewa)
    {
        $validated = $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'nama' => 'required|string|max:255',
            'tempat_kerja' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat_asal' => 'nullable|string',
            'jenis_sewa' => 'required|in:Harian,Bulanan',
            'harga_sewa' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date',
        ]);

        DB::transaction(function () use ($validated, $penyewa) {
            $kamarLama = $penyewa->kamar_id;

            $penyewa->update($validated);

            if ($kamarLama != $validated['kamar_id']) {
                Kamar::where('id', $kamarLama)->update(['status' => 'KOSONG']);
                Kamar::where('id', $validated['kamar_id'])->update(['status' => 'TERISI']);
            }
        });

        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil diperbarui.');
    }

    public function prosesKeluar(Request $request, Penyewa $penyewa)
    {
        $validated = $request->validate([
            'tanggal_keluar' => 'required|date|after_or_equal:' . $penyewa->tanggal_masuk->format('Y-m-d'),
        ]);

        DB::transaction(function () use ($validated, $penyewa) {
            $penyewa->update([
                'tanggal_keluar' => $validated['tanggal_keluar'],
                'status' => 'TIDAK_AKTIF',
            ]);

            $penyewa->kamar->update(['status' => 'KOSONG']);
        });

        return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil dikeluarkan, kamar sekarang KOSONG.');
    }
}