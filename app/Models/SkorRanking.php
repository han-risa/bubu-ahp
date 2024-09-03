<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkorRanking extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_desain',
        'id_bulan',
        'skor_ranking',
        'posisi_ranking',
    ];

    public function desain()
    {
        return $this->belongsTo(Desain::class, 'id_desain', 'id');
    }

    public function bulan()
    {
        return $this->belongsTo(BulanRanking::class, 'id_bulan', 'id');
    }
}
