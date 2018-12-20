<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    return 'done clear';
    // return what you want
});


Auth::routes();
//----login----
Route::get('/login', 'Auth\LoginController@admin_login_form')->name('login');
Route::post('/login', 'Auth\LoginController@admin_login');

Route::get('/home',function(){
    return redirect('Item');
});

Route::get('/', function(){
  return redirect('Site/Home');
});


//=============================================================================
//=============================Main Admin======================================
//=============================================================================

// Route::get('/', function () {
//     return redirect('login');
// });

Route::get('/setLang/{lang}', 'Auth\SettingController@change_lang');




Route::get('/DashBoard', 'Admin\DashBoardController@index');

Route::group(['prefix'=>'User','namespace'=>'Admin'],function(){
    Route::get('/', 'UserController@index');

    //----apis---
    Route::post('/User_list', 'UserController@User_list');
    Route::get('/delete/{id}', 'UserController@destroy');
});

Route::group(['prefix'=>'CountactUs','namespace'=>'Admin'],function(){
    Route::get('/', 'CountactUsController@index');

    //--api--
    Route::post('/list', 'CountactUsController@list');
    Route::get('/delete/{CountactUs_id}', 'CountactUsController@destroy');
});


Route::group(['prefix'=>'popularQuestions','namespace'=>'Admin'],function(){
    Route::resource('/', 'PopularQuestionsController');
    Route::post('/update', 'PopularQuestionsController@update');

    //--api--
    Route::post('/list', 'PopularQuestionsController@list');
    Route::get('/delete/{Car_id}', 'PopularQuestionsController@destroy');
    Route::get('/showORhide_api/{id}', 'PopularQuestionsController@showORhide');
});
//
// Route::group(['prefix'=>'Setting','namespace'=>'Admin'],function(){
//     Route::get('/', 'SettingController@index');
//     Route::post('/', 'SettingController@store');
// });
//
// Route::group(['prefix'=>'Chat'],function(){
//     Route::resource('/', 'ChatController');
//     Route::get('/get_chat_users', 'ChatController@get_chat_users');
//     Route::get('/get_latest_chat', 'ChatController@get_latest_chat');
//     Route::get('/get_chat/{user_id}', 'ChatController@get_chat');
// });
//
// Route::group(['prefix'=>'SendPushNotification'],function(){
//       Route::get('/', 'SendPushNotification@index');
//       Route::post('/', 'SendPushNotification@store');
// });


//-----------------from HEAR------------------------
Route::group(['prefix'=>'Category','namespace'=>'Admin'],function(){
      Route::get('/', 'CategoryController@index');

      //---apis---
      Route::post('/list', 'CategoryController@get_list');
      Route::get('/showORhide/{id}', 'CategoryController@showORhide');
      Route::get('/delete/{id}', 'CategoryController@destroy');
      Route::post('/create', 'CategoryController@store');
      Route::post('/update', 'CategoryController@update');
});

Route::group(['prefix'=>'Advertising','namespace'=>'Admin'],function(){
      Route::get('/', 'AdvertisingController@index');
      Route::post('/update', 'AdvertisingController@update');
});

Route::group(['prefix'=>'Slider','namespace'=>'Admin'],function(){
      Route::get('/', 'SliderController@index');
      Route::post('/update', 'SliderController@update');
      Route::get('/showORhide/{id}', 'SliderController@showORhide');
      Route::post('/create', 'SliderController@create');
      Route::get('/delete/{id}', 'SliderController@destroy');
});

Route::group(['prefix'=>'Membership','namespace'=>'Admin'],function(){
      Route::get('/', 'MembershipController@index');
      Route::post('/update', 'MembershipController@update');
});

Route::group(['prefix'=>'CompanyMembership','namespace'=>'Admin'],function(){
      Route::get('/', 'CompanyMembershipController@index');

      //---apis---
      Route::post('/list', 'CompanyMembershipController@get_list');
      Route::get('/switch_paid/{id}', 'CompanyMembershipController@switch_paid');
      Route::get('/switch_confirmed/{id}', 'CompanyMembershipController@switch_confirmed');
      Route::get('/delete/{id}', 'CompanyMembershipController@destroy');
});

Route::group(['prefix'=>'SubCategory','namespace'=>'Admin'],function(){
      Route::get('/', 'SubCategoryController@index');

      //---apis---
      Route::post('/list', 'SubCategoryController@get_list');
      Route::get('/showORhide/{id}', 'SubCategoryController@showORhide');
      Route::get('/delete/{id}', 'SubCategoryController@destroy');
      Route::post('/create', 'SubCategoryController@store');
      Route::post('/update', 'SubCategoryController@update');
});

Route::group(['prefix'=>'City','namespace'=>'Admin'],function(){
      Route::get('/', 'CityController@index');

      //---apis---
      Route::post('/list', 'CityController@get_list');
      Route::get('/showORhide/{id}', 'CityController@showORhide');
      Route::get('/delete/{id}', 'CityController@destroy');
      Route::post('/create', 'CityController@store');
      Route::post('/update', 'CityController@update');
});

Route::group(['prefix'=>'ContactUs','namespace'=>'Admin'],function(){
      Route::get('/', 'ContactUsController@index');

      //---apis---
      Route::post('/list', 'ContactUsController@get_list');
      Route::get('/delete/{id}', 'ContactUsController@destroy');
});

Route::group(['prefix'=>'Governorate','namespace'=>'Admin'],function(){
      Route::get('/', 'GovernorateController@index');

      //---apis---
      Route::post('/list', 'GovernorateController@get_list');
      Route::get('/showORhide/{id}', 'GovernorateController@showORhide');
      Route::get('/delete/{id}', 'GovernorateController@destroy');
      Route::post('/create', 'GovernorateController@store');
      Route::post('/update', 'GovernorateController@update');
});

Route::group(['prefix'=>'Company','namespace'=>'Admin'],function(){
      Route::get('/', 'CompanyController@index');

      //---apis---
      Route::post('/list', 'CompanyController@get_list');
      Route::get('/showORhide/{id}', 'CompanyController@showORhide');
      Route::get('/accaptedORunAccapted/{id}', 'CompanyController@accaptedORunAccapted');
      Route::get('/delete/{id}', 'CompanyController@destroy');
});

Route::group(['prefix'=>'Buyer','namespace'=>'Admin'],function(){
      Route::get('/', 'BuyerController@index');

      //---apis---
      Route::post('/list', 'BuyerController@get_list');
      Route::get('/showORhide/{id}', 'BuyerController@showORhide');
      Route::get('/accaptedORunAccapted/{id}', 'BuyerController@accaptedORunAccapted');
      Route::get('/delete/{id}', 'BuyerController@destroy');
});

Route::group(['prefix'=>'Recycable','namespace'=>'Admin'],function(){
      Route::get('/', 'RecycableController@index');

      //---apis---
      Route::post('/list', 'RecycableController@get_list');
      Route::get('/showORhide/{id}', 'RecycableController@showORhide');
      Route::get('/accaptedORunAccapted/{id}', 'RecycableController@accaptedORunAccapted');
      Route::get('/delete/{id}', 'RecycableController@destroy');
});

Route::group(['prefix'=>'ProducerFamily','namespace'=>'Admin'],function(){
      Route::get('/', 'ProducerFamilyController@index');

      //---apis---
      Route::post('/list', 'ProducerFamilyController@get_list');
      Route::get('/showORhide/{id}', 'ProducerFamilyController@showORhide');
      Route::get('/accaptedORunAccapted/{id}', 'ProducerFamilyController@accaptedORunAccapted');
      Route::get('/delete/{id}', 'ProducerFamilyController@destroy');
});

Route::group(['prefix'=>'Item','namespace'=>'Admin'],function(){
      Route::get('/', 'ItemController@index');

      //---apis---
      Route::post('/list', 'ItemController@get_list');
      Route::get('/showORhide/{id}', 'ItemController@showORhide');
      Route::get('/accaptance_by_admin/{id}', 'ItemController@accaptance_by_admin');
      Route::get('/delete/{id}', 'ItemController@destroy');
});

Route::group(['prefix'=>'Offer','namespace'=>'Admin'],function(){
      Route::get('/', 'OfferController@index');

      //---apis---
      Route::post('/list', 'OfferController@get_list');
      Route::get('/showORhide/{id}', 'OfferController@showORhide');
      Route::get('/accaptance_by_admin/{id}', 'OfferController@accaptance_by_admin');
      Route::get('/delete/{id}', 'OfferController@destroy');
});

Route::group(['prefix'=>'ProducerFamilyProduct','namespace'=>'Admin'],function(){
      Route::get('/', 'ProducerFamilyProductController@index');

      //---apis---
      Route::post('/list', 'ProducerFamilyProductController@get_list');
      Route::get('/showORhide/{id}', 'ProducerFamilyProductController@showORhide');
      Route::get('/delete/{id}', 'ProducerFamilyProductController@destroy');
});

Route::group(['prefix'=>'RecyclingCategory','namespace'=>'Admin'],function(){
      Route::get('/', 'RecyclingCategoryController@index');

      //---apis---
      Route::post('/list', 'RecyclingCategoryController@get_list');
      Route::get('/showORhide/{id}', 'RecyclingCategoryController@showORhide');
      Route::get('/delete/{id}', 'RecyclingCategoryController@destroy');
      Route::post('/create', 'RecyclingCategoryController@store');
      Route::post('/update', 'RecyclingCategoryController@update');
});

Route::group(['prefix'=>'RecycablesNews','namespace'=>'Admin'],function(){
      Route::get('/', 'RecycablesNewsController@index');

      //---apis---
      Route::post('/list', 'RecycablesNewsController@get_list');
      Route::get('/showORhide/{id}', 'RecycablesNewsController@showORhide');
      Route::get('/delete/{id}', 'RecycablesNewsController@destroy');
      Route::post('/create', 'RecycablesNewsController@store');
      Route::post('/update', 'RecycablesNewsController@update');
});

Route::group(['prefix'=>'RecycablesWhenfullRequests','namespace'=>'Admin'],function(){
      Route::get('/', 'RecycablesWhenfullRequestsController@index');

      //---apis---
      Route::post('/list', 'RecycablesWhenfullRequestsController@get_list');
      Route::get('/done_or_not/{id}', 'RecycablesWhenfullRequestsController@done_or_not');
      Route::get('/accaptedORunAccapted/{id}', 'RecycablesWhenfullRequestsController@accaptedORunAccapted');
      Route::get('/delete/{id}', 'RecycablesWhenfullRequestsController@destroy');
});

Route::group(['prefix'=>'AuctionRequest','namespace'=>'Admin'],function(){
      Route::get('/', 'AuctionRequestController@index');

      //---apis---
      Route::post('/list', 'AuctionRequestController@get_list');
      Route::get('/offers_list/{auction_id}', 'AuctionRequestController@offers_list');
      Route::get('/done_or_not/{id}', 'AuctionRequestController@done_or_not');
      Route::get('/unAccaptedAuction/{id}', 'AuctionRequestController@unAccaptedAuction');
      Route::post('/accaptAuction', 'AuctionRequestController@accaptAuction');
      Route::get('/delete/{id}', 'AuctionRequestController@destroy');
});

Route::group(['prefix'=>'Recipt','namespace'=>'Admin'],function(){
      Route::get('/', 'ReciptController@index');
      Route::get('/invoice/{id}', 'ReciptController@invoice');

      //---apis---
      Route::post('/list', 'ReciptController@get_list');
      Route::get('/items_list/{recipt_id}', 'ReciptController@items_list');
      Route::get('/done_or_not/{id}', 'ReciptController@done_or_not');
      Route::get('/accaptedORunAccapted/{id}', 'ReciptController@accaptedORunAccapted');
      Route::get('/delete/{id}', 'ReciptController@destroy');
});


//=================Role==========================
Route::group(['prefix'=>'Role','namespace'=>'Admin'],function(){
    Route::resource('/', 'RoleController');
    Route::get('/edit/{id}', 'RoleController@edit');
    Route::patch('/{id}', 'RoleController@update');
    Route::get('/search/{val}', 'RoleController@search');
});

Route::group(['prefix'=>'Admin','namespace'=>'Admin'],function(){
    Route::resource('/', 'AdminController');
    Route::get('/edit/{id}', 'AdminController@edit');
    Route::patch('/{id}', 'AdminController@update');
    Route::get('/search/{val}', 'AdminController@search');
    Route::get('/delete/{id}', 'AdminController@destroy');
});

Route::group(['prefix'=>'Chat','namespace'=>'Admin'],function(){

    //-------------------------Start get users--------------------------------
    Route::get('/get_chat_users_type_Buyer', 'ChatController@get_chat_users_type_Buyer');
    Route::get('/get_chat_users_type_Recycable', 'ChatController@get_chat_users_type_Recycable');
    Route::get('/get_chat_users_type_ProducerFamily', 'ChatController@get_chat_users_type_ProducerFamily');
    //-------------------------End get users--------------------------------
    Route::get('/get_latest_chat/{type}', 'ChatController@get_latest_chat');
    Route::get('/get_chat/{user_id}/{type}', 'ChatController@get_chat');

    Route::resource('/', 'ChatController');
    Route::get('/{type}', 'ChatController@index'); // index page
});

Route::group(['prefix'=>'Setting','namespace'=>'Admin'],function(){
    Route::get('/list', 'SettingController@list');
    Route::get('/', 'SettingController@index');
    Route::post('/save', 'SettingController@store');
});


//=================End Role==========================


//=============================EndMain Admin======================================
//=============================================================================
//=============================Company Admin======================================
//=============================================================================
Route::get('Company/login', 'Auth\LoginCompanyController@admin_login_form')->name('login');
Route::post('Company/login', 'Auth\LoginCompanyController@admin_login');
Route::get('Company/mark_notification_seen/{notification_id}', 'Auth\SettingController@mark_notification_seen');

Route::group(['prefix'=>'Company','namespace'=>'Company'],function(){



    Route::get('/DashBoard', 'DashBoardController@index');

    Route::group(['prefix'=>'Item' ],function(){
          Route::get('/', 'ItemController@index');

          //---apis---
          Route::post('/list', 'ItemController@get_list');
          Route::get('/showORhide/{id}', 'ItemController@showORhide');
          Route::get('/delete/{id}', 'ItemController@destroy');
          Route::post('/create', 'ItemController@store');
          Route::post('/edit', 'ItemController@update');
    });

    Route::group(['prefix'=>'Offer' ],function(){
          Route::get('/', 'OfferController@index');

          //---apis---
          Route::post('/list', 'OfferController@get_list');
          Route::get('/showORhide/{id}', 'OfferController@showORhide');
          Route::get('/delete/{id}', 'OfferController@destroy');
          Route::post('/create', 'OfferController@store');
          Route::post('/edit', 'OfferController@update');
    });

    Route::group(['prefix'=>'Recipt' ],function(){
          Route::get('/', 'ReciptController@index');
          Route::get('/invoice/{id}', 'ReciptController@invoice');

          //---apis---
          Route::post('/list', 'ReciptController@get_list');
          Route::get('/items_list/{recipt_id}', 'ReciptController@items_list');
          Route::get('/done_or_not/{id}', 'ReciptController@done_or_not');
          Route::get('/accaptedORunAccapted/{id}', 'ReciptController@accaptedORunAccapted');
          Route::get('/delete/{id}', 'ReciptController@destroy');
          Route::get('/make_paided/{id}', 'ReciptController@make_paided');
          Route::get('/make_delivered/{id}', 'ReciptController@make_delivered');
          Route::get('/make_cancled/{id}', 'ReciptController@make_cancled');
    });

    Route::group(['prefix'=>'AuctionRequest'],function(){
          Route::get('/', 'AuctionRequestController@index');

          //---apis---
          Route::post('/list', 'AuctionRequestController@get_list');
          Route::get('/offers_list/{auction_id}', 'AuctionRequestController@offers_list');
          Route::post('/add_offer', 'AuctionRequestController@add_offer');
          Route::get('/accapt_offer/{offer_id}', 'AuctionRequestController@accapt_offer');
          Route::post('/add_auction', 'AuctionRequestController@add_auction');
          Route::get('/payment/{auction_id}', 'AuctionRequestController@make_payment');
    });

    Route::group(['prefix'=>'MyAuctionRequest'],function(){
          Route::get('/', 'MyAuctionRequestController@index');
          Route::get('/payment/{id}', 'MyAuctionRequestController@payment');

          //---apis---
          Route::post('/list', 'MyAuctionRequestController@get_list');
          Route::get('/offers_list/{auction_id}', 'MyAuctionRequestController@offers_list');
          Route::post('/add_offer', 'MyAuctionRequestController@add_offer');
          Route::get('/accapt_offer/{offer_id}', 'MyAuctionRequestController@accapt_offer');
          Route::post('/add_auction', 'MyAuctionRequestController@add_auction');
    });

    Route::group(['prefix'=>'CompanyMembership'],function(){
          Route::get('/', 'CompanyMembershipController@index');
          Route::post('/assign_membership', 'CompanyMembershipController@assign_membership');
    });


});//End Company group


//=============================================================================
//=============================Site ======================================
//=============================================================================
Route::group(['prefix'=>'Site','namespace'=>'Site'],function(){

      Route::get('/', function(){
        return redirect('Site/Home');
      });

      Route::get('/logout', 'AuthController@logout');

      Route::group(['prefix'=>'login_register'],function(){
          Route::get('/', 'AuthController@index');
          Route::post('/register', 'AuthController@register');
          Route::post('/login ', 'AuthController@login');
          Route::post('/check_For_email', 'AuthController@check_For_email_uniqueness');
          Route::post('/check_For_phone', 'AuthController@check_For_phone_uniqueness');
      });

      Route::group(['prefix'=>'VerificationCode'],function(){
         Route::get('/{user_type}/{user_id}', 'AuthController@VerificationCode_index');
         Route::get('/resend_code/{user_type}/{user_id}', 'AuthController@resend_code');
         Route::post('/', 'AuthController@check_phone_activation_code');
      });

      Route::group(['prefix'=>'Category'],function(){
         Route::get('/{type}', 'CategoryController@index');
      });

      Route::group(['prefix'=>'ShoppingCart'],function(){
         Route::get('/', 'ShoppingCartController@index');
         Route::get('/get_list', 'ShoppingCartController@list');
         Route::get('/{buyer_id}/{item_id}/{type}', 'ShoppingCartController@add_or_remove');
      });

      Route::group(['prefix'=>'Recipt'],function(){
         Route::get('/list', 'ReciptController@index');
      });

      Route::group(['prefix'=>'Home'],function(){
         Route::get('/', 'HomeController@index');
         Route::get('/get_list', 'HomeController@get_list');
      });

      Route::group(['prefix'=>'RecycablesNews'],function(){
         Route::get('/', 'RecycablesNewsController@index');
         Route::get('/details/{id}', 'RecycablesNewsController@show');
         Route::post('/list', 'RecycablesNewsController@get_list');
      });

      Route::group(['prefix'=>'Action'],function(){
          Route::get('/index', 'ActionController@index');
          Route::post('/list', 'ActionController@get_list'); //api
          Route::get('/{id}', 'ActionController@show');

         Route::post('/get_comments_and_related_items', 'ActionController@get_comments_and_related_items');
         Route::post('/add_comment', 'ActionController@add_comment');
         Route::get('/like_add_or_remove/{type}/{id}', 'ActionController@like_add_or_remove');
      });

      Route::group(['prefix'=>'Wishlist'],function(){
           Route::get('/', 'WishlistController@index');
           Route::get('/list', 'WishlistController@get_list');
      });

      Route::group(['prefix'=>'Company'],function(){
           Route::get('/', 'CompanyController@index');
           Route::get('/details/{Company_id}', 'CompanyController@details');
           Route::post('/list', 'CompanyController@get_list');
      });

      Route::group(['prefix'=>'ProducerFamily'],function(){
           Route::get('/', 'ProducerFamilyController@index');
           Route::get('/details/{id}', 'ProducerFamilyController@details');
           Route::post('/list', 'ProducerFamilyController@get_list');
      });

      Route::group(['prefix'=>'ContactUs'],function(){
           Route::get('/', 'ContactUsController@index');
           Route::post('/', 'ContactUsController@store');
      });


      Route::group(['prefix'=>'Payment'],function(){
           Route::get('/Prepare_the_checkout', 'PaymentController@Prepare_the_checkout');
           Route::get('/makePayment/{deal_string}', 'PaymentController@hyperPayor_or_normail_makePayment');
          //  Route::get('/hyperPay/makePayment/{company_id}', function($company_id){
          //    dd($company_id);
          // });
      });

      Route::post('/item_list', 'ItemController@get_list');
      Route::post('/item_list_without_cat', 'ItemController@get_item_list_without_cat');
      Route::post('/offer_list', 'OfferController@get_list');
      Route::get('item/{category_id}', 'ItemController@index');     // items list page
      Route::get('item_without_category_selected', 'ItemController@list_without_category_selected');     // items list page
      Route::get('offer/{category_id}', 'OfferController@index');  // offer list page
      Route::get('item/details/{item_id}', 'ItemController@details');
      Route::get('offer/details/{offer_id}', 'OfferController@details');

      Route::get('about', 'PageController@about_us');




       // items list page
     // offers list page


});//End Site group
