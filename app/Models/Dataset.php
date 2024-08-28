<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_desain',
        'jumlah_terjual',
        'jumlah_pembeli',
        'omset',
    ];
}
