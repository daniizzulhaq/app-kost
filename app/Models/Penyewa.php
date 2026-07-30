<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    use HasFactory;

    protected $fillable = [
        'kamar_id', 'nama', 'tempat_kerja', 'no_telepon', 'email',
        'alamat_asal', 'jenis_sewa', 'harga_sewa',
        'tanggal_masuk', 'tanggal_keluar', 'status',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_keluar' => 'date',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}