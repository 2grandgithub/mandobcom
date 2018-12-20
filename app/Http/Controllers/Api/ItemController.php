<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\CategoryCompany;
use App\Category;
use App\SubCategory;
use App\Like;
use App\OfferLike;
use App\Rating;
use App\OffersRating;
use App\CommentsItem;
use App\CommentsOffer;

class ItemController extends Controller
{
    public function __construct()
    {
       $this->middleware('verifyApiJWT:Buyer,true')->except(['categoires','list','categories_of_company','subCategories_of_company']);
    }

    public function categoires($company_id)
    {
        $related_category_ids = CategoryCompany::where('company_id',$company_id)->pluck('category_id');
        $categoires = Category::select('id','name_en','name_ar')->whereIn('id',$related_category_ids)->where('status',1)->get();
        return $categoires;
    }

    public function list(Request $request)
    {
          //----------START validate user token if buyer_id ------------
            if ($request->buyer_id)
            {
                if( !$request->headers->has('userToken') )
                  return response()->json([ 'status' => 'unValidToken' ]);
            }
            $buyer_id = $request->buyer_id??'0';
          //----------START validate user token if buyer_id ------------
          $data = \Validator::make($request->all(), [
             'buyer_id' => '',
             'company_id' => '',
             'category_id' => '',
             'sub_category_id' => '',
             'name' => '',
             'order' => 'in:null,price_high,price_low,views_high,views_low,rate_high,rate_low',
          ]);
          if ($data->fails()) {
                 return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
          }
          $category_id = $request->category_id??null;
          $sub_category_id = $request->sub_category_id??null;
          $name = $request->name??null;
          $company_id = $request->company_id??null;

          switch ($request->order)
          {
            case 'stars_high':
                  $orderBy = 'stars';
                  $orderT = 'DESC';
              break;
            case 'stars_low':
                  $orderBy = 'stars';
                  $orderT = 'ASC';
              break;
            case 'views_high':
                  $orderBy = 'items.views';
                  $orderT = 'DESC';
              break;
            case 'views_low':
                  $orderBy = 'items.views';
                  $orderT = 'ASC';
              break;
            case 'rate_high':
                  $orderBy = 'stars';
                  $orderT = 'DESC';
              break;
            case 'rate_low':
                  $orderBy = 'stars';
                  $orderT = 'ASC';
              break;
            case 'price_high':
                  $orderBy = 'price';
                  $orderT = 'DESC';
              break;
            case 'price_low':
                  $orderBy = 'price';
                  $orderT = 'ASC';
              break;

            default:
                  $orderBy = 'items.id';
                  $orderT = 'DESC';
              break;
          }

          $items = Item::select('items.id','items.name_en','items.name_ar','description_en','description_ar','likes',
                        'minimum_amount','maximum_amount','companies.name_en as company_name_en','companies.name_ar as company_name_ar',
                        //--price--
                        \DB::raw("If($buyer_id != 0 ,price,0) as price"),
                        //--get is_favourite--
                        \DB::raw("IF ( favourites.buyer_id ,1,0) as is_favourite") ,
                        //--get is_like--
                        \DB::raw("IF ( likes.buyer_id ,1,0) as is_like") ,
                        //--get in_card--
                        \DB::raw("IF ( shopping_carts.buyer_id ,1,0) as in_card") ,
                        //--get images--
                        \DB::raw("GROUP_CONCAT(CONCAT('".asset('images/items')."/',items_images.image)) as images") ,
                        //--get rating--
                        \DB::raw(self::stars('rating.stars'))
                      )
                      ->leftJoin('items_images','items_images.item_id','items.id')
                      ->leftJoin('favourites',function($q)use($buyer_id){
                          $q->on('favourites.item_id','items.id')->where('favourites.buyer_id',$buyer_id);
                      })
                      ->leftJoin('likes',function($q)use($buyer_id){
                          $q->on('likes.item_id','items.id')->where('likes.buyer_id',$buyer_id);
                      })
                      ->leftJoin('shopping_carts',function($q)use($buyer_id){
                          $q->on('shopping_carts.item_id','items.id')->where('shopping_carts.buyer_id',$buyer_id);
                      })
                      ->leftJoin('rating','rating.item_id','items.id')
                      ->leftJoin('companies','companies.id','items.company_id')
                      ->where('items.status',1)
                      ->where('items.accapted_by_admin',1)
                      ->where(function($q)use($sub_category_id,$category_id,$name,$company_id){
                          if($sub_category_id)
                              $q->where('items.sub_category_id',$sub_category_id);
                          if($category_id)
                              $q->where('items.category_id',$category_id);
                          if($name)
                              $q->where('items.name_ar','like','%'.$name.'%')->orWhere('items.name_en','like','%'.$name.'%');
                          if($company_id)
                              $q->where('items.company_id',$company_id);
                      })
                      ->orderBy($orderBy,$orderT)
                      ->groupBy('items.id')
                      ->simplePaginate();

          return $items;
    }

    public function categories_of_company($company_id)
    {
        $category_ids = Item::where('company_id',$company_id)->distinct('category_id')->pluck('category_id');
        $categories = Category::select('id','name_en','name_ar','logo')->where('status',1)->whereIn('id',$category_ids)->get();
        return $categories;
    }


    public function subCategories_of_company($company_id)
    {
        $subCategory_ids = Item::where('company_id',$company_id)->distinct('sub_category_id')->pluck('sub_category_id');
        $subcategories = SubCategory::select('id','name_en','name_ar','logo')->where('status',1)->whereIn('id',$subCategory_ids)->get();
        return $subcategories;
    }



    public function get_comments(Request $request)
    {
          $data = \Validator::make($request->all(), [
             'buyer_id' => 'required',
             'item_id' => 'required',
             'type' => 'required|in:item,offer',
          ]);
          if ($data->fails()) {
                 return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
          }
          if ($request->type == 'item')
          {
            $responce = CommentsItem::select('comment','buyers.name','comments_item.created_at as date')
                              ->leftJoin('buyers','buyers.id','comments_item.buyer_id')
                              ->where('item_id',$request->item_id)
                              ->latest('comments_item.created_at')->groupBy('comments_item.id')->get();
          }
          else if($request->type == 'offer')
          {

            $responce = CommentsOffer::select('comment','buyers.name')
                              ->leftJoin('buyers','buyers.id','comments_offer.buyer_id')
                              ->where('offer_id',$request->item_id)
                              ->latest('comments_offer.id')->groupBy('comments_offer.id')->get();
          }
           return $responce;
    }

    public function like_add_or_remove($type,$buyer_id,$item_id)
    {
         if ($type == 'item')
         {
               $Like = Like::where('buyer_id',$buyer_id)->where('item_id',$item_id)->first();
               if ($Like)
               {
                  $Like->delete();
                  Item::whereId($item_id)->decrement('likes');
               }
               else {
                    Like::create([
                        'buyer_id' => $buyer_id,
                        'item_id'  => $item_id
                   ]);
                   Item::whereId($item_id)->increment('likes');
               }
         }
         else if ($type == 'offer')
         {
               $Like = OfferLike::where('buyer_id',$buyer_id)->where('offer_id',$item_id)->first();
               if ($Like)
               {
                  $Like->delete();
               }
               else {
                    OfferLike::create([
                        'buyer_id' => $buyer_id,
                        'offer_id'  => $item_id
                   ]);
               }
         }
         return response()->json([
           'status' => 'success'
         ]);
    }

    public function add_comment(Request $request)
    {
        $data = \Validator::make($request->all(), [
             'buyer_id' => 'required',
             'item_id' => 'required',
             'comment' => 'required',
             'type' => 'required|in:item,offer',
        ]);
        if ($data->fails()) {
               return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
        }
        if ($request->type == 'item') {
            CommentsItem::create($request->all());
        }
        else if($request->type == 'offer')
        {
             CommentsOffer::create([
                'offer_id' => $request->item_id ,
                'buyer_id' => $request->buyer_id,
                'comment' => $request->comment
            ]);
        }
        return response()->json([
          'status' => 'success'
        ]);
    }

    public function add_stars(Request $request)
    {
          $data = \Validator::make($request->all(), [
               'buyer_id' => 'required',
               'item_id' => 'required',
               'stars' => 'required',
               'type' => 'required|in:item,offer',
          ]);
          if ($data->fails()) {
                 return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
          }
          if ($request->type == 'item')
          {
                $Rating = Rating::where('buyer_id',$request->buyer_id)->where('item_id',$request->item_id)->first();
                if ($Rating)
                {
                   $Rating->update([ 'stars' => $request->stars ]);
                }
                else {
                  Rating::created($request->all());
                }
          }
          else if($request->type == 'offer')
          {
              $Rating = OffersRating::where('user_id',$request->user_id)->where('offer_id',$request->offer_id)->first();
              if ($Rating)
              {
                 $Rating->update([ 'stars' => $request->stars ]);
              }
              else {
                OffersRating::created($request->all());
              }
          }

          return response()->json([
                'status' => 'success'
          ]);
    }




}
