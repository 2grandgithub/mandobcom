<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProducerFamily;
use App\ProducerFamilyProduct;
use App\VerificationCode;

class ProducerFamilyController extends Controller
{
    public function __construct()
    {
       $this->middleware('verifyApiJWT:ProducerFamily,true')->only(['add_product']) ;
    }

    public function register(Request $request)
    {
          $validator = \Validator::make($request->all(), [
              'firebase_token' => 'required',
              'app_version' => 'required',
              'model' => 'required',
              'os' => 'required|in:android,ios',
              'email' => 'required|unique:producer_family',  // edit:  'email' => 'required|unique:buyers,email,'.$user_id,
              'password'  => 'required', // phone:send as -> md5( 'moi20'+password )
              'name' => 'required',
              'phone'  => 'required',
              // 'type'  => 'required|in:all,specific',
              // 'city_id'  => 'required',
              // 'governorate_id'  => 'required',
              'aramex_CountryCode' => 'required',
              'aramex_City' => 'required',
              'street'  => 'required',
              'building_no'  => '',
              'zip_code'  => '',
              'type' => '',
              'CommercialRegistrationNo' => '',
              'CommercialRegistrationType'  => '',
              'TypeOfCompanyActivity'  => 'required',
              'employees_no'  => 'required',
         ]);
         if ($validator->fails()) {
               if($validator->errors()->has('email'))
                    {  return response()->json([ 'status' => 'The email has already been taken.' ]);  }
              return response()->json([ 'status' => 'notValid' , 'data' => $validator->errors() ]);
         }

         $check_phone = ProducerFamily::where('phone',$request->phone)->where('phone_verified',1)->exists();
         if($check_phone){
            return response()->json([ 'status' => 'The phone has already been taken.'  ]);
         }

         if ($request->password)
              $request->merge([ 'password' => md5($request->password) ]);
         $request->merge([ 'jwt' => str_random(200) ]);

         $ProducerFamily = ProducerFamily::create( $request->all() );

         $VerificationCode = VerificationCode::create([
             'ProducerFamily_id' => $ProducerFamily->id,
             'code' => rand(1111,9999),
             'phone' => $ProducerFamily->phone
         ]);

         \App\SmsUnifonic::send($ProducerFamily->phone,"كود+التفعيل+الخاص+بحسابك+علي+مندوبكم+".$VerificationCode->code);

         \Mail::to($request->email)->send(new \App\Mail\RegisterMail('ProducerFamily',$ProducerFamily->id));

         return response()->json([
           'status' => 'success',
           'id' => $ProducerFamily->id
         ]);
    }


    public function list()
    {
        return ProducerFamily::select('producer_family.id','email','name','phone','street','building_no',
                    // 'zip_code','CommercialRegistrationNo','CommercialRegistrationType','TypeOfCompanyActivity','employees_no',
                    'cities.name_en as city_name_en','cities.name_ar as city_name_ar',
                    'governorates.name_en as governorate_name_en','governorates.name_ar as governorate_name_ar'
                    )
              ->leftJoin('cities','cities.id','producer_family.city_id')
              ->leftJoin('governorates','governorates.id','producer_family.governorate_id')
              ->where('phone_verified',1)->where('email_verified',1)->where('is_accapted_by_admin',1)
              ->latest('producer_family.id')
              ->groupBy('producer_family.id')
              ->simplePaginate();
    }


    public function add_product(Request $request)
    {
          $validator = \Validator::make($request->all(), [
              'ProducerFamily_id' => 'required',
              'name_ar' => 'required',
              'name_en' => 'required',
              'image' => 'required',
              'descraption_ar' => 'required',
              'descraption_en' => 'required',
              'price' => 'required',
              'price_unit' => 'required',
         ]);
         if ($validator->fails()) {
              return response()->json([ 'status' => 'notValid' , 'data' => $validator->errors() ]);
         }
         ProducerFamilyProduct::create($request->all());

         return response()->json([
           'status' => 'success'
         ]);
    }

    public function products_list(Request $request)
    {
        $search = $request->search;
        $producer_family_id = $request->producer_family_id;
        return ProducerFamilyProduct::select(
            'producer_family_products.name_en as product_name_en','producer_family_products.name_ar as product_name_ar',
            'image','descraption_ar','descraption_en' ,'price','price_unit',
            'producer_family.name as family_name','producer_family.phone as family_phone','producer_family.email as family_email',
            'cities.name_en as city_name_en','cities.name_ar as city_name_ar', 'producer_family.id as producer_family_id',
            'governorates.name_en as governorate_name_en','governorates.name_ar as governorate_name_ar'
            )
            ->leftJoin('producer_family',function($q){
                $q->on('producer_family.id','producer_family_products.ProducerFamily_id')->where('producer_family.status',1);
            })
            ->leftJoin('cities','cities.id','producer_family.city_id')
            ->leftJoin('governorates','governorates.id','producer_family.governorate_id')
            ->where('producer_family_products.status',1)
            ->where(function($q)use($search,$producer_family_id){
                if($producer_family_id){
                   $q->where('producer_family.id',$producer_family_id);
                }
                if($search)
                {
                    $q->where('producer_family_products.name_en','like','%'.$search.'%')
                      ->orWhere('producer_family_products.name_ar','like','%'.$search.'%')
                      ->orWhere('producer_family.name','like','%'.$search.'%');
                }
            })
            ->simplePaginate();
     }



}
