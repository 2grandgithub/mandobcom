<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Chat extends Model
{
      protected $table = 'chat';
      const UPDATED_AT = null;
      protected $fillable = [
          'user_id','admin_id', 'type','message','message_type'
      ];
      public function get_user()
      {
          return $this->belongsTo(\App\User::class,'user_id');
      }

      // public function getMessageAttribute($value){
      //     if($this->message_type == 'image')
      //       return asset('images/chat/'.$value);
      //     else
      //       return $value;
      // }

}
