<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
         'name', 'comment'
    ];

    public function get_Permissions()
    {
        return $this->belongsToMany(Permission::class,'role_permission','role_id','permission_id');
    }

}
