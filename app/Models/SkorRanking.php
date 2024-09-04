<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkorRanking extends Model
{
    use HasFactory;

    protected $fillable = [
        'desain_id',
        'bulan_id',
        'skor_ranking',
        'posisi_ranking',
    ];

    public function desain()
    {
        return $this->belongsTo(Desain::class, 'desain_id', 'id');
    }

    public function bulan()
    {
        return $this->belongsTo(BulanRanking::class, 'bulan_id', 'id');
    }
}
