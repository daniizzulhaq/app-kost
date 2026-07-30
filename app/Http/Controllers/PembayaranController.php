<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penyewa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with('penyewa', 'kamar.gedung');

        if ($request->filled('periode')) {
            $query->where('periode', 'like', '%' . $request->periode . '%');
        }

        $pembayarans = $query->latest()->paginate(15);

        return view('pembayaran.index', compact('pembayarans'));
    }

    public function create()
    {
        $penyewas = Penyewa::with('kamar.gedung')->where('status', 'AKTIF')->get();
        return view('pembayaran.create', compact('penyewas'));
    }

    public function getPenyewaData(Penyewa $penyewa)
    {
        return response()->json([
            'kamar_id' => $penyewa->kamar_id,
            'nomor_kamar' => $penyewa->kamar->nomor_kamar,
            'gedung' => $penyewa->kamar->gedung->nama_gedung,
            'jenis_sewa' => $penyewa->jenis_sewa,
            'harga_sewa' => $penyewa->harga_sewa,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'penyewa_id' => 'required|exists:penyewas,id',
            'kamar_id' => 'required|exists:kamars,id',
            'jenis_pembayaran' => 'required|in:Harian,Bulanan',
            'periode' => 'required|string|max:50',
            'tanggal_bayar' => 'required|date',
            'jumlah_tagihan' => 'required|numeric|min:0',
            'jumlah_dibayar' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran = Pembayaran::create($validated);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran tersimpan. Nomor: ' . $pembayaran->nomor_pembayaran);
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load('penyewa', 'kamar.gedung', 'kwitansi');
        return view('pembayaran.show', compact('pembayaran'));
    }
}