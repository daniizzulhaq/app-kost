<?php

namespace App\Http\Controllers;

use App\Models\Kwitansi;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KwitansiController extends Controller
{
    public function index(Request $request)
    {
        $query = Kwitansi::with('pembayaran.penyewa', 'pembayaran.kamar.gedung');

        if ($request->filled('status')) {
            $query->where('sudah_dicetak', $request->status === 'dicetak');
        }

        $kwitansis = $query->latest()->paginate(15);

        return view('kwitansi.index', compact('kwitansis'));
    }

    public function cetakSatu(Kwitansi $kwitansi)
    {
        $kwitansi->load('pembayaran.penyewa', 'pembayaran.kamar.gedung');

        $pdf = Pdf::loadView('kwitansi.pdf-single', compact('kwitansi'));

        $kwitansi->update([
            'sudah_dicetak' => true,
            'tanggal_cetak' => now(),
        ]);

        return $pdf->stream('kwitansi-' . $kwitansi->nomor_kwitansi . '.pdf');
    }

    public function formCetakBanyak(Request $request)
{
    $query = Kwitansi::with('pembayaran.penyewa', 'pembayaran.kamar.gedung');

    if ($request->status_cetak === 'belum') {
        $query->where('sudah_dicetak', false);
    } elseif ($request->status_cetak === 'sudah') {
        $query->where('sudah_dicetak', true);
    }

    $kwitansis = $query->latest()->get();

    return view('kwitansi.cetak-banyak', compact('kwitansis'));
}

    public function prosesCetakBanyak(Request $request)
    {
        $validated = $request->validate([
            'kwitansi_ids' => 'required|array|min:1',
            'kwitansi_ids.*' => 'exists:kwitansis,id',
        ]);

        $kwitansis = Kwitansi::with('pembayaran.penyewa', 'pembayaran.kamar.gedung')
            ->whereIn('id', $validated['kwitansi_ids'])
            ->get();

        // Bagi 3 kwitansi per halaman A4, sesuai flow
        $groups = $kwitansis->chunk(3);

        $pdf = Pdf::loadView('kwitansi.pdf-banyak', compact('groups'));

        Kwitansi::whereIn('id', $validated['kwitansi_ids'])->update([
            'sudah_dicetak' => true,
            'tanggal_cetak' => now(),
        ]);

        return $pdf->stream('kwitansi-gabungan.pdf');
    }
}