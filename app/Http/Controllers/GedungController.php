<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    public function index()
    {
        $gedungs = Gedung::withCount('kamars')->latest()->paginate(10);
        return view('gedung.index', compact('gedungs'));
    }

    public function create()
    {
        return view('gedung.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_gedung' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:20',
            'catatan' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Gedung::create($validated);

        return redirect()->route('gedung.index')->with('success', 'Gedung berhasil ditambahkan.');
    }

    public function edit(Gedung $gedung)
    {
        return view('gedung.edit', compact('gedung'));
    }

    public function update(Request $request, Gedung $gedung)
    {
        $validated = $request->validate([
            'nama_gedung' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:20',
            'catatan' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $gedung->update($validated);

        return redirect()->route('gedung.index')->with('success', 'Gedung berhasil diperbarui.');
    }

    public function destroy(Gedung $gedung)
    {
        $gedung->delete();
        return redirect()->route('gedung.index')->with('success', 'Gedung berhasil dihapus.');
    }
}