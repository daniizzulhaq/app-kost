<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPembayaranExport;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with('penyewa', 'kamar.gedung');

        if ($request->filled('gedung_id')) {
            $query->whereHas('kamar', fn($q) => $q->where('gedung_id', $request->gedung_id));
        }

        if ($request->filled('periode')) {
            $query->where('periode', 'like', '%' . $request->periode . '%');
        }

        $pembayarans = $query->latest('tanggal_bayar')->get();
        $total = $pembayarans->sum('jumlah_dibayar');
        $gedungs = Gedung::all();

        return view('laporan.index', compact('pembayarans', 'total', 'gedungs'));
    }

    public function exportPdf(Request $request)
    {
        $query = Pembayaran::with('penyewa', 'kamar.gedung');

        if ($request->filled('gedung_id')) {
            $query->whereHas('kamar', fn($q) => $q->where('gedung_id', $request->gedung_id));
        }
        if ($request->filled('periode')) {
            $query->where('periode', 'like', '%' . $request->periode . '%');
        }

        $pembayarans = $query->latest('tanggal_bayar')->get();
        $total = $pembayarans->sum('jumlah_dibayar');

        $pdf = Pdf::loadView('laporan.pdf', compact('pembayarans', 'total'));
        return $pdf->stream('laporan-pembayaran.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new LaporanPembayaranExport($request), 'laporan-pembayaran.xlsx');
    }
}