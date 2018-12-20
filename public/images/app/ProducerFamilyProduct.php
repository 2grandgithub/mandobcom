<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProducerFamilyProduct extends Model
{
    protected $table = 'producer_family_products';
    protected $fillable = [
        'ProducerFamily_id','status','name_ar','name_en','image','descraption_en','descraption_ar','price','price_unit'
    ];

    public function getImageAttribute($value)
    {
        if($value)
          return asset('images/Recycable_items/'.$value);
        else
          return '';
    }

    public function setImageAttribute($value)
    {
        if($value)
        {
            $fileName = rand(11111,99999).'.'.$value->getClientOriginalExtension(); // renameing image
            $destinationPath = public_path('images/Recycable_items');
            $value->move($destinationPath, $fileName); // uploading file to given path
            $this->attributes['image'] = $fileName;
        }
    }

}
