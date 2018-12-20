<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatCompany extends Model
{
      protected $table = 'chat_company';
      const UPDATED_AT = null;
      protected $fillable = [
          'company_id','admin_id', 'type','message','message_type'
      ];
    // public function get_user()
    // {
    //     return $this->belongsTo(\App\User::class,'user_id');
    // }

}
