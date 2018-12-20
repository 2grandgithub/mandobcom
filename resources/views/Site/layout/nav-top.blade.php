


  <!-- Top bar -->
  <div class="top-bar">
    <div class="container">
      <p> @lang('page.Mandobcom! With us towards the renaissance of the homeland') </p>
      <div class="right-sec">
        <ul>

          @if (auth('Buyer')->check() || auth('Company')->check() )
            <li>
                <a href="{{url('Site/logout')}}" class="btn btn-success btn-lg">
                      @lang('page.logOut')
                </a>
            </li>
          @else
            <li><a href="{{url('Site/login_register')}}" class="mydir"> <i class="fa fa-user"></i> @lang('page.Login/Register') </a></li>
          @endif
          {{-- <li><a href="#.">Store Location </a></li>
          <li><a href="#.">FAQ </a></li>
          <li><a href="#.">Newsletter </a></li> --}}
          <li>
            <select class="selectpicker" onchange="change_lang()" id="ddl_change">
              <option value="en" ><a href="{{url('setLang/en')}}" {{app()->getLocale()=='en'?'selected':''}}> @lang('page.English')  </a></option>
              <option value="ar" ><a href="{{url('setLang/ar')}}" {{app()->getLocale()=='ar'?'selected':''}}> @lang('page.Arabic')   </a></option>
            </select>
          </li>

          <script>
              document.getElementById('ddl_change').value = '{{$lang}}';
              function change_lang() {
                 window.location.replace( '{{url('setLang')}}/'+ $('#ddl_change').val() );
              }
          </script>



        </ul>
          <div class="social-top">
              <a href="{{$Setting_list['facebook']}}"><i class="fa fa-facebook"></i></a>
              <a href="{{$Setting_list['twitter']}}"><i class="fa fa-twitter"></i></a>
              <a href="{{$Setting_list['linkedin']}}"><i class="fa fa-linkedin"></i></a>
              <a href="{{$Setting_list['instagram']}}"><i class="fa fa-instagram"></i></a>
              {{-- <a href="#."><i class="fa fa-pinterest"></i></a> --}}
          </div>
      </div>
    </div>
  </div>

  <!-- Header -->
  <header>
    <div class="container">
      <div class="logo">
         <a href="{{url('Site/Home')}}">
            @php( $lang = app()->getLocale()??'ar' )
            @if ($lang == 'ar')
               <img src="{{asset('site_assets/images/logo2.png')}}" alt="" >
            @else
               <img src="{{asset('site_assets/images/logo.png')}}" alt="" >
            @endif
         </a>
      </div>
      @php($page_name = $page_name??'')
      @if($page_name == 'items_list' || $page_name == 'offer_list')
          <div class="search-cate">
              <select class="selectpicker" id="main_app_search_categoiry">
                    <option> @lang('page.choose categoiry') </option>
                    @foreach ($Categories_and_subCategories_list as $Cat)
                          <option value="{{url('Site/'.$Cat->value)}}"> {{$Cat->label}} </option>
                    @endforeach
              </select>
              <input type="search" placeholder="@lang('page.search')" id="main_search_bar" >
              <button class="submit" type="submit"><i class="icon-magnifier"></i></button>
          </div>
      @else
        <div class="search-cate" id="main_app_search">
         {!! Form::open([ 'id'=>'main_app_search_form' ]) !!}
              <select class="selectpicker" id="main_app_search_categoiry" name="fff">
                    <option value=""> @lang('page.all') </option>
                      @foreach ($Categories_and_subCategories_list as $Cat)
                            <option value="{{$Cat->value}}"> {{$Cat->label}} </option>
                      @endforeach
              </select>
              <input type="search" placeholder="@lang('page.search in mandobcom')" id="main_search_barr"  >
              <button class="submit" type="submit"><i class="icon-magnifier"></i></button>
          {!! form::close() !!}
        </div>
      @endif

      <!-- Cart Part -->
      @if (auth('Buyer')->check())
          <ul class="nav navbar-right cart-pop">
            <li class="dropdown">
              {{-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="itm-cont">3</span> <i class="flaticon-shopping-bag"></i> <strong>My Cart</strong> <br> --}}
              <a href="{{url('Site/ShoppingCart')}}"  >
                {{-- <span class="itm-cont">3</span>  --}}
                <i class="flaticon-shopping-bag"></i> <strong> @lang('page.My Cart')  </strong> <br>
                {{-- <span>3 item(s) - $500.00</span> --}}
              </a>
              {{-- <ul class="dropdown-menu">
                <li>
                  <div class="media-left"> <a href="#." class="thumb"> <img src="{{asset('site_assets/images/item-img-1-1.jpg')}}" class="img-responsive" alt="" > </a> </div>
                  <div class="media-body"> <a href="#." class="tittle">Funda Para Ebook 7" 128GB full HD</a> <span>250 x 1</span> </div>
                </li>
                <li>
                  <div class="media-left"> <a href="#." class="thumb"> <img src="{{asset('site_assets/images/item-img-1-2.jpg')}}" class="img-responsive" alt="" > </a> </div>
                  <div class="media-body"> <a href="#." class="tittle">Funda Para Ebook 7" full HD</a> <span>250 x 1</span> </div>
                </li>
                <li class="btn-cart"> <a href="#." class="btn-round">View Cart</a> </li>
              </ul> --}}
            </li>
          </ul>
    @endif

    </div>

    <!-- Nav -->
    <nav class="navbar ownmenu">
      <div class="container">



        <!-- Categories -->
        <div class="cate-lst"> <a  data-toggle="collapse" class="cate-style" href="#cater"><i class="fa fa-list-ul"></i> @lang('page.items Categories') </a>
          <div class="cate-bar-in">
            <div id="cater" class="collapse">
              <ul>
                    <li>    <a href="{{url('Site/Category/item')}}">  @lang('page.all') </a>  </li>
                  @foreach ($Categories_and_subCategories_list as $Cat)
                    <li>      <!-- class="sub-menu" -->
                      <a href="{{url('Site/item/'.$Cat->value)}}"> {{$Cat->label}}</a>
                    </li>
                  @endforeach
                </ul>
            </div>
          </div>
        </div>

        <!-- Navbar Header -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-open-btn" aria-expanded="false"> <span><i class="fa fa-navicon"></i></span> </button>
        </div>
        <!-- NAV -->
        <div class="collapse navbar-collapse" id="nav-open-btn">
          <ul class="nav">
            <li class=" megamenu "> <a href="{{url('Site/Home')}}" > @lang('page.Home') </a>
              <div class="dropdown-menu animated-2s fadeInUpHalf">
                <div class="mega-inside scrn">

                </div>
              </div>
            </li>
             <li class=" megamenu {{($page_name=='item_list')?'active':''}} "> <a href="{{url('Site/item_without_category_selected')}}" > @lang('page.Items') </a>
              <div class="dropdown-menu animated-2s fadeInUpHalf">
                <div class="mega-inside scrn">

                </div>
              </div>
            </li>
             <li class=" megamenu {{($page_name=='offer_list')?'active':''}} "> <a href="{{url('Site/Category/offer')}}" > @lang('page.Offers') </a>
              <div class="dropdown-menu animated-2s fadeInUpHalf">
                <div class="mega-inside scrn">

                </div>
              </div>
            </li>
            <!-- Mega Menu Nav -->
            {{-- <li class="dropdown megamenu"> <a href="{{url('Site/Home')}}" class="dropdown-toggle" data-toggle="dropdown">Mega menu </a>
              <div class="dropdown-menu animated-2s fadeInUpHalf">
                <div class="mega-inside">
                  <div class="top-lins">
                    <ul>
                      <li><a href="#."> Cell Phones & Accessories </a></li>
                      <li><a href="#."> Carrier Phones </a></li>
                      <li><a href="#."> Unlocked Phones </a></li>
                      <li><a href="#."> Prime Exclusive Phones </a></li>
                      <li><a href="#."> Accessories </a></li>
                      <li><a href="#."> Cases </a></li>
                      <li><a href="#."> Best Sellers </a></li>
                      <li><a href="#."> Deals </a></li>
                      <li><a href="#."> All Electronics </a></li>
                    </ul>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6>Electronics</h6>
                      <ul>
                        <li><a href="#."> Cell Phones & Accessories </a></li>
                        <li><a href="#."> Carrier Phones </a></li>
                        <li><a href="#."> Unlocked Phones </a></li>
                        <li><a href="#."> Prime Exclusive Phones </a></li>
                        <li><a href="#."> Accessories </a></li>
                        <li><a href="#."> Cases </a></li>
                        <li><a href="#."> Best Sellers </a></li>
                        <li><a href="#."> Deals </a></li>
                        <li><a href="#."> All Electronics </a></li>
                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>Computers</h6>
                      <ul>
                        <li><a href="#."> Computers & Tablets</a></li>
                        <li><a href="#."> Monitors</a></li>
                        <li><a href="#."> Laptops & tablets</a></li>
                        <li><a href="#."> Networking</a></li>
                        <li><a href="#."> Drives & Storage</a></li>
                        <li><a href="#."> Computer Parts & Components</a></li>
                        <li><a href="#."> Printers & Ink</a></li>
                        <li><a href="#."> Office & School Supplies </a></li>
                      </ul>
                    </div>
                    <div class="col-sm-2">
                      <h6>Home Appliances</h6>
                      <ul>
                        <li><a href="#."> Refrigerators</a></li>
                        <li><a href="#."> Wall Ovens</a></li>
                        <li><a href="#."> Cooktops & Hoods</a></li>
                        <li><a href="#."> Microwaves</a></li>
                        <li><a href="#."> Dishwashers</a></li>
                        <li><a href="#."> Washers</a></li>
                      </ul>
                    </div>
                    <div class="col-sm-4"> <img class=" nav-img" src="{{asset('site_assets/images/navi-img.png')}}" alt="" > </div>
                  </div>
                </div>
              </div>
            </li> --}}
{{--
            <li class="dropdown"> <a href="blog.html" class="dropdown-toggle" data-toggle="dropdown">@lang('page.Recycling')</a>
              <ul class="dropdown-menu multi-level animated-2s fadeInUpHalf">
                <li><a href="requst.html"> @lang('page.Request to be recycble') </a></li>
                <li><a href="request to be recycle.html"> @lang('page.Recycling') </a></li>
              </ul>
            </li> --}}
            <li> <a href="{{url('Site/Company')}}">@lang('page.companies')</a></li>
            @if (auth('Buyer')->check())
              <li> <a href="{{url('Site/Recipt/list')}}"> @lang('page.My orders') </a></li>
              <li> <a href="{{url('Site/Wishlist')}}">@lang('page.Wish list') </a></li>
            @endif
            <li> <a href="{{url('Site/ContactUs')}}"> @lang('page.Contact us') </a></li>
            <li> <a href="{{url('Site/about')}}"> @lang('page.About us')</a></li>
          </ul>
        </div>

        <!-- NAV RIGHT -->

      </div>
    </nav>
  </header>
