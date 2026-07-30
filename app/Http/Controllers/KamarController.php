<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index(Request $request)
    {
        $query = Kamar::with('gedung');

        if ($request->filled('gedung_id')) {
            $query->where('gedung_id', $request->gedung_id);
        }

        $kamars = $query->latest()->paginate(15);
        $gedungs = Gedung::where('status', 'aktif')->get();

        return view('kamar.index', compact('kamars', 'gedungs'));
    }

    public function create()
    {
        $gedungs = Gedung::where('status', 'aktif')->get();
        return view('kamar.create', compact('gedungs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gedung_id' => 'required|exists:gedungs,id',
            'nomor_kamar' => 'required|string|max:50',
            'tipe_kamar' => 'required|in:VIP,Regular',
            'harga_harian' => 'required|numeric|min:0',
            'harga_bulanan' => 'required|numeric|min:0',
            'status' => 'required|in:KOSONG,TERISI,RENOVASI',
        ]);

        Kamar::create($validated);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function edit(Kamar $kamar)
    {
        $gedungs = Gedung::where('status', 'aktif')->get();
        return view('kamar.edit', compact('kamar', 'gedungs'));
    }

    public function update(Request $request, Kamar $kamar)
    {
        $validated = $request->validate([
            'gedung_id' => 'required|exists:gedungs,id',
            'nomor_kamar' => 'required|string|max:50',
            'tipe_kamar' => 'required|in:VIP,Regular',
            'harga_harian' => 'required|numeric|min:0',
            'harga_bulanan' => 'required|numeric|min:0',
            'status' => 'required|in:KOSONG,TERISI,RENOVASI',
        ]);

        $kamar->update($validated);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}