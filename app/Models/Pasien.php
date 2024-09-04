<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    protected $fillable = [
        'kode_pasien',
        'nama',
        'notelepon',
        'jenis_kelamin',
        'usia',
        'alamat',
        'created_at',
        'updated_at'
    ];
    public function periksa()
    {
        return $this->hasMany(Periksa::class, 'id_pasien');
    }
    public function latestMedicalRecord()
    {
        return $this->hasOne(Periksa::class, 'id_pasien')->latestOfMany();
    }
}
