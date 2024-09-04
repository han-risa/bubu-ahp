<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkorBobot extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulan_id',
        'jumlah_terjual',
        'jumlah_pembeli',
        'omset',
    ];

    public function bulan()
    {
        return $this->belongsTo(BulanRanking::class, 'bulan_id', 'id');
    }
}
