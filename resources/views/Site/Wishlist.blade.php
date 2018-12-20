@extends('Site.layout.blank')


@section('content')

<section id="Wishlist_list">

  <!-- Content -->
  <div id="content">

    <!-- Ship Process -->

    <!-- Shopping Cart -->
    <section class="shopping-cart padding-bottom-60">
      <div class="container">
      <div class="table-responsive">
        <table class="table ">
          <thead>
            <tr>
              <th> @lang('page.Items') </th>
              <th class="text-center"> @lang('page.Price') </th>

              <th>&nbsp; </th>
            </tr>
          </thead>
          <tbody>

            <!-- Item Cart -->
            <tr v-for="(list,index) in data">
              <td><div class="media">
                  <div class="media-left">
                      <a href="'{{url('Site/item/details')}}/'+list.item_id"> <img class="img-responsive" :src="list.image"  > </a>
                  </div>
                  <div class="media-body">
                    <p style="color: #aaaaaa;"> @{{list.company_name}} </p>
                    <p> @{{list.name}} </p>
                  </div>
                </div></td>
              <td class="text-center padding-top-60"> @{{list.price}} JD </td>


              <td class="text-center padding-top-60">
                <button class="remove" v-on:click="like_add_or_remove(list,index)" > <i class="fa fa-close"></i> </button>
              </td>
            </tr>

          </tbody>
        </table>

          <p v-if="data.length==0"> <center v-if="data.length==0">   @lang('page.no items') </center> </p>

    </div>
        <!-- Promotion -->


        <!-- Button -->
        {{-- <div class="pro-btn"> <a href="#." class="btn-round btn-light"> add to cart </a>  </div> --}}
        <div class="pro-btn">
          <a v-on:click="getResults(mainList.next_page_url)" v-show="mainList.next_page_url" class="btn-round btn-light" > load more </a>
        </div>
      </div>
    </section>

    <!-- Clients img -->


    <!-- Newslatter -->

  </div>
  <!-- End Content -->


</section><!--End -->
@endsection

@section('script')
    <script>
    </script>
    <script src="{{asset('js_site/wishlist.js')}}"> </script>
@endsection
