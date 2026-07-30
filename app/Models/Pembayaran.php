<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_pembayaran', 'penyewa_id', 'kamar_id', 'jenis_pembayaran',
        'periode', 'tanggal_bayar', 'jumlah_tagihan', 'jumlah_dibayar',
        'sisa_tagihan', 'status', 'keterangan',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function kwitansi()
    {
        return $this->hasOne(Kwitansi::class);
    }

    protected static function booted()
    {
        static::creating(function ($pembayaran) {
            $last = self::latest('id')->first();
            $nextNumber = $last ? ((int) substr($last->nomor_pembayaran, 3)) + 1 : 1;
            $pembayaran->nomor_pembayaran = 'PB-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

            $pembayaran->sisa_tagihan = $pembayaran->jumlah_tagihan - $pembayaran->jumlah_dibayar;
            $pembayaran->status = $pembayaran->sisa_tagihan <= 0 ? 'LUNAS' : 'SEBAGIAN';
        });

        static::created(function ($pembayaran) {
            $last = Kwitansi::latest('id')->first();
            $nextNumber = $last ? ((int) substr($last->nomor_kwitansi, 3)) + 1 : 1;

            Kwitansi::create([
                'nomor_kwitansi' => 'KW-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT),
                'pembayaran_id' => $pembayaran->id,
            ]);
        });
    }
}