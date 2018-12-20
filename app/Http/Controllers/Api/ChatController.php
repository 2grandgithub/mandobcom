<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Chat;
use DB;

class ChatController extends Controller
{
      public function list($user_id,$type)
      {
          $chat = Chat::select('message',DB::raw("COALESCE(admins.name,'') as admin_name"),
                                         DB::raw("IF(admin_id,'admin','user') as who") )
                      ->leftJoin('admins','admins.id','chat.admin_id')
                      ->where('user_id',$user_id)->where('type',$type)->get();
          return $chat;
      }

      public function store(Request $request)
      {
          $data = \Validator::make($request->all(), [
                'user_id' => 'required',
                'type' => 'required|in:Buyer,Recycable,ProducerFamily',
                'message'  => 'required',
           ]);
           if ($data->fails()) {
                  return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
           }
           $insert_data = [
             'user_id' => $request->user_id,
             'message'  => $request->message,
             'message_type'  => 'text',
             'type' => $request->type ,
           ];
           $chat = Chat::create($insert_data);
           event(new \App\Events\SendChatMessage($chat));
           // event(new \App\Events\SendChatMessage($insert_data));
           return response()->json([
             'status' => 'success'
           ]);
      }
}
