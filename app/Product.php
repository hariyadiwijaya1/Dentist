<?php

namespace App;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','category','photo','detail','price','stock',
    ];

    public function getPhotoAttribute($value)
    {
        return URL::to('/'). '/storage/'. $value;
    }
}
