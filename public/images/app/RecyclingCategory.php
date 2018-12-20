<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecyclingCategory extends Model
{
      protected $table = 'recycling_categories';
      protected $fillable = [
           'name_en','name_ar', 'status'
      ];
}
