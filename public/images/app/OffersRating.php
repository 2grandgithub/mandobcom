<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OffersRating extends Model
{
    protected $table = 'offers_rating';
    protected $fillable = [
        'user_id','offer_id','stars' 
    ];
}
