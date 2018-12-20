<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CommentsItem;
use App\CommentsOffer;
use App\Item;
use App\Offer;
use App\Category;

use App\AuctionRequest;

class ActionController extends Controller
{
      public function __construct()
      {
         // $this->middleware('verifyApiJWT:Buyer,true');//->except(['categoires','list','categories_of_company','subCategories_of_company']);
         // $this->middleware('verifyApiJWT:Buyer,true')->only(['like_add_or_remove','add_comment']);
      }

      // public function index()
      // {
      //    $lang = app()->getLocale()??'ar';
      //    $Categories = Category::select('name_'.$lang.' as label','id as value')->get();
      //    return view('Site.Action.index',compact('Categories'));
      // }
      //
      // public function get_list(Request $request)
      // {
      //       $lang = app()->getLocale()??'ar';
      //       $val = $request->search;
      //       $category_id = $request->category_id;
      //       $AuctionRequest = AuctionRequest::select('auction_requests.*','categories.name_'.$lang.' as category_name'
      //              // ,'buyers.name as buyer_name','companies.name_'.$lang.' as company_name'
      //              )
      //        ->where(function($q)use($val,$category_id,$lang){
      //            if ($val)
      //                $q->where('title','like','%'.$val.'%') ;
      //            if ($category_id)
      //                $q->where('category_id',$category_id);
      //       })
      //       ->join('categories','categories.id','auction_requests.category_id')
      //       // ->leftJoin('buyers','buyers.id','auction_requests.buyer_id')
      //       // ->leftJoin('companies','companies.id','auction_requests.company_id')
      //       ->groupBy('auction_requests.id')
      //       ->latest('auction_requests.id')->paginate();
      //       return $AuctionRequest;
      // }
      //
      // public function show($id)
      // {
      //     $lang = app()->getLocale()??'ar';
      //     $AuctionRequest = AuctionRequest::findOrFail($id);
      //
      //     $Offers = AuctionOffer::select('auction_offers.*','companies.name_'.$lang.' as company_name','companies.phone as company_phone')
      //                 ->where('auction_request_id',$auction_id)
      //                 ->join('companies','companies.id','auction_offers.company_id')
      //                 ->groupBy('auction_offers.id')
      //                 ->orderBy('auction_offers.price_offer')->get();
      //       return view('Site.Action.show',compact('AuctionRequest','Offers'));
      // }


      //
      // public function get_list(Request $request)
      // {
      //       $lang = app()->getLocale()??'ar';
      //       $val = $request->search;
      //       $category_id = $request->category_id;
      //       $AuctionRequest = AuctionRequest::select('auction_requests.*','categories.name_'.$lang.' as category_name',
      //              'buyers.name as buyer_name','companies.name_'.$lang.' as company_name')
      //        ->where(function($q)use($val,$category_id,$lang){
      //            if ($val)
      //                $q->where('title','like','%'.$val.'%')->orWhere('auction_requests.id',$val)
      //                      ->orWhere('buyers.name','like','%'.$val.'%')->orWhere('companies.name_'.$lang,'like','%'.$val.'%');
      //            if ($category_id)
      //                $q->where('category_id',$category_id);
      //       })
      //       ->join('categories','categories.id','auction_requests.category_id')
      //       ->leftJoin('buyers','buyers.id','auction_requests.buyer_id')
      //       ->leftJoin('companies','companies.id','auction_requests.company_id')
      //       ->groupBy('auction_requests.id')
      //       ->latest('auction_requests.id')->paginate();
      //       return $AuctionRequest;
      // }


      public function get_comments_and_related_items(Request $request)
      {
            $data = \Validator::make($request->all(), [
               'item_id' => 'required',
               'category_id' => 'required',
               'type' => 'required|in:item,offer',
            ]);
            if ($data->fails()) {
                   return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
            }
            if ($request->type == 'item')
            {
              $Comments = CommentsItem::select('comment','buyers.name','comments_item.created_at as date')
                                ->leftJoin('buyers','buyers.id','comments_item.buyer_id')
                                ->where('item_id',$request->item_id)
                                ->latest('comments_item.created_at')->limit(25)->groupBy('comments_item.id')->get();
            }
            else if($request->type == 'offer')
            {

              $Comments = CommentsOffer::select('comment','buyers.name')
                                ->leftJoin('buyers','buyers.id','comments_offer.buyer_id')
                                ->where('offer_id',$request->item_id)
                                ->latest('comments_offer.id')->limit(25)->groupBy('comments_offer.id')->get();
            }


            return response()->json([
                'Comments' => $Comments,
                'RelatedItems' => $this->get_related_items($request->category_id,$request->item_id,$request->type),
            ]);

      }

      public function get_related_items($category_id,$item_id,$type)
      {
            $lang = app()->getLocale()??'ar';
            $AuthBuyer_id = ( auth('Buyer')->check() )?  auth('Buyer')->id() :  0 ;
            if($type == 'item')
            {
                $item = Item::select('items.name_'.$lang.' as item_name','items.id as item_id','items.description_'.$lang.' as item_description',
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
                 ->where('items.category_id',$category_id)
                 ->where('items.id','!=',$item_id)
                 ->groupBy('items.id')
                 ->limit(8)
                 ->get();
            }
            else if($type == 'offer')
            {
              $item = Offer::select(
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
                                \DB::raw("if( shopping_carts.offer_id , 1,0 ) as in_card")
                          )
                           ->where('offers.status',1) ->where('offers.accapted_by_admin',1)
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
                          ->where('offers.category_id',$category_id)
                          ->where('offers.id','!=',$item_id)
                          ->groupBy('offers.id')
                          ->limit(8)
                          ->get();
            }

             return $item;
      }

      public function like_add_or_remove($type,$item_id)
      {      
           $AuthBuyer_id = ( auth('Buyer')->check() )?  auth('Buyer')->id() :  0 ;
           $case = 1;
           if ($type == 'item')
           {
                 $Like = \App\Like::where('buyer_id',$AuthBuyer_id)->where('item_id',$item_id)->first();
                 if ($Like)
                 {
                    $Like->delete();
                    Item::whereId($item_id)->decrement('likes');
                    $case = 0;
                 }
                 else {
                      \App\Like::create([
                          'buyer_id' => $AuthBuyer_id,
                          'item_id'  => $item_id
                     ]);
                     Item::whereId($item_id)->increment('likes');
                 }
           }
           else if ($type == 'offer')
           {
                 $AuthBuyer_id = ( auth('Buyer')->check() )?  auth('Buyer')->id() :  0 ;
                 $Like = \App\OfferLike::where('buyer_id',$AuthBuyer_id)->where('offer_id',$item_id)->first();
                 if ($Like)
                 {
                    $Like->delete();
                    Offer::whereId($item_id)->decrement('likes');
                    $case = 0;
                 }
                 else {
                      \App\OfferLike::create([
                          'buyer_id' => $AuthBuyer_id,
                          'offer_id'  => $item_id
                     ]);
                     Offer::whereId($item_id)->increment('likes');
                 }
           }
           return response()->json([
             'status' => 'success',
             'case' => $case
           ]);
      }

      public function add_comment(Request $request)
      {
          $data = \Validator::make($request->all(), [
               'item_id' => 'required',
               'comment' => 'required',
               'type' => 'required|in:item,offer',
          ]);
          if ($data->fails()) {
                 return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
          }
          $AuthBuyer_id = ( auth('Buyer')->check() )?  auth('Buyer')->id() :  0 ;

          if ($request->type == 'item') {
              CommentsItem::create([
                 'item_id' => $request->item_id ,
                 'buyer_id' => $AuthBuyer_id,
                 'comment' => $request->comment
             ]);
          }
          else if($request->type == 'offer')
          {
               CommentsOffer::create([
                  'offer_id' => $request->item_id ,
                  'buyer_id' => $AuthBuyer_id,
                  'comment' => $request->comment
              ]);
          }
          return response()->json([
            'status' => 'success'
          ]);
      }


}
