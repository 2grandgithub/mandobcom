<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
      const UPDATED_AT = null;
      protected $table = 'verification_codes';
      protected $fillable = [
          'buyer_id','recycable_id','ProducerFamily_id','company_id','code' ,'phone'
      ];

      // public function get_user()
      // {
      //     return $this->belongsTo(User::class);
      // }
}
