@extends('Site.layout.blank')


@section('content')

<section id="home_list">



    <!-- Slid Sec -->
    <section class="slid-sec">
      <div class="container">
        <div class="container-fluid">

          <div class="row">

            <!-- Main Slider  -->
            <div class="col-md-9 no-padding">
              @if (Session::has('flash_message') )
                    <div class="alert alert-info mydirection">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <div class="mydirection">
                            <i class="fa fa-thumbs-o-up white font-medium-5 mt-1"></i>
                            {{Session::get('flash_message')}}
                        </div>
                     </div>
              @endif
              <!-- Main Slider Start -->
              <div class="tp-banner-container">
                <div class="tp-banner">
                  <ul>
                    @foreach ($data['Sliders'] as $Slider)
                      <!-- SLIDE  -->
                      <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" >
                        <!-- MAIN IMAGE -->
                        <img src="{{$Slider->image}}"  alt="slider"  data-bgposition="center bottom" data-bgfit="cover" data-bgrepeat="no-repeat">

                        <!-- LAYER NR. 2 -->
                        {{-- <div class="tp-caption sfr tp-resizeme"  data-x="left" data-hoffset="60" data-y="center" data-voffset="-60"
                                         data-speed="800" data-start="1000" data-easing="Power3.easeInOut" data-splitin="chars"
                                         data-splitout="none" data-elementdelay="0.03" data-endelementdelay="0.1" data-endspeed="300"
                                         style="z-index: 6; font-size:50px; color:#5d8e3c; font-weight:800; white-space: nowrap;">
                                        {{$Slider->name}}
                        </div> --}}

                        <!-- LAYER NR. 4 -->
                        <div class="tp-caption lfb tp-resizeme scroll" data-x="left" data-hoffset="60" data-y="center" data-voffset="80" data-speed="800"
                                         data-start="1300" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1"
                                         data-endspeed="300" data-scrolloffset="0"
                                         style="z-index: 8;">
                            <a href="{{$Slider->link}}" class="btn-round big" target="_blank">Shop Now</a>
                        </div>
                      </li>
                    @endforeach

                  </ul>
                </div>
              </div>
            </div><!--End col-md-9 no-padding-->

            <!-- Main Slider  -->
            <div class="col-md-3 no-padding">

              <!-- New line required  -->
              <div class="product">
                <div class="like-bnr" style="background: #f5f5f5 url({{asset('images/ads/'.$Setting['main_page_image1_beside_slider'])}}) left top no-repeat;" >
                  <div class="position-center-center">
                    {{-- <h5>New line required</h5>
                    <h4>Smartphone s7</h4>
                    <span class="price">$259.99</span> </div> --}}
                </div>
              </div>

              <!-- Weekly Slaes  -->
              <div class="week-sale-bnr" style="background: url({{asset('images/ads/'.$Setting['main_page_image2_beside_slider'])}}) center center no-repeat" >
                {{-- <h4>Weekly <span>Sale!</span></h4>
                <p>Saving up to 50% off all online
                  store items this week.</p>
                <a href="#." class="btn-round">Shop now</a> </div> --}}
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Content -->
    <div id="content">



      <section class="featur-tabs padding-top-60 padding-bottom-60">
        <div class="container">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-pills margin-bottom-40" role="tablist">
            <li role="presentation" class="active"><a href="{{url('Site/item_without_category_selected')}}" style="cursor:pointer"> @lang('page.company items') </a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Featured -->
            <div role="tabpanel" class="tab-pane active fade in" id="featur">
              <!-- Items Slider -->
              <div class="item-slide-5 with-nav">
                @foreach ($data['items'] as $item)
                  <div class="product" > <!--  v-for="list in mainList.items"-->
                    <article >



                        <img class="img-responsive" src="{{$item->image}}" style="width:184px;height:184px;cursor:pointer" onclick="window.location.replace('{{url('Site/item/details/'.$item->item_id)}}')" >
                        <!--<span class="sale-tag">-25%</span> -->
                        @if ($item->is_new)
                           <span class="new-tag" >   @lang('page.new') </span>
                        @endif
                        <!-- Content -->
                        <span class="tag">{{$item->category_name}}</span>
                              <a href="{{url('Site/item/details/'.$item->item_id)}}" class="tittle"> {{$item->item_name}} </a>
                        <!-- Reviews -->
                        <p class="rev">
                          @for ($i=0;$i<$item->stars;$i++)      <i class="fa fa-star"></i>    @endfor
                          @for ($i=0;$i<(5-$item->stars);$i++)  <i class="fa fa-star-o"></i>  @endfor
                          <span class="margin-left-10"> {{$item->views}} @lang('page.view(s)') </span>
                        </p>

                        <div class="price"> {{$item->price}}   </div>
                        <a class="cart-btn {{($item->in_card)?'inCard':''}}" data-key="card_item_{{$item->item_id}}" v-on:click="add_ShoppingCard('{{$item->item_id}}','item','card_item_{{$item->item_id}}')">
                          <i class="icon-basket-loaded"></i>
                        </a>
                    </article>
                  </div>
                @endforeach
              </div><!--End item-slide-5 with-nav-->
            </div>
            <br>


          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-pills margin-bottom-40" role="tablist">
            <li role="presentation" class="active"><a href="{{url('Site/Category/offer')}}" style="cursor:pointer"> @lang('page.company Offers') </a></li>

          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Featured -->
            <div role="tabpanel" class="tab-pane active fade in" id="featur">
              <!-- Items Slider -->
              <div class="item-slide-5 with-nav">
                @foreach ($data['offers'] as $item)
                  <div class="product" > <!--  v-for="list in mainList.items"-->
                    <article>
                      <img class="img-responsive" src="{{$item->image}}" style="width:184px;height:184px;cursor:pointer" onclick="window.location.replace('{{url('Site/offer/details/'.$item->offer_id)}}')" >
                      <!--<span class="sale-tag">-25%</span> -->
                      @if ($item->is_new)
                        <span class="new-tag" >  @lang('page.new') </span>
                      @endif
                      <!-- Content -->
                      <span class="tag">{{$item->category_name}}</span>
                            <a href="{{url('Site/offer/details/'.$item->offer_id)}}" class="tittle"> {{$item->offer_name}} </a>
                      <!-- Reviews -->
                      <p class="rev">
                          @for ($i=0;$i<$item->stars;$i++)      <i class="fa fa-star"></i>    @endfor
                          @for ($i=0;$i<(5-$item->stars);$i++)  <i class="fa fa-star-o"></i>  @endfor
                        <span class="margin-left-10"> {{$item->views}} @lang('page.view(s)') </span>
                      </p>

                      <div class="price"> {{$item->new_price}}   <span>{{$item->old_price}} </span> </div>
                      <a class="cart-btn {{($item->in_card)?'inCard':''}}" data-key="card_offer_{{$item->offer_id}}" v-on:click="add_ShoppingCard('{{$item->offer_id}}','offer','card_offer_{{$item->offer_id}}')">
                          <i class="icon-basket-loaded"></i>
                      </a>
                    </article>
                  </div>
                @endforeach
              </div><!--End item-slide-5 with-nav-->
            </div>
            <br>
          </div>
        </div>
      </section>

      <section class="padding-bottom-60">
        <div class="container">
          <a href="{{$data['ads']['ads_site_home_fullWidth_link']}}" target="_blank" >
              <img class="img-responsive" src="{{asset('images/ads/'.$data['ads']['ads_site_home_fullWidth'])}}"  >
          </a>
        </div>
      </section>

      <!-- Top Selling Week -->
      <section class="light-gry-bg padding-top-60 padding-bottom-30">
        <div class="container">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-pills margin-bottom-40" role="tablist">
            <li role="presentation" class="active"><a href="{{url('Site/Category/item')}}" style="cursor: pointer;">@lang('page.items Categories')</a></li>

          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Featured -->
            <div role="tabpanel" class="tab-pane active fade in" id="featur">
              <!-- Items Slider -->
              <div class="item-slide-5 with-nav">
                <!-- Product -->
                @foreach ($data['Categories'] as $category)
                    <div class="product">
                      <article>
                        <a href="{{url('Site/item/'.$category->id)}}">
                            <img class="img-responsive" src="{{$category->logo}}" style="width:184px;height:184px">
                            <span class="tag-1">{{$category->name}}</span>
                        </a>
                      </article>
                    </div>
                @endforeach


              </div>
            </div>


          </div>
        </div>
      </section>

      <!-- Main Tabs Sec -->
      <section class="featur-tabs padding-top-60 padding-bottom-60">
        <div class="container">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-pills margin-bottom-40" role="tablist">
            <li role="presentation" class="active">
              <a href="{{url('Site/Company')}}" style="cursor: pointer;" >@lang('page.companies')</a>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Featured -->
            <div role="tabpanel" class="tab-pane active fade in" id="featur">
              <!-- Items Slider -->
              <div class="item-slide-5 with-nav">
                <!-- Product -->
                @foreach ($data['companies'] as $company)
                    <div class="product">
                      <a href="{{url('Site/Company/details/'.$company->id)}}">
                        <article> <img class="img-responsive" src="{{$company->logo}}" style="width:184px;height:184px" >

                           {{-- @if(  in_array($company->membership_id, [2,3,4]) )
                                <span class="{{($company->membership_id==2)?'Bronze':''}} {{($company->membership_id==3)?'Silver':''}} {{($company->membership_id==4)?'Golden':''}}  "  >
                                  {{$company->membership_name}}
                                </span>
                           @endif --}}
                             <!-- Content -->
                             <span class="tag-1">{{$company->name}}</span>
                             <!-- Reviews -->
                             @php
                                $this_membership = null;
                                if( in_array($company->membership_id, [2,3,4]) )
                                {
                                      switch ($company->membership_id)
                                      {
                                         case 2:
                                             $this_membership = 'bronze';
                                            break;
                                         case 3:
                                             $this_membership = 'silver';
                                            break;
                                         case 4:
                                             $this_membership = 'gold';
                                            break;
                                      }
                                }
                             @endphp

                             @if ($this_membership)
                                <span class="sale-tag2"> <img src="{{asset('site_assets/images/'.$this_membership.'.png')}}"></span>
                             @endif
                          </article>
                       </a>
                    </div>
                @endforeach


              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="disply-sec slid-sec margin-bottom-0">
        <div class="container">
          <div class="row">

            <!-- Smartphone -->
            <div class="col-md-6">
                <a href="{{url($data['ads']['ads_site_home_halfWidth_1_link'])}}" target="_blank">
                    <img src="{{asset('images/ads/'.$data['ads']['ads_site_home_halfWidth_1'])}}" style="width:570px;height:250px">
                </a>
            </div>

            <!-- Sport -->
            <div class="col-md-6">
                <a href="{{url($data['ads']['ads_site_home_halfWidth_2_link'])}}" target="_blank">
                    <img src="{{asset('images/ads/'.$data['ads']['ads_site_home_halfWidth_2'])}}" style="width:570px;height:250px">
                </a>
            </div>

          </div>
        </div>
      </section>

      <section class="light-gry-bg padding-top-60 padding-bottom-30">
        <div class="container">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-pills margin-bottom-40" role="tablist">
            <li role="presentation" class="active" >
               <a href="{{url('Site/ProducerFamily')}}" style="cursor: pointer;">@lang('page.items of Producer Families')</a>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Featured -->
            <div role="tabpanel" class="tab-pane active fade in" id="featur">
              <!-- Items Slider -->
              <div class="item-slide-5 with-nav">
                <!-- Product -->
                @foreach ($data['ProducerFamilyProduct'] as $family)
                  <div class="product">
                     <a href="{{url('Site/ProducerFamily/details/'.$family->id)}}">
                          <article> <img class="img-responsive" src="{{$family->image}}" style="width:184px;height:184px" >
                            <!-- Content -->
                            <span class="tag-1">{{$family->name}}</span>
                         <!-- Reviews -->
                         </article>
                      </a>
                    </div>
                @endforeach
              </div>
            </div>


          </div>
        </div>
      </section>


      <section class="featur-tabs padding-top-60 padding-bottom-60">
        <div class="container">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-pills margin-bottom-40" role="tablist">
            <li role="presentation" class="active"><a href="#featur" aria-controls="featur" role="tab" data-toggle="tab">@lang('page.Auction')</a></li>

          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Featured -->
            <div role="tabpanel" class="tab-pane active fade in" id="featur">
              <!-- Items Slider -->
              <div class="item-slide-5 with-nav">
                <!-- Product -->
                @foreach ($data['AuctionRequest'] as $Auction)
                    <div class="product"  >
                      <article v-on:click="AuctionRequest_clicked()">
                         <img class="img-responsive" src="{{$Auction->image}}" style="width:184px;height:184px" >
                        <!-- Content -->
                          <span class="tag">{{$Auction->category_name}}</span>
                         <a href="#." class="tittle">{{$Auction->title}}</a>
                        <!-- Reviews -->
                        </article>
                    </div>
                @endforeach
              </div>
            </div>


          </div><!--End tab-content-->
        </div>
      </section>

      <!-- Top Selling Week -->
      <section class="padding-top-60 padding-bottom-60">
        <div class="container">

          <!-- heading -->
          <div class="heading">
            <h2> <a href="{{url('Site/RecycablesNews')}}"> @lang('page.News of your mandobcom activities and recycling') </a> </h2>
            <hr>
          </div>
          <div id="blog-slide" class="with-nav">

            <!-- Blog Post -->
            @foreach ($data['RecycablesNews'] as $News)
               <div class="blog-post">
                    <article>
                        <img class="img-responsive" src="{{$News->image}}" style="width:360px;height:224px;cursor:pointer" onclick="window.location.replace('{{url('Site/RecycablesNews/details/'.$News->id)}}')">
                        <a href="{{url('Site/RecycablesNews/details/'.$News->id)}}" class="tittle"> {{$News->name}} </a>
                    </article>
               </div>
            @endforeach
          </div>
        </div>
      </section>

      <!-- Clients img -->

    <!-- End Content -->


</section><!--End -->
@endsection

@section('script')
    <script>
    </script>
    <script src="{{asset('js_site/Home.js')}}"> </script>
@endsection
