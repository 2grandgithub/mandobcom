<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'category_id', 'company_id','name_en','name_ar','description_en','description_ar','new_price','old_price',
        'likes','amount','status','accapted_by_admin','views','sub_category_id'
    ];
}
