<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Role;

class CountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function count_Company()
    {
        $count = \App\Company::where('is_accapted_by_admin',0)->orWhere('email_verified',0)->orWhere('phone_verified',0)->count();
        return $count;
    }

    public static function count_Buyer()
    {
        $count = \App\Buyer::where('is_accapted_by_admin',0)->orWhere('email_verified',0)->orWhere('phone_verified',0)->count();
        return $count;
    }

    public static function count_Recycable()
    {
        $count = \App\Recycable::where('is_accapted_by_admin',0)->orWhere('email_verified',0)->orWhere('phone_verified',0)->count();
        return $count;
    }

    public static function count_ProducerFamily()
    {
        $count = \App\ProducerFamily::where('is_accapted_by_admin',0)->orWhere('email_verified',0)->orWhere('phone_verified',0)->count();
        return $count;
    }

    public static function count_Item()
    {
        $count = \App\Item::where('accapted_by_admin',0)->count();
        return $count;
    }

    public static function count_Offer()
    {
         $count = \App\Offer::where('accapted_by_admin',0)->count();
         return $count;
    }

    public static function count_CompanyMembership()
    {
        $count = \App\CompanyMembership::where('paid',0)->orWhere('confirmed',0)->count();
        return $count;
    }

    public static function count_AuctionRequest()
    {
        $count = \App\AuctionRequest::whereNull('from')->count();
        return $count;
    }
 
    public static function count_RecycablesWhenfullRequests()
    {
        $count = \App\RecycablesWhenfullRequests::where('is_done',0)->count();
        return $count;
    }

}
