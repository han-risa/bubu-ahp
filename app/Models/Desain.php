<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desain extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_desain',
    ];

    public function skor_ranking()
    {
        return $this->hasMany(SkorRanking::class, 'desain_id', 'id');
    }
}
