<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable =[
        'foto_menu',
        'nama_menu',
        'harga',
        'deskripsi',
        'status',
        'category_id',
    ];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function Detail_Pesanan(){
        return $this->hasMany(Detail_Pesanan::class);
    }

    public function Rating(){
        return $this->hasMany(Rating::class);
    }

}
