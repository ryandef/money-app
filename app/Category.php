<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Status;

class Category extends Model
{
    use Status;

    public function getType() {
        if($this->type == 1) {
            return "<span class='badge badge-success'>Pemasukan</span>";
        } else {
            return "<span class='badge badge-danger'>Pengeluaran</span>";
        }
    }
}
