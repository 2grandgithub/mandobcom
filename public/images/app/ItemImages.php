<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemImages extends Model
{
      public $timestamps = false;
      protected $table = 'items_images';
      protected $fillable = [
          'item_id', 'image'
      ];

      public function getImageAttribute($value){
          return asset('images/items/'.$value);
      }

       public function setImageAttribute($value)
       {
           if($value)
           {
               $fileName = rand(11111,99999).'.'.$value->getClientOriginalExtension(); // renameing image
               $destinationPath = public_path('images/items');
               $value->move($destinationPath, $fileName); // uploading file to given path
               $this->attributes['image'] = $fileName;
           }
       }
}
