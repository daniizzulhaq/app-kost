<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Kwitansi;
use App\Models\Pembayaran;
use App\Models\Penyewa;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKamar = Kamar::count();
        $kamarKosong = Kamar::where('status', 'KOSONG')->count();
        $kamarTerisi = Kamar::where('status', 'TERISI')->count();
        $totalPenyewa = Penyewa::where('status', 'AKTIF')->count();

        $pendapatanBulanIni = Pembayaran::whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('jumlah_dibayar');

        $pembayaranTerbaru = Pembayaran::with('penyewa', 'kamar')
            ->latest()
            ->take(5)
            ->get();

        $kwitansiBelumDicetak = Kwitansi::with('pembayaran.penyewa')
            ->where('sudah_dicetak', false)
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalKamar', 'kamarKosong', 'kamarTerisi', 'totalPenyewa',
            'pendapatanBulanIni', 'pembayaranTerbaru', 'kwitansiBelumDicetak'
        ));
    }
}