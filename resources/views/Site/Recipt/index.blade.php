@extends('Site.layout.blank')


@section('content')
  <style >
    #ShoppingCart details summary span.is_case
    {
      background-color: green;
      color: white;
      padding: 5px;
      border-radius: 10px;
      margin: 0 5px;
    }
  </style>
<section id="ShoppingCart">

  <!-- Content -->
 <br>

    <!-- ..................................START Shopping Cart.............................................. -->

      <div class="container" >
         <h3 class="mydir"> @lang('page.my orders') </h3>
         <br><br><br><br><br><br>

   <details v-for="list in mainList.data">
          <summary class="{{$mydir_custom}}">
                <span v-if="lang =='en'" > @{{list.company_name_en}} </span>
                <span v-else > @{{list.company_name_ar}} </span>

                <div class="pull-atherWay">
                  <span>  @{{list.created_at}}  </span>
                  <span class="count"> @{{list.items.length}} </span>
                </div>

              <span v-if="list.is_cancled" class="is_case" style="background-color: #5d8e3c; color: white; padding: 5px; border-radius: 10px; margin: 0 5px" > @lang('page.is_cancled') </span>
              <span v-if="list.is_delivered" class="is_case" style="background-color: #5d8e3c; color: white; padding: 5px; border-radius: 10px; margin: 0 5px"  > @lang('page.is_delivered') </span>
              <span v-if="list.is_paid"  class="is_case" style="background-color: #5d8e3c; color: white; padding: 5px; border-radius: 10px; margin: 0 5px"> @lang('page.is_paid') </span>
          </summary>


          <div class="table-responsive">
             <table class="table">
               <thead>
                 <tr>
                   <th> @lang('page.Items') </th>
                   <th> @lang('page.name') </th>
                   <th class="text-center"> @lang('page.Price') </th>
                   <th class="text-center"> @lang('page.Quantity') </th>
                   <th class="text-center"> @lang('page.Total Price')  </th>

                   <th>&nbsp; </th>
                 </tr>
               </thead>
               <tbody>

                 <!-- Item Cart -->
                 <tr v-for="(item,item_index) in list.items">
                   <td>
                     <img class="img-responsive" :src="item.image" width="120px" > </a>
                  </td>
                   <td class="text-center padding-top-60">
                      <div class=" ">
                        <p v-if="lang=='en'"> @{{item.name_en}} <span v-show="item.type=='offer'" class="type"> @{{item.type}} </span>  </p>
                        <p v-if="lang=='ar'"> @{{item.name_ar}} <span v-show="item.type=='offer'" class="type"> @{{item.type}} </span>  </p>
                      </div>
                   </td>
                   <td class="text-center padding-top-60"> @{{item.single_price}} @lang('page.JD')</td>
                   <td class="text-center padding-top-60"> @{{item.quantity}}  </td>
                   <td class="text-center padding-top-60"> @{{item.total_price}} @lang('page.JD')</td>
               </tbody>
               <tfoot>
                  <td>  </td>
                  <td>  </td>
                  <td>  </td>
                  <td>  </td>
                  <td class="text-center  ">
                     <p> @{{list.total_price}}@lang('page.JD')  </p>
                     <p v-if="list.is_delivered">
                        <span v-if="list.is_paid" class="badge badge-success" > @lang('page.is_delivered') </span>
                     </p>
                     <p v-if="list.is_paid">
                        <span v-if="list.is_paid" class="badge badge-success" > @lang('page.is_paid') </span>
                     </p>
                     <p v-if="list.is_cancled">
                        <span v-if="list.is_paid" class="badge badge-success" > @lang('page.is_cancled') </span>
                     </p>
                  </td>


               </tfoot>
             </table>
          </div>

        </details>


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
        <br><br>
   </div><!--End class="container"   -->

 <!-- ..................................END Shopping Cart.............................................. -->




</section><!--End -->
@endsection

@section('script')
    <script>
    </script>
    <script src="{{asset('js_site/Recipt_list.js')}}"> </script>
@endsection
