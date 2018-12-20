<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'firebase_token', 'os', 'app_version', 'model', 'name', 'email','phone' ,'password' ,
          'verified','status' ,'token','image','type'
    ];

    protected $hidden = [
        'password', 'remember_token','token'
    ];
}
