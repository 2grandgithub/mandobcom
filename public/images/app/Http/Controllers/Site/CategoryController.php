<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index($type)
    {
        return view('Site.Category.index',compact('type'));
    }

}
