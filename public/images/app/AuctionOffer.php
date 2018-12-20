<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionOffer extends Model
{
    protected $table = 'auction_offers';
    protected $fillable = [
       'company_id','auction_request_id','price_offer','comment'
    ];
}
