<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanPembayaranExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Pembayaran::with('penyewa', 'kamar.gedung');

        if ($this->request->filled('gedung_id')) {
            $query->whereHas('kamar', fn($q) => $q->where('gedung_id', $this->request->gedung_id));
        }
        if ($this->request->filled('periode')) {
            $query->where('periode', 'like', '%' . $this->request->periode . '%');
        }

        return $query->latest('tanggal_bayar')->get()->map(function ($p) {
            return [
                'Nama' => $p->penyewa->nama,
                'Kamar' => $p->kamar->nomor_kamar,
                'Gedung' => $p->kamar->gedung->nama_gedung,
                'Tanggal Bayar' => $p->tanggal_bayar->format('d/m/Y'),
                'Periode' => $p->periode,
                'Jumlah' => $p->jumlah_dibayar,
                'Status' => $p->status,
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama', 'Kamar', 'Gedung', 'Tanggal Bayar', 'Periode', 'Jumlah', 'Status'];
    }
}