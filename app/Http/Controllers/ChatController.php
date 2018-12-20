<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;

class ChatController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index()
    {
        return view('Chat.index');
    }

    public function get_chat_users()
    {
        $users = Chat::select(\DB::raw("CONCAT(users.fname,' ',users.lname) as user_name"),'users.id as user_id','users.model',
                              'chat.type','message_type','message' )
                     ->leftJoin('users','users.id','chat.user_id')->where('type','user')
                     ->distinct('chat.user_id')->groupBy('chat.user_id')->latest('chat.id')->get();

        return $users;
    }

    public function get_latest_chat()
    {
        $user = Chat::latest()->select('user_id')->first();
        $chat = Chat::where('user_id',$user->user_id)->limit(50)->get();
        return $chat;
    }

    public function get_chat($user_id)
    {
        $chat = Chat::where('user_id',$user_id)->limit(50)->get();
        return $chat;
    }

    public function store(Request $request)
    {
      // return ($request->all());
      // dd($request->all());
        $data = \Validator::make($request->all(), [
              'user_id' => 'required',
              'message'  => '',
              'image'  => '',
         ]);
         if ($data->fails()) {
                return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
         }
         $insert_data = [
           'user_id' => $request->user_id,
           'message'  => $request->message,
           'message_type'  => 'text',
           'type' => 'admin'
         ];
         if($request->hasFile('image'))
         {
             $fileName  = rand(11111,99999).'.'.$request->image->getClientOriginalExtension(); // renameing image
             $destinationPath = public_path('images/chat');
             $request->image->move($destinationPath, $fileName); // uploading file to given path
             $insert_data['message'] = $fileName;
             $insert_data['message_type'] = 'image';
         }
         $chat = Chat::create($insert_data);
         event(new \App\Events\SendMessage($chat));

         $firebase_tokens = \App\User::whereId($request->user_id)->whereNotNull('firebase_token')->pluck('firebase_token')->toArray();
        if ($firebase_tokens)
        {
            $responce = \App\PushNotification::send_message($firebase_tokens, $request->message,$insert_data['message_type'],'chat' ); //return $responce;
        }

         return response()->json([
           'status' => 'success'
         ]);
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
