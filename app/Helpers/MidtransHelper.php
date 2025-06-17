<?php

namespace App\Helpers;

use Midtrans\Config;

class MidtransHelper
{
    public static function config()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // ubah jadi true di production
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
}
