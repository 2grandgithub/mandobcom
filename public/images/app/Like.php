<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
      const UPDATED_AT = null;
      protected $fillable = [
          'buyer_id', 'item_id'
      ];

}
