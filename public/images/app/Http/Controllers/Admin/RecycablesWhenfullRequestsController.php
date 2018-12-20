<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RecycablesWhenfullRequests;

class RecycablesWhenfullRequestsController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        return view('Admin.RecycablesWhenfullRequests.index');
    }

    //---api----
    public function get_list(Request $request)
    {
         $search = $request->search;
         $done = $request->done;
         return RecycablesWhenfullRequests::select('recycables_whenfull_requests.*',
                'recycables.name as recycable_name','recycables.id as recycable_id','recycables.phone as recycable_phone')
         ->where(function($q)use($search,$done){
              if ($search)
                $q->where('comment','like','%'.$search.'%')->orWhere('recycables_whenfull_requests.id',$search)
                  ->orWhere('recycables.phone', $search );
              if ($done == 'is_done')
                $q->where('is_done',1);
              if ($done == 'is_not_done')
                $q->where('is_done',0);
          })
          ->join('recycables','recycables.id','recycables_whenfull_requests.recycable_id')
          ->groupBy('recycables_whenfull_requests.id')
          ->latest('recycables_whenfull_requests.id')->paginate();
    }


    public function store(Request $request)
    {
          $validator = \Validator::make($request->all(), [
              'recycable_id' => 'required',
              'comment' => 'required',
          ]);
          if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }
          $RecycablesWhenfullRequests = RecycablesWhenfullRequests::create($request->except('_token'));
          return response()->json([
            'status' => 'success',
            'data' => $RecycablesWhenfullRequests
          ]);
    }

    //--api--
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'recycable_id' => 'required',
            'comment' => 'required',
        ]);
        if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }

        $RecycablesWhenfullRequests = RecycablesWhenfullRequests::findOrFail($request->id);
        $RecycablesWhenfullRequests->update($request->except('_token'));
        return response()->json([
          'status' => 'success',
          'data' => $RecycablesWhenfullRequests
        ]);
    }

    //--api--
    public function done_or_not($id)
    {
         $R = RecycablesWhenfullRequests::findOrFail($id);
         if( $R->is_done )
         {
            $R->update(['is_done' => '0']);
            $case = 0;
         }
         else
         {
            $R->update(['is_done' => '1']);
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
           $deleted = RecycablesWhenfullRequests::destroy($id);
         } catch (\Exception $e) {
           return 'false';
         }
         return 'true';
    }

}
