<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ReciptController extends Controller
{

      public function __construct()
      {
          // $this->middleware('verifyApiJWT:Buyer,true')->only('add_or_remove');
          $this->middleware('auth:Buyer')->only('index');
      }

      public function index()
      {                                         
          return view('Site/Recipt/index' );
      }


}
