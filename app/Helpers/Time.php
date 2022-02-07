<?php

namespace App\Helpers;

class Time {

    public static function showDateTime($time) {
        return date('d M Y, H:i:s', strtotime($time));
    }
    
}