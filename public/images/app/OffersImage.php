<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OffersImage extends Model
{
    public $timestamps = false;
    protected $table = 'offers_images';
    protected $fillable = [
        'offer_id', 'image'
    ];

    public function getImageAttribute($value){
        return asset('images/offers/'.$value);
    }

     public function setImageAttribute($value)
     {
         if($value)
         {
             $fileName = rand(11111,99999).'.'.$value->getClientOriginalExtension(); // renameing image
             $destinationPath = public_path('images/offers');
             $value->move($destinationPath, $fileName); // uploading file to given path
             $this->attributes['image'] = $fileName;
         }
     }
}
