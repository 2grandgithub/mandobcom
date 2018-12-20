@extends('Site.layout.blank')


@section('content')

<section id="items_list">

  <!-- Linking -->
  <div class="linking">
    <div class="container">
      <ol class="breadcrumb">
        <li><a href="#">@lang('page.Home')</a></li>
        <li class="active"> @lang('page.details')  </li>
      </ol>
    </div>
  </div>

  <!-- Content -->
  <div id="content">
     <!-- Products -->
     <section class="padding-top-40 padding-bottom-60">
        <div class="container">
           <div class="row">

              <!-- Products -->
              <div class="col-md-12">
                 <div class="product-detail">
                    <div class="product">
                       <div class="row">
                          <!-- Slider Thumb -->
                          <div class="col-xs-12 col-md-5">
                             <article class="slider-item on-nav">

                                       <div id="slider" class="flexslider">
                                         <ul class="slides">
                                           <li v-for="img in item.image.split(',')">
                                             <img :src="img" alt="" style="height: 400px;">
                                           </li>
                                           <!-- items mirrored twice, total of 12 -->
                                         </ul>
                                       </div>
                                       <div id="carousel" class="flexslider">
                                         <ul class="slides">
                                           <li v-for="img in item.image.split(',')">
                                             <img :src="img" alt="">
                                           </li>
                                           <!-- items mirrored twice, total of 12 -->
                                         </ul>
                                       </div>
                             </article>
                          </div>
                          <!-- Item Content -->
                          <div class="col-xs-12 col-md-7">
                             <span class="tags"> @{{item.category_name}} </span>
                             <h5> @{{item.item_name}} </h5>
                             <p class="rev">
                               <i v-for="(n,index) in 5" :class=" { 'fa fa-star':(index<item.stars) , 'fa fa-star-o':(index>=item.stars) }" v-on:click="starChanged(1+index)" >   </i>

                               {{-- <i class="fa fa-star" v-for="star in item.stars"></i>
                               <i class="fa fa-star-o" v-for="star in (5-item.stars)"></i> --}}
                               <span class="margin-left-10">@{{item.views}} @lang('page.view(s)')</span>
                             </p>
                             <div class="row">
                                <div class="col-sm-6">
                                  <span class="price"> <span class="old_price">@{{item.old_price}}   </span>  @{{item.new_price}}   </span>
                                </div>
                                <div class="col-sm-6">

                                </div>
                             </div>
                             <!-- List Details -->
                             <p class="bullet-round-list" > @{{item.offer_description}} </p>

                             <ul class="bullet-round-list">
                                <li> amount : @{{item.amount}}     </li>
                             </ul>

                             <!-- Colors -->

                             <!-- Compare Wishlist -->
                             {{-- <ul class="cmp-list">
                                <li>
                                  <button id="btn_add_Wishlist" :class="{'active':item.is_liked}" v-on:click="like_add_or_remove()" >
                                    <i class="fa fa-heart"></i>
                                    <span v-show="item.is_liked"> in Wishlist </span>
                                    <span v-show="!item.is_liked"> Add to Wishlist </span>
                                  </button>
                                </li>
                             </ul> --}}

                             <!-- Quinty -->
                             <div class="quinty">

                             </div>
                             <button id="btn_addShoppingCard" class="btn-round" :class="['cart-btn',{'inCard':item.in_card}]" v-on:click="add_ShoppingCard(item)">
                               <i class="icon-basket-loaded margin-right-5"></i>
                               <span v-show="!item.in_card"> Add to Cart </span>
                               <span v-show="item.in_card"> In card </span>
                             </button>
                          </div>
                       </div>
                    </div>



                    <div class="comments">
                      <h6 class="margin-0">Comments  </h6>
                      <ul>
                        <!-- Comments -->
                        <li class="media" v-for="comment in comments">
                          <div class="media-left"> <a href="#" class="avatar">  </a> </div>
                          <div class="media-body padding-left-20">
                            <h6> @{{comment.name}} <span><i class="fa fa-bookmark-o"></i> @{{comment.date}} </span> </h6>
                            <p> @{{comment.comment}}  </p>
                          </div>
                        </li>
                      </ul>
                    </div>

                    <!-- ADD comments -->
                    <div class="add-comments padding-top-20">
                      <h6>Leave a Comment</h6>

                      <!-- FORM -->
                        <ul class="row">
                            <li class="col-sm-12">
                              <label>Message
                                  <textarea class="form-control" rows="3" placeholder="" style="height:150px" id="txt_AddComment"></textarea>
                              </label>
                            </li>
                            <li class="col-sm-12 text-left">
                                <button type="submit" class="btn-round" v-on:click="add_comment()">Send Message</button>
                            </li>
                        </ul>
                    </div>


                 </div><!-- End product-detail-->
                 <!-- Related Products -->
                 <section class="padding-top-30 padding-bottom-0">
                    <!-- heading -->
                    <div class="heading">
                       <h2>Related Offers</h2>
                       <hr>
                    </div>
                    <!-- Items Slider -->
                    <div class="item-slide-4 with-nav">
                       <!-- Product -->
                         <div class="product" v-for="RItem in RelatedItems">
                            <article>
                               <img class="img-responsive" :src="RItem.image" style=" width: 242px; height: 242px;" >
                               <!-- Content -->
                               <span class="tag">@{{RItem.company_name}}</span>
                               <a :href="'{{url('Site/offer/details')}}/'+RItem.offer_id" class="tittle"> @{{RItem.offer_name}} </a>
                               <!-- Reviews -->
                               <p class="rev">
                                   <i class="fa fa-star" v-for="s in RItem.stars"></i> <i class="fa fa-star-o" v-for="s in (5-RItem.stars)"></i>
                                   <span class="margin-left-10"> @{{RItem.views}} Review(s)</span>
                               </p>
                               <div class="price"> <span>@{{RItem.old_price}}  </span>  @{{RItem.new_price}}    </div>
                               <button :class="['cart-btn',{'inCard':RItem.in_card}]" v-on:click="add_ShoppingCard(RItem)" class="cart-btn">
                                 <i class="icon-basket-loaded"></i>
                               </button>
                            </article>
                         </div>
                    </div>
                 </section>
              </div>
           </div>
        </div>
     </section>
     <!-- Your Recently Viewed Items -->

     <!-- Clients img -->


  </div>
  <!-- End Content -->

</section>
@endsection

@section('script')
    <script>
        let item_get = JSON.parse(`{!!$Offer!!}`);
    </script>
    <script src="{{asset('js_site/Offer_details.js')}}"> </script>
@endsection
