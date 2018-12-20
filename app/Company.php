<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
      use Notifiable;

      protected $fillable = [
         'name_en','name_ar', 'logo', 'status','is_accapted_by_admin','email_verified','phone_verified',
         'email','password','type','city_id','governorate_id',
         'street','building_no','zip_code','TypeOfCompanyActivity',
         'phone','CommercialRegistrationNo','CommercialRegistrationType','Activity','employees_no',
         'membership_id','membership_from','membership_to', 'aramex_City','aramex_CountryCode'
      ];

      public function getLogoAttribute($value){
          return asset('images/companies/'.$value);
      }

      public function setLogoAttribute($value)
      {
          if($value)
          {
              $fileName = rand(11111,99999).'.'.$value->getClientOriginalExtension(); // renameing image
              $destinationPath = public_path('images/companies');
              $value->move($destinationPath, $fileName); // uploading file to given path
              $this->attributes['logo'] = $fileName;
          }
      }

      protected $hidden = [
          'password', 'remember_token'
      ];
}
