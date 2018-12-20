<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Category;
use App\OffersImage;
use App\SubCategory;

class OfferController extends Controller
{
      public function __construct()
      {
         $this->middleware('auth:Company');
         // $this->middleware('lang');
      }

      public function index()
      {
          $lang = app()->getLocale()??'ar';
          $Category = Category::select('name_'.$lang.' as label','id as value')->get();
          foreach ($Category as $cat) {
             $cat->SubCategory = SubCategory::where('category_id',$cat->value)->select('name_'.$lang.' as label','id as value')->get();
          }
          return view('Company.Offer.index',compact('Category'));
      }

      //---api----
      public function get_list(Request $request)
      {
           $lang = app()->getLocale()??'ar';
           $search = $request->all();
           $Offers = Offer::select('offers.*','categories.name_'.$lang.' as category_name','sub_categories.name_'.$lang.' as sub_category_name',
                 \DB::raw("GROUP_CONCAT(CONCAT('".asset('images/offers')."/',offers_images.image)) as image")  )
           ->where( 'company_id',auth('Company')->id() )
           ->where(function($q)use($search){
                if (isset($search['text']))
                   $q->where('offers.name_en','like','%'.$search['text'].'%')
                     ->orWhere('offers.name_ar','like','%'.$search['text'].'%')->orWhere('offers.id',$search['text']);
                if (isset($search['company_id']))
                   $q->where('company_id',$search['company_id']);
                if (isset($search['category_id']))
                   $q->where('category_id',$search['category_id']);
            })
            ->Join('categories','categories.id','offers.category_id')
            ->leftJoin('sub_categories','sub_categories.id','offers.sub_category_id')
            ->Join('offers_images','offers_images.offer_id','offers.id')
            ->groupBy('offers.id')
            ->latest('id')->paginate();
            return $Offers;
      }

      //--api--
      public function showORhide($id)
      {
           $Offer = Offer::findOrFail($id);
           if( $Offer->status )
           {
              $Offer->update(['status' => '0']);
              $case = 0;
           }
           else
           {
              $Offer->update(['status' => '1']);
              $case = 1;
           }


           return response()->json([
               'status' => 'success',
               'case' => $case
           ]);
      }

      public function check_if_company_still_has_available_offers_to_add_this_month()
      {
          //-----limit the no.of offers---
          $membership_info = \App\Functions::company_membership_info();
          if( isset($membership_info->membership_id) ) //if have a current membership
          {
              $count_Offers = Offer::whereBetween('created_at',[$membership_info->from,$membership_info->to])
                                   ->where('company_id',auth('Company')->id())->count();
              if( $count_Offers >= $membership_info->no_add_offers ){
                  return  [
                      'status' => 'offers_ended',
                      'type' => 'membership',
                      'membership_type' => $membership_info->membership_name,
                      'membership_no_offer' => $membership_info->no_add_offers
                  ] ;
              }//End if
          }
          else //currently dont have a membership
          {
              $off = \App\Company::select(\DB::raw("DAY(created_at) as created_day"))->whereId( auth('Company')->id() )->first();
              $currentMonth = date("Y-m-".$off->created_day );
              $lastMonth = date("Y-m-".$off->created_day,strtotime("-1 month"));
              $membership_info = \App\Membership::find(1);//Normal  membership
              $count_Offers = Offer::whereBetween('created_at',[$lastMonth,$currentMonth])
                                   ->where('company_id',auth('Company')->id())->count();            
               if( $count_Offers >= $membership_info->no_add_offers ){
                   return [
                       'status' => 'offers_ended',
                       'type' => 'normail',
                       'membership_type' => $membership_info->membership_name,
                       'membership_no_offer' => $membership_info->no_add_offers
                   ] ;
               }//End if
          }
          return [
              'status' => 'true',
          ] ;
      }

      public function store(Request $request)
      {
          $check_for_offers_availability = $this->check_if_company_still_has_available_offers_to_add_this_month();
          if($check_for_offers_availability['status'] != 'true' )
          {
              return response()->json($check_for_offers_availability);
          }

            $validator = \Validator::make($request->all(), [
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'name_en' => 'required',
                'name_ar' => 'required',
                'description_en' => 'required',
                'description_ar' => 'required',
                'old_price' => 'required',
                'new_price' => 'required',
                'amount' => 'required',
                'image' => 'required',
            ]);
            if ($validator->fails()) { return response()->json([ 'status' => 'notValid' , 'data' => $validator->messages() ]);  }
            $request->merge([ 'company_id'=>auth('Company')->id() ]);
            $item = Offer::create($request->except('_token','image'));
            for ($i=0; $i < count($request->image); $i++)
            {
                $ItemImages = OffersImage::create([
                    'offer_id' => $item->id,
                    'image' => $request->image[$i]
                ]);
            }
            return response()->json([
                'status' => 'success',
                'data' => $item
            ]);
      }

      public function update(Request $request)
      {
            $check_for_offers_availability = $this->check_if_company_still_has_available_offers_to_add_this_month();
            if($check_for_offers_availability['status'] != 'true' )
            {
                return response()->json($check_for_offers_availability);
            }

            $validator = \Validator::make($request->all(), [
                'id' => 'required',
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'name_en' => 'required',
                'name_ar' => 'required',
                'description_en' => 'required',
                'description_ar' => 'required',
                'old_price' => 'required',
                'new_price' => 'required',
                'amount' => 'required',
                'image' => '',
            ]);
            if ($validator->fails()) { return response()->json([ 'status' => 'notValid' , 'data' => $validator->messages() ]);  }
            $request->merge([ 'company_id'=>auth('Company')->id() ]);
            $item = Offer::findOrFail($request->id);
            $item->update($request->except('_token','image'));

            if ( $request->image && $request->image != "[object FileList]")
            {
                OffersImage::where('offer_id',$item->id)->delete();
                for ($i=0; $i < count($request->image); $i++)
                {
                    $ItemImages = OffersImage::create([
                        'offer_id' => $item->id,
                        'image' => $request->image[$i]
                    ]);
                }
            }

            return response()->json([
                'status' => 'success',
                'data' => $item
            ]);
      }

      //--api--
      public function destroy($id)
      {
           try {
             $deleted = Offer::destroy($id);
           } catch (\Exception $e) {
             return 'false';
           }
           return 'true';
      }
}
