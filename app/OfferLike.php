<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferLike extends Model
{
    protected $table = 'offers_likes';
    const UPDATED_AT = null;
    protected $fillable = [
        'buyer_id', 'offer_id'
    ];
}
