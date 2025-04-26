<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'meja_id',
        'tanggal_reservasi',
        'jam_reservasi',
        'jumlah_orang',
        'status',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Meja(){
        return $this->belongsTo(Meja::class);
    }
}
