<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $lang ;

    public function __construct()
    {

    }


    /*   ---- My Custom Methods ----- */

    //---for claculate the rating---
    public function stars($column)
    {
        return "CAST(COALESCE(AVG(".$column."),0) as SIGNED) as stars";
    }


    //-------STA = Share TO All -------
    public static function STA_cates_and_subCats()
    {
        $lang = \App::getLocale()??'ar';
        $Category = \App\Category::select('name_'.$lang.' as label','id as value','logo')->where('status',1)->get();
        foreach ($Category as $cat) {
           $cat->SubCategory = \App\SubCategory::where('category_id',$cat->value)->where('status',1)->select('name_'.$lang.' as label','id as value')->get();
        }
        return $Category;
    }

    public static function STA_Setting()
    {
        return \App\Setting::pluck('value','title');
    }



}
