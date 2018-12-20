<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RecycablesNews;

class RecycablesNewsController extends Controller
{
    public function index()
    {
        return view('Site.RecycablesNews.index');
    }

    public function get_list(Request $request)
    {
        $lang = app()->getLocale()??'ar';
        $val = $request->search;
        return RecycablesNews::select('id',"title_$lang as title","body_$lang as body",'image')
                          ->where(function($q) use ($val){
                              if($val)
                                $q->where('title_en','like','%'.$val.'%')->orWhere('title_ar','like','%'.$val.'%');
                          })
                          ->where('status',1)->latest()->simplePaginate();
    }

    public function show($id)
    {
         $lang = app()->getLocale()??'ar';
        $RecycablesNews = RecycablesNews::select('id',"title_$lang as title","body_$lang as body",'image')
                            ->where('id',$id) ->where('status',1)->first();
         return view('Site.RecycablesNews.show',compact('RecycablesNews'));
    }

}
