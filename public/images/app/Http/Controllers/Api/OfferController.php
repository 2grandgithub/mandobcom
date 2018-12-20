<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Category;
use App\CommentsOffer;
use App\OffersRating;
use App\OfferLike;

class OfferController extends Controller
{
    public function __construct()
    {
       $this->middleware('verifyApiJWT:Buyer,true,true')->except(['nothing']);
    }


     /*
     * @param order not_required
     * @param category_id not_required
     */
    public function index(Request $request)
    {
      //----------START validate user token if buyer_id ------------
        if ($request->buyer_id)
        {
            if( !$request->headers->has('userToken') )
              return response()->json([ 'status' => 'unValidToken' ]);
        }
        $buyer_id = $request->buyer_id??'0';
      //----------START validate user token if buyer_id ------------

        $category_id = $request->category_id;
        $sub_category_id = $request->sub_category_id;
        $name = $request->name??null;

        if( !in_array($request->order,[null,'price_high','price_low','views_high','views_low','rate_high','rate_low']) )
        {
               return response()->json([
                     'status' => "order must be in [null,'price_high','price_low','views_high','views_low','rate_high','rate_low'] or dont send it at all "
               ]);
        }

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
                $orderBy = 'offers.views';
                $orderT = 'DESC';
            break;
          case 'views_low':
                $orderBy = 'offers.views';
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
                $orderBy = 'new_price';
                $orderT = 'DESC';
            break;
          case 'price_low':
                $orderBy = 'new_price';
                $orderT = 'ASC';
            break;

          default:
                $orderBy = 'offers.id';
                $orderT = 'DESC';
            break;
        }

        $Offers = Offer::select('offers.id as id','offers.name_en','offers.name_ar','description_en','description_ar' ,
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
                    ->where('offers.accapted_by_admin',1)
                    ->where(function($query)use($category_id,$sub_category_id,$name){
                      if ($category_id)
                          $query->where('offers.category_id',$category_id);
                      if ($sub_category_id)
                          $query->where('offers.sub_category_id',$sub_category_id);
                      if($name)
                          $query->where('offers.name_ar','like','%'.$name.'%')->orWhere('offers.name_en','like','%'.$name.'%');
                    })
                    ->orderBy($orderBy,$orderT)
                    ->groupBy('offers.id')
                    ->paginate();
        return $Offers;
    }


    //
    // public function get_comments(Request $request)
    // {
    //       $data = \Validator::make($request->all(), [
    //            'buyer_id' => 'required',
    //            'offer_id' => 'required',
    //       ]);
    //       if ($data->fails()) {
    //              return response()->json([ 'state' => 'notValid' , 'data' => $data->messages() ]);
    //       }
    //       return  CommentsOffer::select('comment','buyers.name')
    //                         ->leftJoin('buyers','buyers.id','comments_offer.buyer_id')
    //                         ->where('offer_id',$request->offer_id)
    //                         ->latest('comments_offer.id')->groupBy('comments_offer.id')->get();
    // }
    //
    // public function like_add_or_remove($buyer_id,$offer_id)
    // {
    //       $Like = OfferLike::where('buyer_id',$buyer_id)->where('offer_id',$offer_id)->first();
    //       if ($Like)
    //       {
    //          $Like->delete();
    //       }
    //       else {
    //            OfferLike::create([
    //                'buyer_id' => $buyer_id,
    //                'offer_id'  => $offer_id
    //           ]);
    //       }
    //       return response()->json([
    //         'status' => 'success'
    //       ]);
    // }
    //
    // public function add_comment(Request $request)
    // {
    //     $data = \Validator::make($request->all(), [
    //          'user_id' => 'required',
    //          'offer_id' => 'required',
    //          'comment' => 'required',
    //     ]);
    //     if ($data->fails()) {
    //            return response()->json([ 'state' => 'notValid' , 'data' => $data->messages() ]);
    //     }
    //     CommentsOffer::created($request->all());
    //     return response()->json([
    //       'status' => 'success'
    //     ]);
    // }
    //
    // public function add_stars(Request $request)
    // {
    //       $data = \Validator::make($request->all(), [
    //            'user_id' => 'required',
    //            'offer_id' => 'required',
    //            'stars' => 'required',
    //       ]);
    //       if ($data->fails()) {
    //              return response()->json([ 'state' => 'notValid' , 'data' => $data->messages() ]);
    //       }
    //       $Rating = OffersRating::where('user_id',$request->user_id)->where('offer_id',$request->offer_id)->first();
    //       if ($Rating)
    //       {
    //          $Rating->update([ 'stars' => $request->stars ]);
    //       }
    //       else {
    //         OffersRating::created($request->all());
    //       }
    //
    //       return response()->json([
    //             'status' => 'success'
    //       ]);
    // }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
