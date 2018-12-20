<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionRequest extends Model
{
    protected $table = 'auction_requests';
    protected $fillable = [
       'category_id','buyer_id','company_id','title','description','required_quantity','status' ,'image','winner_offer_id',
       'from','to','payment_method','is_paid','is_delivered'
    ];

    public function getImageAttribute($value){
        return asset('images/Auction/'.$value);
    }

    public function setImageAttribute($value)
    {
        if($value)
        {
            $fileName = rand(11111,99999).'.'.$value->getClientOriginalExtension(); // renameing image
            $destinationPath = public_path('images/Auction');
            $value->move($destinationPath, $fileName); // uploading file to given path
            $this->attributes['image'] = $fileName;
        }
    }


}
