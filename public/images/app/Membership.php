<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
      public $timestamps = false;
      protected $table = 'memberships';
      protected $fillable = [
          'name_ar','name_en', 'see_auctions', 'no_add_offers','price_per_month'
      ];
}
