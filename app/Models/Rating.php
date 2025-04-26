<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'menu_id',
        'nilai',
        'komentar',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Menu(){
        return $this->belongsTo(Menu::class);
    }
}
