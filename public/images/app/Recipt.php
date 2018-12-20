<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipt extends Model
{
    protected $table = 'recipts';
    protected $fillable = [
         'buyer_id','company_id','payment_method','is_paid','buyer_notes' ,'total_price','paid_price','is_delivered','is_cancled'
         ,'transfer_image','status'
    ];
}
