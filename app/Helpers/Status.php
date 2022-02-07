<?php

namespace App\Helpers;

trait Status {

    var $STATUS_ACTIVE     = 1;
    var $STATUS_DRAFT      = 0;
    var $STATUS_DELETE     = -1;

    public function scopeIsNotDeleted($query)
    {
        return $query->where('status', '!=', $this->STATUS_DELETE);
    }
    
    public function getStatus() 
    {
        if($this->status == $this->STATUS_ACTIVE) {
            $status = "<span class='badge badge-success'>Aktif</span>";
        } else if($this->status == $this->STATUS_DRAFT){
            $status = "<span class='badge badge-info'>Draft</span>";
        }

        return $status;
    }

}