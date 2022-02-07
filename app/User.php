<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Transaction;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function calculateTransaction() {
        $transaction = Transaction::where('user_id', $this->id)->get();

        $val = 0;

        foreach($transaction as $item) {
            if($item->type == 1) {
                $val += $item->value;
            } else {
                $val -= $item->value;
            }
        }

        return $val;
    }

    public function calculateTransactionInflow() {
        $transaction = Transaction::where('user_id', $this->id)->get();

        $val = 0;

        foreach($transaction as $item) {
            if($item->type == 1) {
                $val += $item->value;
            }
        }

        return $val;
    }

    public function calculateTransactionOutflow() {
        $transaction = Transaction::where('user_id', $this->id)->get();

        $val = 0;

        foreach($transaction as $item) {
            if($item->type == 2) {
                $val += $item->value;
            }
        }

        return $val;
    }
}
