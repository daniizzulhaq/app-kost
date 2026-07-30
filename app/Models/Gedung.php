<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_gedung', 'alamat', 'no_telepon', 'catatan', 'status',
    ];

    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }
}