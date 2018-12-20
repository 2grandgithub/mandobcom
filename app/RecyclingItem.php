<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecyclingItem extends Model
{
    protected $table = 'recycling_items';
    protected $fillable = [
        'recycable_id', 'category_id','name_en','name_ar','image','quantity','status'
    ];
}
