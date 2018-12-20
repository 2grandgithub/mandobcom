<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_carts';
    public $timestamps = false;
    protected $fillable = [
        'buyer_id', 'item_id','offer_id'
    ];
}
