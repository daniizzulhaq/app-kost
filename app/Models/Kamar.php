<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'gedung_id', 'nomor_kamar', 'tipe_kamar',
        'harga_harian', 'harga_bulanan', 'status',
    ];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }

    public function penyewas()
    {
        return $this->hasMany(Penyewa::class);
    }

    public function penyewaAktif()
    {
        return $this->hasOne(Penyewa::class)->where('status', 'AKTIF');
    }
}