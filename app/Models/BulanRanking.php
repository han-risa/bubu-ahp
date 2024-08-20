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
}
