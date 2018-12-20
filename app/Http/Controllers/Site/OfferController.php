<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Company;

class OfferController extends Controller
{

      public function index($categoiry_id)
      {
          $page_name = 'offer_list';
          return view('Site/Offer/list',compact('categoiry_id','offer_list','page_name'));
      }

      //---api----
      public function get_list(Request $request)
      {
          $lang = app()->getLocale()??'ar';
          $search = $request->all();

          $AuthBuyer_id = ( auth('Buyer')->check() )? auth('Buyer')->id() : 0 ;

          switch ($request->sort)
          {
            case 'stars':
                 $sort = 'stars';
                 $sort_order = 'DESC';
              break;
            case 'views':
                 $sort = 'views';
                 $sort_order = 'DESC';
              break;
            case 'price_desc':
                 $sort = 'price';
                 $sort_order = 'DESC';
              break;
            case 'price_desc':
                 $sort = 'price_asc';
                 $sort_order = 'ASC';
              break;
            default:
                 $sort = 'offers.id';
                 $sort_order = 'DESC';
              break;
          }

          $Offers = Offer::select(
                          'offers.name_'.$lang.' as offer_name','offers.id as offer_id','offers.description_'.$lang.' as offer_description',
                           'offers.category_id','offers.sub_category_id','offers.company_id','offers.likes',
                           //--price hide if not logged in--
                            \DB::raw("If($AuthBuyer_id != 0 ,CONCAT(old_price,' ".__('page.JD')."') , '".__('page.Great prices')."') as old_price"),
                            \DB::raw("If($AuthBuyer_id != 0 ,CONCAT(new_price,' ".__('page.JD')."') , '".__('page.Great prices')."') as new_price"),
                            // 'old_price','new_price',

                           'offers.amount','offers.views' ,
                             'categories.name_'.$lang.' as category_name','sub_categories.name_'.$lang.' as sub_category_name',
                             'companies.name_'.$lang.' as company_name',
                            \DB::raw("GROUP_CONCAT(CONCAT('".asset('images/offers')."/',offers_images.image)) as image"),
                            \DB::raw(self::stars('offers_rating.stars')),
                            \DB::raw("if( shopping_carts.offer_id , 1,0 ) as in_card"),
                            \DB::raw("if( DATEDIFF( now() , offers.created_at ) <= 7 , 1,0 ) as is_new")
                      )
                      ->where(function($q)use($search){
                           if (isset($search['text']))
                              $q->where('offers.name_en','like','%'.$search['text'].'%')
                                ->orWhere('offers.name_ar','like','%'.$search['text'].'%')->orWhere('offers.id',$search['text']);
                           if (isset($search['company_id']))
                              $q->where('company_id',$search['company_id']);
                           if (isset($search['subCats_ids']))
                               $q->whereIn('sub_category_id',$search['subCats_ids'] );
                           if (isset($search['company_ids']))
                               $q->whereIn('company_id',$search['company_ids'] );
                           if (isset($search['text']))
                               $q->where('offers.name_ar','like','%'.$search['text'].'%' )
                                 ->orWhere('offers.name_en','like','%'.$search['text'].'%' );

                           //--price--
                           if (isset($search['price_from']) && isset($search['price_to']))
                               $q->where('offers.new_price','>=',$search['price_from'])->where('offers.new_price','<=',$search['price_to']);
                           if (isset($search['price_from']))
                               $q->where('offers.new_price','>=',$search['price_from']);
                           if (isset($search['price_to']))
                               $q->where('offers.new_price','<=',$search['price_to']);
                       })
                       ->where('offers.status',1)
                       ->where('offers.accapted_by_admin',1)
                       ->where('offers.category_id',$request->category_id)

                      ->leftJoin('offers_rating','offers_rating.offer_id','offers.id')
                      ->leftJoin('companies','companies.id','offers.company_id')
                      ->Join('categories','categories.id','offers.category_id')
                      ->leftJoin('sub_categories','sub_categories.id','offers.sub_category_id')
                      ->join('offers_images','offers_images.offer_id','offers.id')
                      ->leftJoin('offers_likes',function($q)use($AuthBuyer_id){
                          $q->on('offers_likes.offer_id','offers.id')->where('offers_likes.buyer_id',$AuthBuyer_id);
                      })
                      ->leftJoin('shopping_carts',function($q)use($AuthBuyer_id){
                          $q->on('shopping_carts.offer_id','offers.id')->where('shopping_carts.buyer_id',$AuthBuyer_id);
                      })
                      ->groupBy('offers.id')
                      ->orderBy($sort,$sort_order)
                      ->paginate($request->paginate_no??'15');

          $company_ids = array();
          foreach ($Offers as $offer) {
                array_push($company_ids, $offer->company_id);
          }
          $company_ids = array_unique($company_ids);

          $Companies = Company::select('name_'.$lang.' as name','id')->whereIn('id',$company_ids)->get();

          return response()->json([
              'offers' => $Offers,
              'Companies' => $Companies,
          ]);
      }

      public function details($offer_id)
      {
        $lang = app()->getLocale()??'ar';
        $AuthBuyer_id = ( auth('Buyer')->check() )?  auth('Buyer')->id() :  0 ;

        $Offer = Offer::select(
                        'offers.name_'.$lang.' as offer_name','offers.id as offer_id','offers.description_'.$lang.' as offer_description',
                         'offers.category_id','offers.sub_category_id','offers.company_id','offers.likes',
                         //--price hide if not logged in--
                         \DB::raw("If($AuthBuyer_id != 0 ,CONCAT(old_price,' ".__('page.JD')."') , '".__('page.Great prices')."') as old_price"),
                         \DB::raw("If($AuthBuyer_id != 0 ,CONCAT(new_price,' ".__('page.JD')."') , '".__('page.Great prices')."') as new_price"),
                          // 'old_price','new_price',

                         'offers.amount','offers.views' ,
                           'categories.name_'.$lang.' as category_name','sub_categories.name_'.$lang.' as sub_category_name',
                           'companies.name_'.$lang.' as company_name',
                          \DB::raw("GROUP_CONCAT(CONCAT('".asset('images/offers')."/',offers_images.image)) as image"),
                          \DB::raw(self::stars('offers_rating.stars')),
                          \DB::raw("if( shopping_carts.offer_id , 1,0 ) as in_card"),
                          \DB::raw("if( offers_likes.offer_id , 1,0 ) as is_liked")
                    )
                   ->leftJoin('offers_rating','offers_rating.offer_id','offers.id')
                   ->leftJoin('companies','companies.id','offers.company_id')
                   ->Join('categories','categories.id','offers.category_id')
                   ->leftJoin('sub_categories','sub_categories.id','offers.sub_category_id')
                   ->join('offers_images','offers_images.offer_id','offers.id')
                   ->leftJoin('offers_likes',function($q)use($AuthBuyer_id){
                       $q->on('offers_likes.offer_id','offers.id')->where('offers_likes.buyer_id',$AuthBuyer_id);
                   })
                   ->leftJoin('shopping_carts',function($q)use($AuthBuyer_id){
                       $q->on('shopping_carts.offer_id','offers.id')->where('shopping_carts.buyer_id',$AuthBuyer_id);
                   })
                   ->where('offers.status',1)
                   ->where('offers.accapted_by_admin',1)
                   ->where('offers.id',$offer_id)
                   ->groupBy('offers.id')
                   ->first();
           if(!$Offer)
              return back();
         Offer::whereId($offer_id)->increment('views');
         return view('Site/Offer/details',compact('Offer'));
      }



}
