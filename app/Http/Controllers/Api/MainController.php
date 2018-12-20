<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Offer;
use App\Category;
use App\Company;
use App\ProducerFamilyProduct;
use App\RecycablesNews;
use App\AuctionRequest;
use App\Slider;

class MainController extends Controller
{

      public function main_list($buyer_id)
      {
           $offer = Offer::select('offers.id as id','offers.name_en','offers.name_ar','description_en','description_ar' ,
                              'likes','amount',
                              'companies.name_en as company_name_en','companies.name_ar as company_name_ar',
                         //--price hide if not logged in--
                          \DB::raw("If($buyer_id != 0 ,old_price,0) as old_price"),
                          \DB::raw("If($buyer_id != 0 ,new_price,0) as new_price"),
                         //--get is_like--
                         \DB::raw("IF ( offers_likes.buyer_id ,1,0) as is_like") ,
                         //--get in_card--
                         \DB::raw("IF ( shopping_carts.buyer_id ,1,0) as in_card") ,
                         //--get images--
                         \DB::raw("GROUP_CONCAT(CONCAT('".asset('images/offers')."/',offers_images.image)) as images"),
                         //--get rating--
                         \DB::raw(self::stars('offers_rating.stars'))
                       )
                       ->leftJoin('offers_images','offers_images.offer_id','offers.id')
                       ->leftJoin('offers_likes',function($q)use($buyer_id){
                           $q->on('offers_likes.offer_id','offers.id')->where('offers_likes.buyer_id',$buyer_id);
                       })
                       ->leftJoin('shopping_carts',function($q)use($buyer_id){
                           $q->on('shopping_carts.offer_id','offers.id')->where('shopping_carts.buyer_id',$buyer_id);
                       })
                       ->leftJoin('offers_rating','offers_rating.offer_id','offers.id')
                       ->leftJoin('companies','companies.id','offers.company_id')
                       ->where('offers.status',1)
                       ->orderBy('offers.id','DESC')
                       ->groupBy('offers.id')
                       ->limit(8)->get();


           $Category = Category::select('id','name_en','name_ar','logo')->where('status',1)->latest()->limit(8)->get();



           $Company = Company::select('companies.id','companies.name_en','companies.name_ar','logo' ,
                              \DB::raw("IF(c_m.membership_id,c_m.membership_id,1) as membership_id"), 'memberships.name_ar as membership_name'
                            )
                            ->leftJoin('company_membership as c_m',function($q){
                                $q->on('c_m.company_id','companies.id')->whereRaw("NOW() BETWEEN c_m.from AND c_m.to")->where('confirmed',1);
                            })
                            ->leftJoin('memberships',function($q){
                                // if have membership else membership is (1) -> normail
                                $q->on('memberships.id',\DB::raw("IF(c_m.membership_id,c_m.membership_id,1)"));
                            })
                           ->where('email_verified',1)->where('phone_verified',1)->where('is_accapted_by_admin',1)->where('status',1)
                          ->latest('membership_id')->latest('id')->limit(8)->get();



           $Recycable = RecycablesNews::select('id','title_ar','title_en','body_ar','body_en','image')->where('status',1)->latest()->limit(8)->get();
           $ProducerFamilyProduct = ProducerFamilyProduct::select(
               'producer_family_products.name_en as product_name_en','producer_family_products.name_ar as product_name_ar',
               'image','descraption_ar','descraption_en' ,'price','price_unit',
               'producer_family.name as family_name','producer_family.phone as family_phone','producer_family.email as family_email',
               'cities.name_en as city_name_en','cities.name_ar as city_name_ar',
               'governorates.name_en as governorate_name_en','governorates.name_ar as governorate_name_ar'
               )
               ->leftJoin('producer_family',function($q){
                   $q->on('producer_family.id','producer_family_products.ProducerFamily_id')->where('producer_family.status',1);
               })
               ->leftJoin('cities','cities.id','producer_family.city_id')
               ->leftJoin('governorates','governorates.id','producer_family.governorate_id')
               ->where('producer_family_products.status',1)
               ->groupBy('ProducerFamily_id') //only one product for each family
                 ->limit(8)->get();

           $AuctionRequest = AuctionRequest::select('auction_requests.buyer_id','auction_requests.company_id','auction_requests.title',
                              'auction_requests.description','auction_requests.required_quantity','auction_requests.image',
                  'categories.name_ar as category_name_ar',
                  'categories.name_en as category_name_en',
                  'buyers.name as buyer_name','companies.name_ar as company_name_ar','companies.name_en as company_name_en')
               ->join('categories','categories.id','auction_requests.category_id')
               ->leftJoin('buyers','buyers.id','auction_requests.buyer_id')
               ->leftJoin('companies','companies.id','auction_requests.company_id')
               ->groupBy('auction_requests.id')
               ->latest('auction_requests.id')->limit(8)->get();

            $Sliders = Slider::select('image','link')->where('status',1)->get();

            return response()->json([
              'Offer' => $offer ,
              'Category' => $Category ,
              'Company' => $Company ,
              'Recycable' => $Recycable ,
              'AuctionRequest' => $AuctionRequest ,
              'ProducerFamily' => $ProducerFamilyProduct ,
              'Sliders' => $Sliders ,
            ]);
      }

}
