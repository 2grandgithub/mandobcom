<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\SubCategory;

class CategoryController extends Controller
{

    public function index()
    {
        return Category::select('id','name_en','name_ar','logo')->where('status',1)->get();
    }

    public function list_with_sub_category()
    {
        $categoies =  Category::select('id','name_en','name_ar','logo')->where('status',1)->get();
        foreach ($categoies as $cat)
        {
            $cat->sub_cat = SubCategory::select('id','name_en','name_ar','logo')
                                       ->where('category_id',$cat->id)->where('status',1)->get();
        }
        return $categoies; 
    }

    public function search_by_name(Request $request)
    {
         $data = \Validator::make($request->all(), [
              'name' => 'required',
         ]);
         if ($data->fails()) {
                return response()->json([ 'state' => 'notValid' , 'data' => $data->messages() ]);
         }
         $name = $request->name;
         return Category::select('id','name_en','name_ar','logo')->where('status',1)
                        ->where(function($query)use($name){
                            $query->where('name_en','like','%'.$name.'%')->orWhere('name_ar','like','%'.$name.'%');
                        })->get();
    }


}
