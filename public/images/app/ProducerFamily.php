<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProducerFamily extends Authenticatable
{
    protected $table = 'producer_family';
    protected $fillable = [
        'firebase_token','app_version', 'model', 'os', 'status', 'phone_verified', 'email_verified', 'is_accapted_by_admin', 'email',
        'password','jwt','name','phone','city_id','governorate_id','street','building_no', 'zip_code', 'CommercialRegistrationNo',
        'CommercialRegistrationType','TypeOfCompanyActivity','employees_no',
    ];
}
