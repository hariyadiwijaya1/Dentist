<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'id_user','total_price','address','payment_status','delivery_status',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'id_transaction');
    }
}
