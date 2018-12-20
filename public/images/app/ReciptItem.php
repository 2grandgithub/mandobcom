<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReciptItem extends Model
{
    protected $table = 'recipt_items';
    public $timestamps = false;
    protected $fillable = [
        'receipt_id', 'item_id','offer_id','quantity','single_price','total_price'
    ];
}
