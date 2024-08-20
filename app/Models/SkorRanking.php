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
}
