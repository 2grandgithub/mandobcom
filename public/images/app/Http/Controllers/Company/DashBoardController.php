<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Buyer;
use App\Recycable;
use App\ProducerFamily;
use App\Item;
use App\Offer;
use App\Recipt;
use App\ProducerFamilyProduct;
use App\AuctionRequest;
use App\RecycablesWhenfullRequests;

class DashBoardController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:Company');
       // $this->middleware('lang');
    }

    public function index()
    {
        $Item_count = Item::where('company_id',auth('Company')->id())->count();
        $Offer_count = Offer::where('company_id',auth('Company')->id())->count();
        $Recipt_count = Recipt::where('company_id',auth('Company')->id())->count();
        $AuctionRequest_count = AuctionRequest::count();

        $Recipt_not_finshed_count = Recipt::where('company_id',auth('Company')->id())
                  ->where(function($q){
                    $q->where('is_paid',0)->orWhere('is_delivered',0);
                  })->count();
        $Recipt_finshed_count = Recipt::where('company_id',auth('Company')->id())
                              ->where('is_paid',1)->where('is_delivered',1)->count();

        $morris_recipt = \DB::select("SELECT count(id) as count , month(`created_at`) as month FROM `recipts` WHERE YEAR(`created_at`) = ".date("Y")." group BY month(`created_at`) ORDER by `created_at` ASC") ;

        return view('Company.DashBoard.DashBoard',compact( 'Item_count','Offer_count','Recipt_count','AuctionRequest_count',
                                        'Recipt_not_finshed_count','Recipt_finshed_count',
                                        'morris_recipt'
                                        ));
    }
}
