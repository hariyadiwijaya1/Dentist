<?php

namespace App;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name', 'gender', 'phone', 'address', 'specialist', 'status', 'photo',
    ];

    public function getPhotoAttribute($value)
    {
        return URL::to('/'). '/storage/'. $value;
    }
}
