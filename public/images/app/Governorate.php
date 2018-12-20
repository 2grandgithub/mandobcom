<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $fillable = [
        'city_id', 'name_ar','name_en','status' 
    ];
}
