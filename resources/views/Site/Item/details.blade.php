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
                               <div class="">

                               </div>
                               <i v-for="(n,index) in 5" :class=" { 'fa fa-star':(index<item.stars) , 'fa fa-star-o':(index>=item.stars) }" v-on:click="starChanged(1+index)" >   </i>

                               <span class="margin-left-10">@{{item.views}} @lang('page.view(s)') </span>
                             </p>




                             <div class="row">
                                <div class="col-sm-6"><span class="price">  @{{item.price}}   </span></div>
                                <div class="col-sm-6">

                                </div>
                             </div>
                             <!-- List Details -->
                             <p class="bullet-round-list" > @{{item.item_description}} </p>

                             <ul class="bullet-round-list">
                                <li> @lang('page.minimum'): @{{item.minimum_amount}}  </li>
                                <li> @lang('page.Maximum'): @{{item.maximum_amount}}  </li>
                             </ul>

                             <!-- Colors -->

                             <!-- Compare Wishlist -->
                             <ul class="cmp-list">
                                <li>
                                  <button id="btn_add_Wishlist" :class="{'active':item.is_liked}" v-on:click="like_add_or_remove()" >
                                    <i class="fa fa-heart"></i>
                                    <span v-show="item.is_liked"> @lang('page.in Wishlist') </span>
                                    <span v-show="!item.is_liked"> @lang('page.Add to Wishlist') </span>
                                  </button>
                                </li>
                             </ul>
                             <!-- Quinty -->
                             <div class="quinty">

                             </div>
                             <button id="btn_addShoppingCard" class="btn-round" :class="['cart-btn',{'inCard':item.in_card}]" v-on:click="add_ShoppingCard(item)">
                               <i class="icon-basket-loaded margin-right-5"></i>
                               <span v-show="!item.in_card"> @lang('page.Add to Cart')  </span>
                               <span v-show="item.in_card"> @lang('page.In card') </span>
                             </button>
                          </div>
                       </div>
                    </div>



                    <div class="comments">
                      <h6 class="margin-0"> @lang('page.Comments') </h6>
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
                      <h6> @lang('page.Leave a Comment')  </h6>

                      <!-- FORM -->
                        <ul class="row">
                            <li class="col-sm-12">
                              <label> @lang('page.Message')
                                  <textarea class="form-control" rows="3" placeholder="" style="height:150px" id="txt_AddComment"></textarea>
                              </label>
                            </li>
                            <li class="col-sm-12 text-left">
                                <button type="submit" class="btn-round" v-on:click="add_comment()">@lang('page.Send Message')</button>
                            </li>
                        </ul>
                    </div>


                 </div><!-- End product-detail-->
                 <!-- Related Products -->
                 <section class="padding-top-30 padding-bottom-0">
                    <!-- heading -->
                    <div class="heading">
                       <h2>@lang('page.Related Products')</h2>
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
                               <a :href="'{{url('Site/item/details')}}/'+RItem.item_id" class="tittle"> @{{RItem.item_name}} </a>
                               <!-- Reviews -->
                               <p class="rev">
                                   <i class="fa fa-star" v-for="s in RItem.stars"></i> <i class="fa fa-star-o" v-for="s in (5-RItem.stars)"></i>
                                   <span class="margin-left-10"> @{{RItem.views}} @lang('page.view(s)') </span>
                               </p>
                               <div class="price">@{{RItem.price}} @lang('page.JD')</div>
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



</section>
@endsection

@section('script')
    <script>
        let item_get = JSON.parse(`{!!$item!!}`);
    </script>
    <script src="{{asset('js_site/Item_details2.js')}}"> </script>
@endsection
