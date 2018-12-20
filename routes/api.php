<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('privacy_policy_Ilink', function(){
  return view('privacy_policy_Ilink');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('verifyEmail/{type}/{user_id}', 'Api\UserController@verifyEmail');


//-------START User functions-----------
Route::post('login', 'Api\UserController@login');
Route::post('check_activation_code', 'Api\UserController@check_phone_activation_code');
Route::post('update_firebase_Token', 'Api\UserController@update_firebase_Token');
Route::post('change_password', 'Api\UserController@change_password');
Route::post('forget_password', 'Api\UserController@forget_password');
Route::post('show_profile', 'Api\UserController@show_profile');
Route::get('reSend_phone_Code/{user_id}/{type}', 'Api\UserController@reSend_phone_Code');
//-------END User functions------------

Route::get('home_page/{buyer_id}', 'Api\MainController@main_list');

Route::group(['prefix'=>'Buyer','namespace'=>'Api'],function(){
    Route::post('/register', 'BuyerController@register');
});

Route::group(['prefix'=>'Recycable','namespace'=>'Api'],function(){
    Route::post('/register', 'RecycableController@register');
    Route::get('news/list', 'RecycablesNewsController@list');
    Route::post('Requests_when_packge_is_fulled','RecycableController@Requests_when_packge_is_fulled')->middleware('verifyApiJWT:Recycable');
});

// Route::group(['prefix'=>'RecycablesNews','namespace'=>'Api'],function(){
//     Route::get('/list', 'RecycablesNewsController@list');
// });

Route::group(['prefix'=>'Category'],function(){
    Route::get('/list', 'Api\CategoryController@index');
    Route::get('/list_with_sub_category', 'Api\CategoryController@list_with_sub_category');
    Route::post('/search_by_name', 'Api\CategoryController@search_by_name');
});

Route::group(['prefix'=>'Company'],function(){
    Route::get('/list', 'Api\CompanyController@index');
    Route::post('/search_by_name', 'Api\CompanyController@search_by_name');
    Route::get('/company_from_categoiry_id/{categoiry_id}', 'Api\CompanyController@company_from_categoiry_id');
});

Route::group(['prefix'=>'ProducerFamily','namespace'=>'Api'],function(){
    Route::post('/register', 'ProducerFamilyController@register');
    Route::get('/list', 'ProducerFamilyController@list');
    Route::post('/add_product', 'ProducerFamilyController@add_product');
    Route::post('/products_list', 'ProducerFamilyController@products_list');
});

//--Item have a middelware verifyApiAuth
Route::group(['prefix'=>'Item'],function(){
    Route::get('/categoires/{company_id}', 'Api\ItemController@categoires');
    Route::post('/list', 'Api\ItemController@list');
    Route::get('/categories_of_company/{company_id}', 'Api\ItemController@categories_of_company');
    Route::get('/subCategories_of_company/{company_id}', 'Api\ItemController@subCategories_of_company');
    Route::get('/like_add_or_remove/{type}/{buyer_id}/{item_id}', 'Api\ItemController@like_add_or_remove');
    Route::post('/get_comments', 'Api\ItemController@get_comments');
    Route::post('/add_comment', 'Api\ItemController@add_comment');
    Route::post('/add_stars', 'Api\ItemController@add_stars');
});

Route::group(['prefix'=>'Offer'],function(){
    Route::get('/categoires', 'Api\OfferController@offers_categoires');
    Route::post('/list', 'Api\OfferController@index');
    Route::get('/like_add_or_remove/{buyer_id}/{offer_id}', 'Api\OfferController@like_add_or_remove');
    Route::post('/add_comment', 'Api\OfferController@add_comment');
    Route::post('/get_comments', 'Api\OfferController@get_comments');
    Route::post('/add_stars', 'Api\OfferController@add_stars');
});

Route::group(['prefix'=>'List'],function(){
    Route::get('/Country_list', 'Api\ListController@Country_list');
    Route::get('/City_list/{code}', 'Api\ListController@City_list');
    Route::get('/City_list_array/{code}', 'Api\ListController@City_list_array');
});

//--Address have a middelware verifyApiAuth
Route::group(['prefix'=>'Favourite'],function(){
    Route::get('/list/{buyer_id}', 'Api\FavouriteController@list');
    Route::get('/add_or_remove/{buyer_id}/{item_id}', 'Api\FavouriteController@store');
});

//--  have a middelware verifyApiAuth
Route::group(['prefix'=>'ShoppingCart'],function(){
    Route::get('/list/{buyer_id}', 'Api\ShoppingCartController@list');
    Route::get('/add_or_remove/{buyer_id}/{item_id}/{type}', 'Api\ShoppingCartController@add_or_remove');
});

//--  have a middelware verifyApiAuth
Route::group(['prefix'=>'Recipt'],function(){
    Route::post('/add_recipt', 'Api\ReciptController@add_recipt');
    Route::get('/recipt_list/{buyer_id}', 'Api\ReciptController@recipt_list');
    Route::get('/hyperPay_Prepare_the_checkout/{price}', 'Api\ReciptController@hyperPay_Prepare_the_checkout');
});

//--Address have a middelware verifyApiAuth
Route::group(['prefix'=>'Address'],function(){
    Route::get('/info/{buyer_id}', 'Api\AddressController@info') ;
    Route::post('/', 'Api\AddressController@store') ;
});

Route::group(['prefix'=>'Setting'],function(){
    Route::get('/advertising_for_recycables_whenfull_requests', 'Api\SettingController@advertising_for_recycables_whenfull_requests');
    Route::get('/advertising_for_add_producer_family_product', 'Api\SettingController@advertising_for_add_producer_family_product');
    Route::get('/about', 'Api\SettingController@about');
    Route::get('/about_us', 'Api\SettingController@about_us');
    Route::get('/termis_and_condations', 'Api\SettingController@termis_and_condations');
    Route::post('/increment_views', 'Api\SettingController@increment_views')->middleware('verifyApiJWT:Buyer,true');
});

Route::group(['prefix'=>'Favourite'],function(){
    Route::get('/{user_id}', 'Api\FavouriteController@list');
    Route::get('add_or_remove/{user_id}/{car_id}', 'Api\FavouriteController@add_or_remove');
});


Route::group(['prefix'=>'Chat'],function(){
    Route::post('/', 'Api\ChatController@store');
    // Route::get('/', 'Api\ChatController@list');
    Route::get('list/{user_id}/{type}', 'Api\ChatController@list');
});

Route::group(['prefix'=>'Recycable'],function(){
    Route::post('/request_to_be_recycable', 'Api\RecycableController@request');
    Route::get('/categoires_list', 'Api\RecyclingItemController@categoires_list');
    Route::get('/list', 'Api\RecyclingItemController@list');
});

Route::group(['prefix'=>'AuctionRequest'],function(){
    Route::post('/list', 'Api\AuctionRequestController@list');
    Route::get('/offers/{AuctionRequest_id}', 'Api\AuctionRequestController@offers_list');
    Route::post('/accapt_offer', 'Api\AuctionRequestController@accapt_offer');
    Route::post('/add', 'Api\AuctionRequestController@store');
    Route::post('/pay_for_offer', 'Api\AuctionRequestController@pay_for_offer');
});

Route::patch('/ContactUs/{user_id}', 'Api\ContactUsController@store');
Route::get('/PopularQuestion/list', 'Api\PopularQuestionController@list');

 Route::get('/privacy_policy', function(){
     return view('privacy_policy');
});

Route::post('/test_header', 'Api\UserController@test_header')->middleware('verifyApiAuth');


Route::post('/osama_firebase', 'SendPushNotification@osama_firebase');



///----------------------------------------------------------------------
///-----------------------------------Aramex-----------------------------------
///----------------------------------------------------------------------

Route::group(['prefix'=>'Aramex'],function(){
    Route::get('/Cities_from_country/{CountryCode}', 'Api\AramexController@LocationCitiesFetching');
    Route::post('/CalculateRate', 'Api\AramexController@CalculateRate');
    Route::get('/CreateShipments', 'Api\AramexController@CreateShipments');
});
