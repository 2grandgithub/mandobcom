<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendPushNotification extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        return view('SendPushNotification.index');
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $the_image = '';
        if ($request->image)
        {
              $fileName  = rand(11111,99999).'.'.$request->message->getClientOriginalExtension(); // renameing image
              $destinationPath = public_path('images/notifications');
              $request->message->move($destinationPath, $fileName); // uploading file to given path
              $the_image = asset('images/notifications/'.$fileName);
        }

        $firebase_tokens = \App\User::whereNotNull('firebase_token')
                      ->where(function($query)use($request){
                          if( $request->has('registred') && $request->has('notRegistred') )
                          {  }
                          else if($request->has('registred'))
                                $query->where('verified',1);
                          else if($request->has('notRegistred'))
                                $query->where('verified',0);
                      })
                      ->pluck('firebase_token')->toArray();

        if ($firebase_tokens)
          $responce = \App\PushNotification::send_message($firebase_tokens, $request->title, $request->body,$the_image); //return $responce;

        return back();
    }

    public function osama_firebase(Request $request)
    {
        $responce = \App\PushNotification::send_message($firebase_tokens,$request->message );
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
