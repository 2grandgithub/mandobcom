<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RecycablesNews ;

class RecycablesNewsController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        return view('Admin.RecycablesNews.index' );
    }

    //---api----
    public function get_list(Request $request)
    {
         $search = $request->search;
         return RecycablesNews::
         where(function($q)use($search){
              if ($search)
                $q->where('title_ar','like','%'.$search.'%')->orWhere('body_ar','like','%'.$search.'%')
                  ->orWhere('title_en','like','%'.$search.'%')->orWhere('body_en','like','%'.$search.'%')
                  ->orWhere('id',$search) ;
         })
         ->latest('id')->paginate();
    }


    public function store(Request $request)
    {
          $validator = \Validator::make($request->all(), [
              'title_ar' => 'required',
              'body_ar' => 'required',
              'title_en' => 'required',
              'body_en' => 'required',
              'image' => 'required',
          ]);
          if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }
          $RecycablesNews = RecycablesNews::create($request->except('_token'));
          $RecycablesNews->status = 1;
          return response()->json([
            'status' => 'success',
            'data' => $RecycablesNews
          ]);
    }

    //--api--
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'title_ar' => 'required',
            'body_ar' => 'required',
            'title_en' => 'required',
            'body_en' => 'required',
        ]);
        if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }

        $RecycablesNews = RecycablesNews::findOrFail($request->id);
        $RecycablesNews->update($request->except('_token'));
        return response()->json([
          'status' => 'success',
          'data' => $RecycablesNews
        ]);
    }

    //--api--
    public function showORhide($id)
    {
         $Car = RecycablesNews::findOrFail($id);
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
           $deleted = RecycablesNews::destroy($id);
         } catch (\Exception $e) {
           return 'false';
         }
         return 'true';
    }

}
