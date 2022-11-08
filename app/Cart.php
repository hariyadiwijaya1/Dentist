<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'id_transaction', 'id_user','id_products','quantity','total_price',
    ];
    protected $appends = ['product_name', 'user_name'];

    public function getProductNameAttribute()
    {
        return Product::where('id', $this->id_products)->value('name');
    }

    public function getUserNameAttribute()
    {
        return User::where('id', $this->id_user)->value('name');
    }
}
