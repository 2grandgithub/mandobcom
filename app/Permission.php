<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    const UPDATED_AT = null;
    protected $fillable = [
        'title', 'related_to', 'comment'
    ];
}
