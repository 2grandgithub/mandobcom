<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class verifyApiJWT
{
    /**
     *  varify jwt
     *
     * @param   userToken as header
     * @param   user_id or recycable_id or buyer_id ->  as header
     * @param   check_verification as boolean
     */
    public function handle(Request $request, Closure $next , $type, $check_verification=false,$tokenNotRequired=false)
    {  
          $user_id = $request->route()->user_id ?? $request->user_id ?? $request->headers->get('user_id') ??
            $request->route()->recycable_id ?? $request->recycable_id ?? $request->headers->get('recycable_id') ??
            $request->route()->buyer_id ?? $request->buyer_id ?? $request->headers->get('buyer_id') ??
            $request->route()->ProducerFamily_id ?? $request->ProducerFamily_id ?? $request->headers->get('ProducerFamily_id') ;

            if($tokenNotRequired){
              if(!$user_id || $user_id ==0|| $user_id ==-1){
                return $next($request);
              }
           }
          switch ($type)
          {
            case 'Recycable':
                $user = \App\Recycable::where( 'jwt',$request->headers->get('userToken') )->whereId($user_id)->first();
              break;
            case 'Buyer':
                $user = \App\Buyer::where( 'jwt',$request->headers->get('userToken') )->whereId($user_id)->first();
              break;
            case 'ProducerFamily':
                $user = \App\ProducerFamily::where( 'jwt',$request->headers->get('userToken') )->whereId($user_id)->first();
              break;
          }

          if( $user )
          {
              if ($check_verification)
              {
                  if (!$user->email_verified || !$user->phone_verified){
                      return response()->json([
                          'status' => 'unVerified'
                      ]);
                  }
              }
              return $next($request);
          }
          else {
              return response()->json([
                  'status' => 'unValidToken'
              ]);
          }
    }
}
