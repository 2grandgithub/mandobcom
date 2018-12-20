<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyMembership extends Model
{
    protected $table = 'company_membership';
    protected $fillable = [
        'company_id','membership_id', 'from', 'to','price','paid','confirmed'
    ];
}
