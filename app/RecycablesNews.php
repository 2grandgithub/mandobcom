<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecycablesNews extends Model
{
    protected $table = 'recycables_news';
    protected $fillable = [
         'title_ar','body_ar','title_en','body_en' ,'image','status'
    ];

      public function getImageAttribute($value)
      {
          if($value)
            return asset('images/RecycablesNews/'.$value);
          else
            return $value;
      }

      public function setImageAttribute($value)
      {
          if($value && $value!= 'undefined')
          {
              $fileName = rand(11111,99999).'.'.$value->getClientOriginalExtension(); // renameing image
              $destinationPath = public_path('images/RecycablesNews');
              $value->move($destinationPath, $fileName); // uploading file to given path
              $this->attributes['image'] = $fileName;
          }
      }
}
