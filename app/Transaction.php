<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function getValueRealAttribute() {
        $mark = "";
        if($this->type == 2) {
            $mark = "-";
        }
        return $mark.number_format($this->value);
    }

    public function logTransaction() {
        \Log::info('New transaction has been created');
    }

    
}

