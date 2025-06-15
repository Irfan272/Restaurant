<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Pesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanans';

    protected $fillable =[
        'pesanan_id',
        'menu_id',
        'jumlah',
        'total',
    ];

    public function Pesanan(){
        return $this->belongsTo(Pesanan::class);
    }
    public function Menu(){
        return $this->belongsTo(Menu::class);
    }
}
