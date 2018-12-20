<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AramexCountry extends Model
{
      public $timestamps = false;
      protected $table = 'aramex_countries';
      protected $fillable = [
          'code','name_en', 'name_ar', 'status' ,'IsoCode','StateRequired','PostCodeRequired','InternationalCallingNumber'
      ];
}
