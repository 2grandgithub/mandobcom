<?php

namespace App\Http\Middleware;

use Closure;

class verifyApiAuth
{
    /**
     *  varify api user token
     *
     * @param   token as header
     * @param   user_id as header
     */
    public function handle($request, Closure $next)
    {
          $user_id = $request->route()->user_id ?? $request->user_id ?? $request->headers->get('user_id') ;

          if( \App\User::where( 'token',$request->headers->get('userToken') )->whereId($user_id)->exists() )
          {
              return $next($request);
          }
          else {
              return response()->json([
                  'status' => 'unValidToken'
              ]);
          }
    }
}
