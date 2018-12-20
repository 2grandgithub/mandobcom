<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
      protected $table = 'sub_categories';
      protected $fillable = [
         'category_id','name_en','name_ar', 'logo', 'status'
      ];

      public function getLogoAttribute($value){
          return asset('images/sub_categories/'.$value);
      }

       public function setLogoAttribute($value)
       {
           if($value)
           {
               $fileName = rand(11111,99999).'.'.$value->getClientOriginalExtension(); // renameing image
               $destinationPath = public_path('images/sub_categories');
               $value->move($destinationPath, $fileName); // uploading file to given path
               $this->attributes['logo'] = $fileName;
           }
       }

}
