@extends('Site.layout.blank')


@section('content')

<section id="items_list">

  <!-- Linking -->
  <div class="linking">
    <div class="container">
      <ol class="breadcrumb">
        <li><a href="{{url('Site')}}">@lang('page.Home')</a></li>
        <li class="active"> @{{current_categoiry.label}} </li>
      </ol>
    </div>
  </div>


  <!-- Products -->
  <section class="padding-top-40 padding-bottom-60">
    <div class="container">
      <div class="row">

        <!-- Shop Side Bar -->
        <div class="col-md-3">
          <div class="shop-side-bar">

            <!-- Categories -->
            <h6>@lang('page.Categories')</h6>
            <div class="checkbox checkbox-primary">
                <input type="text" class="form-control" v-model="search_SubCategory"  placeholder="@lang('page.search')">
              <ul>
                  <li v-for="(cat,index) in filteredSubCategory" >
                      <input :id="'cate'+index" :value="cat.value" class="styled inp_cat" type="checkbox" name="categoires_fillter[]" v-on:change="getResults">
                      <label :for="'cate'+index" > @{{cat.label}} </label>
                  </li>
              </ul>
            </div>

            <!-- Categories -->
            <h6> @lang('page.Price') </h6>
            <!-- PRICE -->
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="price_from" id="price_from" class="form-control" v-on:keyup.enter="getResults" placeholder="@lang('page.from')">
                </div><!--End col-md-6-->
                <div class="col-md-6">
                    <input type="text" name="price_to" id="price_to" class="form-control" v-on:keyup.enter="getResults" placeholder="@lang('page.to')" >
                </div><!--End col-md-6-->
            </div><!--End row-->
            <br>
            <button class="btn-round" v-on:click="getResults"> @lang('page.Filter') </button>

            <!-- Featured Brands -->
            <h6> @lang('page.Company') </h6>
            <div class="checkbox checkbox-primary">
              <input type="text" class="form-control" v-model="search_companies"  placeholder="@lang('page.search')">
              <ul>
                <li v-for="(company,index) in filteredcompanies">
                  <input :id="'brand'+index" :value="company.id" class="styled inp_company" type="checkbox" name="companies_fillter[]" v-on:change="getResults"  > <!-- :checked="company.id==company_id_search_val" -->
                  <label :for="'brand'+index"> @{{company.name}}  </label>
                </li>
              </ul>
            </div>

            {{-- <!-- Rating -->
            <h6>Rating</h6>
            <div class="rating">
              <ul>
                <li><a href="#."><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i> <span>(218)</span></a></li>
                <li><a href="#."><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> <span>(178)</span></a></li>
                <li><a href="#."><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> <span>(79)</span></a></li>
                <li><a href="#."><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> <span>(188)</span></a></li>
              </ul>
            </div> --}}


          </div><!--End shop-side-bar-->
        </div><!--End col-md-3-->

        <!-- Products -->
        <div class="col-md-9">

          <!-- Short List -->
          <div class="short-lst">
            <h2> @{{current_categoiry.label}}</h2>
            <ul>
              <!-- Short List -->
              {{-- <li>
                <p>Showing 1–12 of 756 results</p>
              </li> --}}
              <!-- Short  -->
              <li >
                <select class="selectpicker" id="paginate_no" v-on:change="getResults">
                  <option value="15">@lang('page.Show 15') </option>
                  <option value="25">@lang('page.Show 25') </option>
                  <option value="35">@lang('page.Show 35') </option>
                </select>
              </li>
              <!-- by Default -->
              <li>
                <select class="selectpicker" id="sort" v-on:change="getResults">
                    <option value=""> @lang('page.Sort by Default') </option>
                    <option value="stars"> @lang('page.Sort by rating') </option>
                    <option value="price_desc"> @lang('page.Sort by highest price') </option>
                    <option value="price_asc"> @lang('page.Sort by lowest price') </option>
                </select>
              </li>

              <!-- Grid Layer -->
              <li class="grid-layer">
                  <a href="#" :class="{'active':view_type=='list'}" v-on:click="switch_view('list')">
                      <i class="fa fa-list margin-right-10"></i>
                  </a>
                  <a href="#." :class="{'active':view_type=='card'}" v-on:click="switch_view('card')">
                    <i class="fa fa-th"></i>
                  </a>
              </li>
              {{-- <li>
                <!-- Columns -->
                <select class="selectpicker">
                  <option >3 Columns </option>
                  <option>4 Columns </option>
                  <option>5 Columns</option>
                </select>
              </li> --}}
            </ul>
          </div>

          <!-- - - - - - -START spinner- - - - - - - -->
          <spinner2 v-if="show_spinner"></spinner2>
          <!-- - - - - - -End spinner- - - - - - - -->

          <div v-if="mainList.data.length==0">  <h5><center>@lang('page.no items')</center></h5>    </div>
          <div v-else>

          <!-- Items -->
          <div :class="{'item-col-3':view_type=='card', 'col-list':view_type=='list'}">
            <!-- Product -->
            <div class="product"  v-for="list in mainList.data" v-show="view_type=='card'">
              <article>
                <img class="img-responsive" :src="list.image.split(',')[0]" style=" width: 242px; height: 242px;cursor:pointer" v-on:click="url_redirect('{{url('Site/item/details')}}/'+list.item_id)"> <!-- <span class="sale-tag">-25%</span>--> <span>

                   <span class="new-tag" v-if="list.is_new" >  @lang('page.new') </span> 
                <!-- Content -->
                <span class="tag"> @{{list.sub_category_name}} </span> <a :href="'{{url('Site/item/details')}}/'+list.item_id" class="tittle"> @{{list.item_name}} </a>
                <!-- Re  -->
                <p class="rev">
                  <i class="fa fa-star" v-for="n in (list.stars) " ></i>
                  <i class="fa fa-star-o" v-for="n in (5-list.stars)" ></i>
                  <span class="margin-left-10"> @{{list.views}} @lang('page.views') </span>
                </p>
                <div class="price"> @{{list.price}}  <!--<span>$200.00</span>--> </div>
                <a href="#." :class="['cart-btn',{'inCard':list.in_card}]" v-on:click="add_ShoppingCard(list)" >
                    <i class="icon-basket-loaded"></i>
                </a>

               </article>
            </div><!--End product card view-->

            <div class="product" v-for="list in mainList.data" v-show="view_type=='list'">
              <article>
                <!-- Product img -->
                <div class="media-left pic">
                  <div class="item-img"> <img class="img-responsive" :src="list.image.split(',')[0]" style=" width: 250px; height: 250px;" >  </div>
                </div>
                <!-- Content -->
                <div class="media-body">
                  <div class="row">
                    <!-- Content Left -->
                    <div class="col-sm-7">
                        <span class="tag">@{{list.sub_category_name}}</span>
                        <a href="#." class="tittle">@{{list.item_name}}</a>
                      <!-- Reviews -->
                      <p class="rev">
                        <i class="fa fa-star" v-for="n in (list.stars) " ></i>
                        <i class="fa fa-star-o" v-for="n in (5-list.stars)" ></i>
                      <span class="margin-left-10"> @{{list.views}}  @lang('page.views')</span></p>
                      <ul class="bullet-round-list">
                        <li> @lang('page.minimum_amount') @{{list.minimum_amount}} </li>
                        <li> @lang('page.maximum_amount') @{{list.maximum_amount}} </li>
                      </ul>
                    </div>
                    <!-- Content Right -->
                    <div class="col-sm-5 text-center">
                      {{-- <a href="#." class="heart"><i class="fa fa-heart"></i></a> <a href="#." class="heart navi"><i class="fa fa-navicon"></i></a> --}}
                        <div class="position-center-center">
                            <div class="price">@{{list.price}} @lang('page.JD')</div>
                            <p>likes: <span class="in-stock">@{{list.likes}}</span></p>
                            <a href="#." :class="['btn-round',{'inCard':list.in_card}]" v-on:click="add_ShoppingCard(list)">
                              <i class="icon-basket-loaded"></i> @lang('page.Add to Cart')
                            </a>
                        </div>
                    </div>
                  </div>
                </div>
              </article>
            </div><!--End product list view-->

            <br>

          </div>
          <!-- - - - - - -START paginate- - - - - - - -->
          <div class="row">
                <div class="col-md-8 col-md-offset-5">
                      <pagination :data="mainList" v-on:pagination-change-page="getResults" > <!-- the_mainList -->
                          <span slot="prev-nav" aria-label="Previous"> &lt;   </span>
                          <span slot="next-nav" aria-label="Next">   &gt;</span>
                      </pagination>
                </div>
          </div><!--End row-->
          <!-- - - - - - -End paginate- - - - - - - -->
        </div><!--End else of if="mainList.data.length==0" -->
          <br>

          <!-- pagination -->
          {{-- <ul class="pagination">
            <li><a href="#" aria-label="Previous"> <i class="fa fa-angle-left"></i> </a> </li>
            <li><a class="active" href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#" aria-label="Next"> <i class="fa fa-angle-right"></i> </a> </li>
          </ul> --}}
          <br>


        </div>


        <br>



      </div>
    </div>
  </section>

  <!-- Clients img -->


</section>
@endsection

@section('script')
    <script>
        let get_categoiry_id = '{{$categoiry_id}}';
        let get_name_search_val = '{{$_GET['search']??null}}';
        let get_company_id_search_val = '{{$_GET['company_id']??null}}';
    </script>
    <script src="{{asset('js_site/Item.js')}}"> </script>
@endsection
