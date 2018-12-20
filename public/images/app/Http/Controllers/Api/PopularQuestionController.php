<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PopularQuestions;

class PopularQuestionController extends Controller
{
     public function list()
     {
         $popularQuestions = PopularQuestions::where('status',1)->select(['id','body','answer'])->latest()->get();
         return $popularQuestions;
     }
}
