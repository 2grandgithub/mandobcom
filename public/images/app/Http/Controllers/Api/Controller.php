<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*
        ---- My Custom Methods -----
    */

    //---for claculate the rating---
    public function stars($column)
    {
        return "CAST(COALESCE(AVG(".$column."),0) AS int) as stars";
        // return "COALESCE(AVG(".$column."),0) as stars";
    }

}
