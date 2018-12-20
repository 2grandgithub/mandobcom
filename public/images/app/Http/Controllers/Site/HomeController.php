<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\Offer;
use App\Company;
use App\ProducerFamilyProduct;
use App\RecycablesNews;
use App\Category;
use App\AuctionRequest;
use App\Slider;
use App\Setting;

class HomeController extends Controller
{
      public $lang;
      public $AuthBuyer_id;

      public function index()
      {
          $this->lang = app()->getLocale()??'ar';  $this->lang = 'ar';
          $this->AuthBuyer_id = ( auth('Buyer')->check() )? auth('Buyer')->id() : 0 ;

          // $page_name = 'items_list';
          // return $this->Companies_list();
          $data = [
              'items' => $this->items_list(),
              'offers' => $this->offers_list(),
              'Categories' => $this->Categories_list(),
              'companies' => $this->Companies_list(),
              'ProducerFamilyProduct' => $this->producer_family_products_list(),
              'RecycablesNews' => $this->RecycablesNews_list(),
              'AuctionRequest' => $this->AuctionRequest_list(),
              'Sliders' => $this->Slider_list(),
              'ads' => $this->ads_list(),
          ];
          return view('Site.Home',compact('categoiry_id','data'));
      }

      public function get_list()
      {
            $this->lang = app()->getLocale()??'ar';
            $this->lang =  'ar';                                                      dd($this->lang);
            $this->AuthBuyer_id = ( auth('Buyer')->check() )? auth('Buyer')->id() : 0 ;

            return response()->json([
                'AuthBuyer_id' => $this->AuthBuyer_id,
                'items' => $this->items_list(),
                'offers' => $this->offers_list(),
                'companies' => $this->Companies_list(),
                'ProducerFamilyProduct' => $this->producer_family_products_list(),
                'RecycablesNews' => $this->RecycablesNews_list(),
                'AuctionRequest' => $this->AuctionRequest_list(),
                'Sliders' => $this->Slider_list(),
                'ads' => $this->ads_list(),

            ]);
      }

      public function items_list()
      {
           $lang = $this->lang;
           $AuthBuyer_id = $this->AuthBuyer_id;

           $items = Item::select('items.name_'.$lang.' as item_name','items.id as item_id','items.description_'.$lang.' as item_description',
                          'items.category_id','items.sub_category_id','items.company_id','items.likes',
                          'items.minimum_amount','items.maximum_amount','items.views' ,
                          'categories.name_'.$lang.' as category_name','sub_categories.name_'.$lang.' as sub_category_name',
                          'companies.name_'.$lang.' as company_name',
                   \DB::raw("if( $AuthBuyer_id , CONCAT(items.price,' ".__('page.JD')."') , '".__('page.Great prices')."' ) as price"),
                   \DB::raw("CONCAT('".asset('images/items')."/',items_images.image) as image"),
                   \DB::raw(self::stars('rating.stars')),
                   \DB::raw("if( shopping_carts.item_id , 1,0 ) as in_card")
                 )
            ->where('items.status',1)->where('items.accapted_by_admin',1)
            ->Join('categories','categories.id','items.category_id')
            ->leftJoin('sub_categories','sub_categories.id','items.sub_category_id')
            ->Join('companies','companies.id','items.company_id')
            ->Join('items_images','items_images.item_id','items.id')
            ->leftJoin('rating','rating.item_id','items.id')
            ->leftJoin('shopping_carts',function($q)use($AuthBuyer_id){
                $q->on('shopping_carts.item_id','items.id')->where('shopping_carts.buyer_id',$AuthBuyer_id);
            })
            ->groupBy('items.id')
            ->latest('rating.stars')
            ->limit(10)
            ->get();
            return $items;
      }

      public function offers_list()
      {
          $lang = $this->lang;
          $AuthBuyer_id = $this->AuthBuyer_id;

          $Offers = Offer::select(
                          'offers.name_'.$lang.' as offer_name','offers.id as offer_id','offers.description_'.$lang.' as offer_description',
                           'offers.category_id','offers.sub_category_id','offers.company_id','offers.likes',
                           //--price hide if not logged in--
                            \DB::raw("If($AuthBuyer_id != 0 ,CONCAT(old_price,' ".__('page.JD')."') , '".__('page.Great prices')."') as old_price"),
                            \DB::raw("If($AuthBuyer_id != 0 ,CONCAT(old_price,' ".__('page.JD')."') , '".__('page.Great prices')."') as new_price"),
                             // 'old_price','new_price',

                             'offers.amount','offers.views' ,
                             'categories.name_'.$lang.' as category_name','sub_categories.name_'.$lang.' as sub_category_name',
                             'companies.name_'.$lang.' as company_name',
                            \DB::raw("CONCAT('".asset('images/offers')."/',offers_images.image) as image"),
                            \DB::raw(self::stars('offers_rating.stars')),
                            \DB::raw("if( shopping_carts.offer_id , 1,0 ) as in_card")
                      )
                       ->where('offers.status',1)
                       ->where('offers.accapted_by_admin',1)

                      ->leftJoin('offers_rating','offers_rating.offer_id','offers.id')
                      ->leftJoin('companies','companies.id','offers.company_id')
                      ->Join('categories','categories.id','offers.category_id')
                      ->leftJoin('sub_categories','sub_categories.id','offers.sub_category_id')
                      ->join('offers_images','offers_images.offer_id','offers.id')
                      ->leftJoin('shopping_carts',function($q)use($AuthBuyer_id){
                          $q->on('shopping_carts.offer_id','offers.id')->where('shopping_carts.buyer_id',$AuthBuyer_id);
                      })
                      ->groupBy('offers.id')
                      ->latest('offers_rating.stars')
                      ->limit(10)
                      ->get();
            return $Offers;
      }

      public function Companies_list()
      {
          $lang = $this->lang;
          $Company = Company::select('companies.id','companies.name_'.$lang.' as name','logo','companies.membership_id',
                             'memberships.name_ar as membership_name',
                             \DB::raw("IF(c_m.membership_id,c_m.membership_id,1) as membership_id")
                           )
                           ->leftJoin('company_membership as c_m',function($q){
                               $q->on('c_m.company_id','companies.id')->whereRaw("NOW() BETWEEN c_m.from AND c_m.to")->where('confirmed',1);;
                           })
                           ->leftJoin('memberships',function($q){
                               // if have membership else membership is (1) -> normail
                               $q->on('memberships.id',\DB::raw("IF(c_m.membership_id,c_m.membership_id,1)"));
                           })
                          ->where('email_verified',1)->where('phone_verified',1)->where('is_accapted_by_admin',1)->where('status',1)
                         ->latest('membership_id')->latest('id')->limit(10)->get();
          return $Company;
      }

      public function producer_family_products_list()
      {
          $lang = $this->lang;
          $Family = ProducerFamilyProduct::select('id','name_'.$lang.' as name','image')->where('status',1)
                          ->groupBy('ProducerFamily_id') //only one product for each family
                          ->latest('id')
                          ->limit(10)
                          ->get();
          return $Family;
      }

      public function RecycablesNews_list()
      {
          $lang = $this->lang;
          $News = RecycablesNews::select('id','title_'.$lang.' as name','image')->where('status',1)
                   ->latest('id')->limit(10)->get();
          return $News;
      }

      public function Categories_list()
      {
          $lang = $this->lang;
          $Category = Category::select('name_'.$lang.' as name','logo','id')->where('status',1)->limit(10)->get();
          return $Category;
      }

      public function AuctionRequest_list()
      {
          $lang = $this->lang;
          $Auction = AuctionRequest::select('auction_requests.id','title','image','categories.name_'.$lang.' as category_name')
                ->join('categories','categories.id','auction_requests.category_id')
                ->where('auction_requests.status',1)
                ->groupBy('auction_requests.id')
                ->limit(10)->get();
          return $Auction;
      }

      public function Slider_list()
      {
          return Slider::select('id','name','image','link')->where('status',1)->limit(10)->get();
      }

      public function ads_list()
      {
          return Setting::where('title','ads_site_home_fullWidth')->orWhere('title','ads_site_home_fullWidth_link')
                        ->orWhere('title','ads_site_home_halfWidth_1')->orWhere('title','ads_site_home_halfWidth_2')
                        ->orWhere('title','ads_site_home_halfWidth_1_link')->orWhere('title','ads_site_home_halfWidth_2_link')
                        ->pluck('value','title');
      }


}
