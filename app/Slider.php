<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
      protected $table = 'sliders';
      protected $fillable = [
         'name','image','link', 'status'
      ];

      public function getImageAttribute($value){
          return asset('images/Slider/'.$value);
      }

       public function setImageAttribute($value)
       {
           if($value)
           {
               $fileName = rand(11111,99999).'.'.$value->getClientOriginalExtension(); // renameing image
               $destinationPath = public_path('images/Slider');
               $value->move($destinationPath, $fileName); // uploading file to given path
               $this->attributes['image'] = $fileName;
           }
       }
}
