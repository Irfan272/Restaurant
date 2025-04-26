<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $fillable =[
        'nomor_meja',
        'kapasitas',
        'lokasi',
        'deskripsi',
        'status',
    ];

    public function Pesanan(){
        return $this->hasMany(Pesanan::class);
    }

    public function Reservasi(){
        return $this->hasMany(Reservasi::class);
    }


}
