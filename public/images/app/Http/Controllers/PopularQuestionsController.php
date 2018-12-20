<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PopularQuestions;

class PopularQuestionsController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
          return view('Admin.popularQuestions.index',compact('popularQuestions') );
    }

    public function list(Request $request)
    {
        $val = $request->search;
        $popularQuestions = PopularQuestions::where(function($query)use($val){
          if($val)
            $query->where('body',$val)->orWhere('answer',$val);
        })
        ->latest()->paginate();
        return $popularQuestions;
    }

    public function store(Request $request)
    {
          $data = $request->validate([
               'body' => 'required',
               'answer'  => 'required',
          ]);
          $popularQuestions = PopularQuestions::create($data);
          \Session::flash('flash_message',' اضافت '.$popularQuestions->name.'سوال ');
          return redirect('popularQuestions');
    }

    public function update(Request $request)
    {
          $data = $request->validate([
               'id' => 'required',
               'body' => 'required',
               'answer'  => 'required',
          ]);
          $popularQuestions = PopularQuestions::findOrFail($request->id);
          $popularQuestions->update($data);
          \Session::flash('flash_message',' اتعدل '.$popularQuestions->name.'سوال ');
          return redirect('popularQuestions');
    }

      //--api--
      public function showORhide($id)
      {
           $popularQuestions = PopularQuestions::findOrFail($id);
           if( $popularQuestions->status )
                $popularQuestions->update(['status' => '0']);
           else
                $popularQuestions->update(['status' => '1']);

           return response()->json([
               'status' => 'success'
           ]);
      }

    public function destroy($id)
    {
        $popularQuestions = PopularQuestions::findOrFail($id);
        $popularQuestions->delete();
        \Session::flash('flash_message',' اتمسح '.$popularQuestions->name.'سوال ');
        return redirect('popularQuestions');
    }

}
