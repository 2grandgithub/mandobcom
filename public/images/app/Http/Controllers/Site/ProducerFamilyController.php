<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProducerFamilyProduct;

class ProducerFamilyController extends Controller
{

    public function index()
    {
        return view('Site.ProducerFamily.index');
    }

    public function get_list(Request $request)
    {
        $lang = app()->getLocale()??'ar';
        $search = $request->search;

         $Family = ProducerFamilyProduct::select('id','name_'.$lang.' as name','image')->where('status',1)
                         ->where(function($q)use($search,$lang){
                            if($search)
                              $q->where("name_$lang",'like','%'.$search.'%');
                         })
                         ->latest('id')
                         ->paginate(30);
         return $Family;
    }

    public function details($id)
    {
        $lang = app()->getLocale()??'ar';

         $Family = ProducerFamilyProduct::select('*','name_'.$lang.' as name','image',"descraption_$lang as descraption",
                                        'family.name as family_name','family.phone as family_phone')
                       ->where('producer_family_products.status',1)
                       ->join('producer_family as family','family.id','producer_family_products.ProducerFamily_id')
                       ->groupBy('producer_family_products.id')
                       ->where('producer_family_products.id',$id)->first();  

        return view('Site.ProducerFamily.details',compact('Family' ));
    }


}
