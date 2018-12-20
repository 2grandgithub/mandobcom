<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AramexCity extends Model
{
      public $timestamps = false;
      protected $table = 'aramex_cities';
      protected $fillable = [
          'aramex_country_code', 'name_ar','name_en',  'status'
      ];
}
