<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Buyer;
use App\Recycable;
use App\ProducerFamily;
use App\Item;
use App\Offer;
use App\ProducerFamilyProduct;
use App\AuctionRequest;
use App\RecycablesWhenfullRequests;

class DashBoardController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        $Company_count = Company::count();
        $Buyer_count = Buyer::count();
        $Recycable_count = Recycable::count();
        $ProducerFamily_count = ProducerFamily::count();

        $Item_count = Item::count();
        $Offer_count = Offer::count();
        $ProducerFamilyProduct_count = ProducerFamilyProduct::count();
        $AuctionRequest_count = AuctionRequest::count();


        $Whenfull_is_done = RecycablesWhenfullRequests::where('is_done',1)->count();
        $Whenfull_not_done = RecycablesWhenfullRequests::where('is_done',0)->count();

        $morris_Items = \DB::select("SELECT count(id) as count , month(`created_at`) as month FROM `items` WHERE YEAR(`created_at`) = ".date("Y")." group BY month(`created_at`) ORDER by `created_at` ASC") ;
        $morris_offers = \DB::select("SELECT count(id) as count , month(`created_at`) as month FROM `offers` WHERE YEAR(`created_at`) = ".date("Y")." group BY month(`created_at`) ORDER by `created_at` ASC") ;
        $morris_recycables_whenfull_requests = \DB::select("SELECT count(id) as count , month(`created_at`) as month FROM `recycables_whenfull_requests` WHERE YEAR(`created_at`) = ".date("Y")." group BY month(`created_at`) ORDER by `created_at` ASC") ;
        $morris_producer_family_products = \DB::select("SELECT count(id) as count , month(`created_at`) as month FROM `producer_family_products` WHERE YEAR(`created_at`) = ".date("Y")." group BY month(`created_at`) ORDER by `created_at` ASC") ;
        $morris_auction_requests = \DB::select("SELECT count(id) as count , month(`created_at`) as month FROM `auction_requests` WHERE YEAR(`created_at`) = ".date("Y")." group BY month(`created_at`) ORDER by `created_at` ASC") ;


        return view('Admin.DashBoard.DashBoard',compact('Company_count','Buyer_count','Recycable_count','ProducerFamily_count',
                            'Item_count','Offer_count','ProducerFamilyProduct_count','AuctionRequest_count',
                            'Whenfull_is_done','Whenfull_not_done', 'morris_Items','morris_offers','morris_recycables_whenfull_requests',
                            'morris_producer_family_products','morris_auction_requests' ));
    }
}
