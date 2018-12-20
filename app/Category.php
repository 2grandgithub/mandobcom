<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
       'name_en','name_ar', 'logo', 'status'
    ];

    public function getLogoAttribute($value){
        return asset('images/categories/'.$value);
    }

     public function setLogoAttribute($value)
     {
         if($value)
         {
             $fileName = rand(11111,99999).'.'.$value->getClientOriginalExtension(); // renameing image
             $destinationPath = public_path('images/categories');
             $value->move($destinationPath, $fileName); // uploading file to given path
             $this->attributes['logo'] = $fileName;
         }
     }


}
