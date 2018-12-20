<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Recycable extends Authenticatable
{
      use Notifiable;

      protected $fillable = [
        'firebase_token','app_version','model','os','status','phone_verified','email_verified','is_accapted_by_admin','email' ,
        'password', 'jwt','name','type','city_id','governorate_id',
        'street','building_no','zip_code','phone','CommercialRegistrationNo','CommercialRegistrationType','TypeOfCompanyActivity',
        'employees_no'
      ];

      protected $hidden = [
          'password', 'remember_token','token'
      ];

    

}
