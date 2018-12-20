<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecycablesWhenfullRequests extends Model
{
      protected $table = 'recycables_whenfull_requests';
      const UPDATED_AT = null;

      protected $fillable = [
           'recycable_id','comment','is_done'
      ];



}
