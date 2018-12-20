<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentsOffer extends Model
{
    protected $table = 'comments_offer';
    const UPDATED_AT = null;
    protected $fillable = [
        'offer_id', 'buyer_id','comment'
    ];
}
