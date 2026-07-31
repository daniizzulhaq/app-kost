<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class KamarController extends Controller
{
    public function index(Request $request)
    {
        $query = Kamar::with('gedung');

        if ($request->filled('gedung_id')) {
            $query->where('gedung_id', $request->gedung_id);
        }

        if ($request->filled('nomor_kamar')) {
            $query->where('nomor_kamar', 'like', '%' . $request->nomor_kamar . '%');
        }

        if ($request->filled('tipe_kamar')) {
            $query->where('tipe_kamar', $request->tipe_kamar);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sortable = ['nomor_kamar', 'gedung_id', 'harga_harian', 'harga_bulanan', 'status'];
        $sort = $request->get('sort');
        $direction = $request->get('direction', 'asc') === 'desc' ? 'desc' : 'asc';

        if ($sort && in_array($sort, $sortable)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderByDesc('id');
        }

        $kamars = $query->paginate(20);
        $gedungs = Gedung::all();
        $tipeKamars = Kamar::select('tipe_kamar')->distinct()->pluck('tipe_kamar');

        return view('kamar.index', compact('kamars', 'gedungs', 'tipeKamars'));
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
            'nomor_kamar' => [
                'required', 'string', 'max:50',
                Rule::unique('kamars')->where(fn ($q) => $q->where('gedung_id', $request->gedung_id)),
            ],
            'tipe_kamar' => 'required|in:VIP,Regular',
            'harga_harian' => 'required|numeric|min:0',
            'harga_bulanan' => 'required|numeric|min:0',
            'status' => 'required|in:KOSONG,TERISI,RENOVASI',
        ], [
            'nomor_kamar.unique' => 'Nomor kamar ini sudah digunakan di gedung yang dipilih.',
        ]);

        try {
            Kamar::create($validated);
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return back()->withInput()->withErrors([
                    'nomor_kamar' => 'Nomor kamar ini sudah digunakan di gedung yang dipilih.',
                ]);
            }
            throw $e;
        }

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
            'nomor_kamar' => [
                'required', 'string', 'max:50',
                Rule::unique('kamars')
                    ->where(fn ($q) => $q->where('gedung_id', $request->gedung_id))
                    ->ignore($kamar->id),
            ],
            'tipe_kamar' => 'required|in:VIP,Regular',
            'harga_harian' => 'required|numeric|min:0',
            'harga_bulanan' => 'required|numeric|min:0',
            'status' => 'required|in:KOSONG,TERISI,RENOVASI',
        ], [
            'nomor_kamar.unique' => 'Nomor kamar ini sudah digunakan di gedung yang dipilih.',
        ]);

        try {
            $kamar->update($validated);
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return back()->withInput()->withErrors([
                    'nomor_kamar' => 'Nomor kamar ini sudah digunakan di gedung yang dipilih.',
                ]);
            }
            throw $e;
        }

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}