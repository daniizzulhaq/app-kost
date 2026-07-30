<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KwitansiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    // Master Data
    Route::resource('gedung', GedungController::class);
    Route::resource('kamar', KamarController::class);

    Route::get('/penyewa', [PenyewaController::class, 'index'])->name('penyewa.index');
Route::get('/penyewa/create', [PenyewaController::class, 'create'])->name('penyewa.create');
Route::post('/penyewa', [PenyewaController::class, 'store'])->name('penyewa.store');
Route::get('/penyewa/{penyewa}/edit', [PenyewaController::class, 'edit'])->name('penyewa.edit');
Route::put('/penyewa/{penyewa}', [PenyewaController::class, 'update'])->name('penyewa.update');
Route::get('/penyewa/{penyewa}', [PenyewaController::class, 'show'])->name('penyewa.show');
Route::get('/penyewa/{penyewa}/keluar', [PenyewaController::class, 'formKeluar'])->name('penyewa.keluar.form');
Route::post('/penyewa/{penyewa}/keluar', [PenyewaController::class, 'prosesKeluar'])->name('penyewa.keluar.proses');

    // Transaksi
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/{pembayaran}', [PembayaranController::class, 'show'])->name('pembayaran.show');
    Route::get('/api/penyewa/{penyewa}/data', [PembayaranController::class, 'getPenyewaData'])->name('penyewa.data');

    // Kwitansi
    Route::get('/kwitansi', [KwitansiController::class, 'index'])->name('kwitansi.index');
    Route::get('/kwitansi/{kwitansi}/cetak', [KwitansiController::class, 'cetakSatu'])->name('kwitansi.cetak');
    Route::get('/kwitansi/cetak-banyak', [KwitansiController::class, 'formCetakBanyak'])->name('kwitansi.banyak.form');
    Route::post('/kwitansi/cetak-banyak', [KwitansiController::class, 'prosesCetakBanyak'])->name('kwitansi.banyak.proses');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
});

require __DIR__ . '/auth.php';