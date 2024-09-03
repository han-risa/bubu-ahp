<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulanRanking extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulan_tahun',
    ];

    public function skor_bobot()
    {
        return $this->hasMany(SkorBobot::class);
    }

    public function skor_ranking()
    {
        return $this->hasMany(SkorRanking::class);
    }
}
