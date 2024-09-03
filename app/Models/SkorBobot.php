<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkorBobot extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kriteria',
        'id_bulan',
        'skor_bobot',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id');
    }

    public function bulan()
    {
        return $this->belongsTo(BulanRanking::class, 'id_bulan', 'id');
    }
}
