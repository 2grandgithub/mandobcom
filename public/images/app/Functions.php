<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Functions
{

      public static function company_membership_info()
      {
            $lang = app()->getLocale()??'ar';

          $CompanyMembership = CompanyMembership::select('company_membership.*','memberships.name_'.$lang.' as membership_name',
                            'memberships.see_auctions','memberships.no_add_offers' )
               ->leftJoin('memberships', 'memberships.id','company_membership.membership_id')
               ->where('company_membership.company_id', auth('Company')->id() )
               ->where('company_membership.confirmed', 1 )
               ->whereRaw("NOW() BETWEEN company_membership.from AND company_membership.to")
               ->groupBy('company_membership.id')
               ->latest('company_membership.id')->first();
               // dd($CompanyMembership);
          return $CompanyMembership;
      }

      public static function get_membership_class_name($CompanyMembership)
      {
          $className = '';
          switch ($CompanyMembership->membership_id)
          {
            case '2':   $className = 'Bronze';   break;
            case '3':   $className = 'Silver';   break;
            case '4':   $className = 'Golden';   break;
          }
          return $className;
      }

      public static function get_membership_reming_dayes($CompanyMembership)
      {
          return Carbon::parse( date("Y-m-d") )->diffInDays($CompanyMembership->to);
      }

}
