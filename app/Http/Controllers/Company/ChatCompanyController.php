<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ChatCompany;

class ChatCompanyController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:Company');
       // $this->middleware('lang');
    }


    public function index($type)
    {
        return view('Company.Chat.index');
    }

  //  //-------------------------Start get users--------------------------------
  //   public function get_chat_users_type_Buyer() // Buyer
  //   {
  //       $users = Chat::select('name','buyers.id as user_id','buyers.model',
  //                             'chat.type','message_type','message' )
  //                    ->leftJoin('buyers','buyers.id','chat.user_id')->where('type','Buyer')->whereNull('admin_id')
  //                    ->distinct('chat.user_id')->groupBy('chat.user_id')->latest('chat.id')->get();
  //
  //       return $users;
  //   }
  //
  //   public function get_chat_users_type_Recycable() // Recycable
  //   {
  //       $users = Chat::select('name','recycables.id as user_id','recycables.model',
  //                             'chat.type','message_type','message' )
  //                    ->leftJoin('recycables','recycables.id','chat.user_id')->where('type','Recycable')->whereNull('admin_id')
  //                    ->distinct('chat.user_id')->groupBy('chat.user_id')->latest('chat.id')->get();
  //
  //       return $users;
  //   }
  //
  //   public function get_chat_users_type_ProducerFamily() // ProducerFamily
  //   {
  //       $users = Chat::select('name','producer_family.id as user_id','producer_family.model',
  //                             'chat.type','message_type','message' )
  //                    ->leftJoin('producer_family','producer_family.id','chat.user_id')->where('type','ProducerFamily')->whereNull('admin_id')
  //                    ->distinct('chat.user_id')->groupBy('chat.user_id')->latest('chat.id')->get();
  //
  //       return $users;
  //   }
  // //-------------------------End get users--------------------------------
  //
  //
  //
  //   public function get_latest_chat($type)
  //   {
  //       $user = Chat::latest()->select('user_id')->first();
  //       $chat = Chat::where('user_id',$user->user_id)->where('type',$type)->limit(100)->get();
  //       return $chat;
  //   }
  //
  //   public function get_chat($user_id,$type)
  //   {
  //       $chat = Chat::where('user_id',$user_id)->where('type',$type)->limit(100)->get();
  //       return $chat;
  //   }
  //
  //   public function store(Request $request)
  //   {
  //     // return ($request->all());
  //     // dd($request->all());
  //       $data = \Validator::make($request->all(), [
  //             'user_id' => 'required',
  //             'message'  => '',
  //             'image'  => '',
  //             'type'  => '',
  //        ]);
  //        if ($data->fails()) {
  //               return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
  //        }
  //        $insert_data = [
  //          'user_id' => $request->user_id,
  //          'message'  => $request->message,
  //          'message_type'  => 'text',
  //          'type' => $request->type,
  //          'admin_id' => auth('Admin')->id(),
  //        ];
  //        if($request->hasFile('image'))
  //        {
  //            $fileName  = rand(11111,99999).'.'.$request->image->getClientOriginalExtension(); // renameing image
  //            $destinationPath = public_path('images/chat');
  //            $request->image->move($destinationPath, $fileName); // uploading file to given path
  //            $insert_data['message'] = $fileName;
  //            $insert_data['message_type'] = 'image';
  //        }
  //        $chat = Chat::create($insert_data);
  //        event(new \App\Events\SendMessage($chat));
  //
  //        $firebase_tokens = \App\Buyer::whereId($request->user_id)->whereNotNull('firebase_token')->pluck('firebase_token')->toArray();
  //       if ($firebase_tokens)
  //       {
  //           $responce = \App\PushNotification::chat($firebase_tokens,$request->message ); //return $responce;
  //       }
  //
  //        return response()->json([
  //          'status' => 'success',
  //          'data' => $chat
  //        ]);
  //   }



}
