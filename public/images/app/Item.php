<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'category_id', 'company_id','name_en','name_ar','description_en','description_ar','price','likes','minimum_amount','maximum_amount',
        'status','accapted_by_admin','views','sub_category_id','Weight'
    ];
 



}
