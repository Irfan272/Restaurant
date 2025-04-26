<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_User extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'tanggal_lahir',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

}
