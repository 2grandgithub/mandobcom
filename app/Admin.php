<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    protected $fillable = [
        'name', 'email', 'password','phone','username','lang','role_id','super_admin'
    ];

    public function get_Role()
    {
       return $this->belongsTo(Role::class,'role_id');
    }

}
