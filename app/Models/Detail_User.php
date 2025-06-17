<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_User extends Model
{
    use HasFactory;

    protected $table = 'detail_users';

    protected $fillable = [
        'user_id',
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'tanggal_lahir',
    ];

    // Di Detail_User.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
