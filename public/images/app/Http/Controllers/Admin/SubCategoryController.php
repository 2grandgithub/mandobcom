<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\SubCategory;

class SubCategoryController extends Controller
{
      public function __construct()
      {
         $this->middleware('auth');
         $this->middleware('lang');
      }

      public function index()
      {
          $categories = Category::select('name_ar as label','id as value')->get();
          return view('Admin.SubCategory.index',compact('categories'));
      }

      //---api----
      public function get_list(Request $request)
      {
            $validator = \Validator::make($request->all(), [
                'category_id' => 'required',
            ]);
            if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }
           $search = $request->search;
           return SubCategory::
            where(function($q)use($search){
                if ($search)
                  $q->where('name_en','like','%'.$search.'%')->orWhere('name_ar','like','%'.$search.'%')->orWhere('id',$search);
            })
            ->where('category_id',$request->category_id)
            ->latest('id')->paginate();
      }


      public function store(Request $request)
      {
            $validator = \Validator::make($request->all(), [
                'category_id' => 'required',
                'name_en' => 'required',
                'name_en' => 'required',
                'logo' => 'required',
            ]);
            if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }
            $Category = SubCategory::create($request->except('_token'));
            $Category->status = 1;
            return response()->json([
              'status' => 'success',
              'data' => $Category
            ]);
      }

      //--api--
      public function update(Request $request)
      {
          $validator = \Validator::make($request->all(), [
              'id' => 'required',
              'name_en' => 'required',
              'name_en' => 'required',
              'logo' => '',
          ]);
          if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }

          $Category = SubCategory::findOrFail($request->id);
          $Category->update($request->except('_token'));
          return response()->json([
            'status' => 'success',
            'data' => $Category
          ]);
      }

      //--api--
      public function showORhide($id)
      {
           $Car = SubCategory::findOrFail($id);
           if( $Car->status )
           {
              $Car->update(['status' => '0']);
              $case = 0;
           }
           else
           {
              $Car->update(['status' => '1']);
              $case = 1;
           }

           return response()->json([
               'status' => 'success',
               'case' => $case
           ]);
      }

      //--api--
      public function destroy($id)
      {
           try {
             $deleted = SubCategory::destroy($id);
           } catch (\Exception $e) {
             return 'false';
           }
           return 'true';
      }

}
