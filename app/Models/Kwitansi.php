<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_kwitansi', 'pembayaran_id', 'sudah_dicetak', 'tanggal_cetak',
    ];

    protected $casts = [
        'tanggal_cetak' => 'datetime',
    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }
}