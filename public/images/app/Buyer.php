<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Buyer extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
       'firebase_token','app_version','model','os','status','email_verified','phone_verified','is_accapted_by_admin','jwt','email','password',
       'name','city_id','governorate_id','street','building_no','zip_code','phone','CommercialRegistrationNo','CommercialRegistrationType',
       'TypeOfCompanyActivity','employees_no', 'aramex_City','aramex_CountryCode'
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
        'password', 'jwt'
    ];
}
