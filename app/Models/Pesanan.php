<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal_pesanan',
        'waktu_pesanan',
        'status',
        'jenis_pesanan',
        'total_pesanan',
        'metode_pembayaran',
        'uang_diterima',
        'catatan',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPesanan()
    {
        return $this->hasMany(Detail_Pesanan::class);
    }

}
