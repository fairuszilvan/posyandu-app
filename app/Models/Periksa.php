<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    use HasFactory;
    protected $table = 'periksa';
    protected $fillable = [
        'kode_periksa',
        'id_pasien',
        'tensi',
        'bb',
        'suhu_badan',
        'nadi',
        'keluhan',
        'created_at',
        'updated_at'
    ];
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
}
