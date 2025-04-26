<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'meja_id',
        'tanggal_pesanan',
        'waktu_pesanan',
        'status',
        'jenis_pesanan',
        'total_pesanan',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Meja(){
        return $this->belongsTo(Meja::class);
    }

    public function Detail_Pesanan(){
        return $this->hasMany(Detail_Pesanan::class);
    }
}
