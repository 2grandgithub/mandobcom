@php ( app()->setLocale(\Session::get('lang') ??'ar' ) )
<!doctype html>
<html class="no-js" lang="en">


<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="M_Adnan" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Document Title -->
<title>Mandobcom</title>
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<!-- Favicon -->
<link rel="shortcut icon" href="{{asset('site_assets/images/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{asset('site_assets/images/favicon.ico')}}" type="image/x-icon">

<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="{{asset('site_assets/rs-plugin/css/settings.css')}}" media="screen" />

<!-- StyleSheets -->
<link rel="stylesheet" href="{{asset('site_assets/css/ionicons.min.css')}}">

<link rel="stylesheet" href="{{asset('site_assets/css/font-awesome.min.css')}}">
@php( $lang = \App::getLocale()??'ar' )
@if ( $lang == 'en')
  <link rel="stylesheet" href="{{asset('site_assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('site_assets/css/main.css')}}">
  <link rel="stylesheet" href="{{asset('site_assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('site_assets/css/responsive.css')}}">
@else
  <link rel="stylesheet" href="{{asset('site_assets/css/bootstrap.min2.css')}}">
  <link rel="stylesheet" href="{{asset('site_assets/css/main2.css')}}">
  <link rel="stylesheet" href="{{asset('site_assets/css/style2.css')}}">
  <link rel="stylesheet" href="{{asset('site_assets/css/responsive2.css')}}">
@endif

{{-- <script type="text/javascript" src="{{asset('select2/js/select2.min.js')}}"></script> --}}


<link rel="stylesheet" href="{{asset('css/site_custom_style.css')}}">

<!-- Fonts Online -->
<link href="https://fonts.googleapis.com/css?family=Lato:100i,300,400,700,900" rel="stylesheet">

<!-- JavaScripts -->
<script src="{{asset('site_assets/js/vendors/modernizr.js')}}"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<style media="screen">



</style>
<!-- START PAGE CONTAINER -->
@if ( \App::getLocale() == 'ar' )
    <style>
      .mydir{ float: right; direction: rtl;}
      .mydirection{ direction: rtl;}
      .pull-atherWay{ float: left; }
      .pull-sameWay{ float: right; }

      h3#footerH3{ direction: rtl; }
    </style>
@else
    <style>
      .mydir{ float: left; direction: ltr; }
      .mydirection{ direction: ltr; }
      .pull-atherWay{ float: right; }
      .pull-sameWay{ float: left; }
    </style>
@endif

</head>
<body>

<!-- Page Wrapper -->
<div id="wrap">
  @php($Categories_and_subCategories_list = \App\Http\Controllers\Controller::STA_cates_and_subCats() )
  @php($Setting_list =  \App\Http\Controllers\Controller::STA_Setting() ) <!-- array-->

  @include('Site.layout.nav-top',['Setting_list' => $Setting_list ])


  <!-- Content -->
  <div id="content"  >

      <style>   [v-cloak] { display: none; }   </style>

    <div id="root"  v-cloak>

      {{-- <!-- - - - - - -START spinner- - - - - - - -->
      <spinner1 v-if="show_spinner"></spinner1>
      <!-- - - - - - -End spinner- - - - - - - --> --}}

        @yield('content')

    </div>
  </div><!-- End Content -->


  <!-- Footer -->
  <footer>
    @include('Site.layout.footer',['Setting_list' => $Setting_list, 'Categories' => $Categories_and_subCategories_list ])
  </footer>

  <!-- Rights -->
  <div class="rights">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          @if ($lang == 'en')
              <p>Copyright © 2018 <a href="http://2grand.net/" class="ri-li"> <img src="{{asset('site_assets/images/grand.png')}}"> </a> </p>
          @else
            <p> <a href="http://2grand.net/" class="ri-li"> <img src="{{asset('site_assets/images/grand.png')}}"> </a> جميع الحقوق محفوظه لشركه الفريد للتسويق الألكتروني تصميم وتنفيذ شركه جراند </p>
          @endif

        </div>
        {{-- <div class="col-sm-6 text-right"> <img src="{{asset('site_assets/images/card-icon.png')}}" alt=""> </div> --}}
      </div>
    </div>
  </div>

  <!-- End Footer -->

  <!-- GO TO TOP  -->
  <a href="#" class="cd-top"><i class="fa fa-angle-up"></i></a>
  <!-- GO TO TOP End -->
</div>
<!-- End Page Wrapper -->

<!-- JavaScripts -->
<script src="{{asset('site_assets/js/vendors/jquery/jquery.min.js')}}"></script>
<script src="{{asset('site_assets/js/vendors/wow.min.js')}}"></script>
<script src="{{asset('site_assets/js/vendors/bootstrap.min.js')}}"></script>
<script src="{{asset('site_assets/js/vendors/own-menu.js')}}"></script>
<script src="{{asset('site_assets/js/vendors/jquery.sticky.js')}}"></script>
<script src="{{asset('site_assets/js/vendors/owl.carousel.min.js')}}"></script>

<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="{{asset('site_assets/rs-plugin/js/jquery.tp.t.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site_assets/rs-plugin/js/jquery.tp.min.js')}}"></script>
<script src="{{asset('site_assets/js/main.js')}}"></script>
<script src="{{asset('site_assets/js/vendors/jquery.nouislider.min.js')}}"></script>

<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
<!-- END TEMPLATE -->
<script type="text/javascript" src="{{asset('js/jquery.validate.js')}}"></script>
  {{-- <script type="text/javascript" src="{{asset('select2/js/select2.min.js')}}"></script> --}}
<script>
// jQuery(document).ready(function($) {
//
// });

  //---------------------------------Start for main search bar-----------------------------
    $('#main_app_search_form').submit(function(event) {
       event.preventDefault();
       if( $('#main_app_search_categoiry').val() == '' )
       {
          let search_url = base_url+'/item_without_category_selected/'+ $('#main_app_search_categoiry').val() + '?search='+ $('#main_search_barr').val() ;
           window.location.replace(search_url);
       }
       else {
          let search_url = base_url+'/item/'+ $('#main_app_search_categoiry').val() + '?search='+ $('#main_search_barr').val() ;
           window.location.replace(search_url);
       }

    });
//---------------------------------End for main search bar---------------------------------

  let lang = '{{$lang}}';
  let base_url = '{{url('Site')}}';
  let base_apis_url = '{{url('api')}}';
  let csrf_token = '{{csrf_token()}}';
  let get_AuthBuyer_id = '{{( auth('Buyer')->check() )? auth('Buyer')->id() :  0 }}'; // 0 if not login log
  let get_jwt = '{{( auth('Buyer')->check() )? auth('Buyer')->user()->jwt :  0}}';
  let Categories_and_subCategories_list = JSON.parse(`{!!$Categories_and_subCategories_list!!}`);  
</script>

@yield('script')
</body>


</html>
