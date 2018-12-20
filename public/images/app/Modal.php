<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modal extends Model
{
    protected $table = 'modal';
    protected $fillable = [
        'name', 'status'
    ];

  

}
