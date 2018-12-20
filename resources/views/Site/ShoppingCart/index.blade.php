@extends('Site.layout.blank')


@section('content')

<section id="ShoppingCart">

  <!-- Content -->
  <div id="content">

    <!-- Ship Process -->
    <div class="ship-process padding-top-30 padding-bottom-30">
      <div class="container">
        <ul class="row mydirection">

          <!-- Step 1 -->
          <li :class="['col-sm-3',{'current':current_view=='ShoppingCart'}]">
            <div class="media-left"> <i class="flaticon-shopping"></i> </div>
            <div class="media-body"> <span> @lang('page.Step 1') </span>
              <h6> @lang('page.Shopping Cart') </h6>
            </div>
          </li>

          <!-- Step 2 -->
          <li :class="['col-sm-3',{'current':current_view=='DeliveryMethods'}]">
            <div class="media-left"> <i class="flaticon-delivery-truck"></i> </div>
            <div class="media-body"> <span> @lang('page.Step 2') </span>
              <h6> @lang('page.Delivery Methods') </h6>
            </div>
          </li>

          <!-- Step 3 -->
          <li :class="['col-sm-3',{'current':current_view=='Confirmation'}]">
            <div class="media-left"> <i class="fa fa-check"></i> </div>
            <div class="media-body"> <span> @lang('page.Step 3') </span>
              <h6> @lang('page.Confirmation') </h6>
            </div>
          </li>

          <!-- Step 4 -->
          <li :class="['col-sm-3',{'current':current_view=='Payment'}]">
            <div class="media-left"> <i class="flaticon-business"></i> </div>
            <div class="media-body"> <span> @lang('page.Step 4') </span>
              <h6> @lang('page.Payment Methods') </h6>
            </div>
          </li>

        </ul>
      </div>
    </div>



    <!-- ..................................START Shopping Cart.............................................. -->

    <section class="col-md-12 col-xs-12 shopping-cart padding-bottom-60">
      <div class="container" v-show="current_view=='ShoppingCart'">

     {!! Form::open(['v-for'=>"(card,index) in ShoppingCart", 'class'=>"mydirection form",'id'=>'edit_form' ,'v-on:submit.prevent'=>'doneShoppingCart($event,card)'  ]) !!}
        <details>
          <summary class="{{$mydir_custom}}">
              <span class="count"> @{{card.items.length}} </span>
              <span>  @{{card.company_name}}  </span>
              <button type="submit" class="{{$mydir_custom}}" > @lang('page.Deal') </button>
          </summary>


          <div class="table-responsive">
             <table class="table">
               <thead>
                 <tr>
                   <th> @lang('page.Items') </th>
                   <th class="text-center"> @lang('page.Price') </th>
                   <th class="text-center"> @lang('page.Quantity') </th>
                   <th class="text-center"> @lang('page.Total Price')  </th>
                   <th>&nbsp; </th>
                 </tr>
               </thead>
               <tbody>

                 <!-- Item Cart -->
                 <tr v-for="(item,item_index) in card.items">
                   <td><div class="media">
                       <div class="media-left"> <a href="#.">
                         <img class="img-responsive" :src="item.image"  > </a> </div>
                       <div class="media-body">
                         <p> @{{item.name}} <span v-show="item.type=='offer'" class="type"> @{{item.type}} </span>  </p>
                       </div>
                     </div></td>
                   <td class="text-center padding-top-60"> @{{item.price}} @lang('page.JD')</td>
                   <td class="text-center"><!-- Quinty -->

                     <div class="quinty padding-top-20">
                       <input type="number"  v-model="item.current_amount" :minlength="item.minimum_amount" :maxlength="item.maximum_amount" :readonly="item.type=='offer'" required>
                       <br>
                       <p class="min_max_text" v-if="item.type=='item'" > minmum: @{{item.minimum_amount}} <br> maxmum: @{{item.maximum_amount}} </p>
                       <p class="min_max_text" v-else-if="item.type=='offer'" > amount: @{{item.maximum_amount}} </p>

                     </div></td>
                   <td class="text-center padding-top-60"> @{{ item.price * item.current_amount }} </td>
                   <input type="hidden" name="total_price" :value="item.price * item.current_amount">
                   <td class="text-center padding-top-60">
                     <a  v-on:click="removeCard(item,index,item_index)" class="remove" > <i class="fa fa-close"></i></a>
                   </td>
                 </tr>

               </tbody>
             </table>
          </div>

        </details>
     {!! Form::close() !!}

   </div><!--End class="container" v-show="current_view=='ShoppingCart'" -->

 </section>
 <!-- ..................................END Shopping Cart.............................................. -->



    <!-- ...............................................STRART Deleverty Method ...............................................-->
    <section class="padding-bottom-60" id="DeliveryMethods" v-if="current_view=='DeliveryMethods'">
      <div class="container">
        <!-- Payout Method -->
        <div class="pay-method">
          <div class="row">
            <div class="col-md-6">

              <!-- Your information -->
              <div class="heading">
                <h2> @lang('page.Your information') </h2>
                <hr>
              </div>
              <form>
                <div class="row">

                  <!-- Name -->
                  <div class="col-sm-6">
                    <label>  @lang('page.Company')
                       : @{{deal.company.company_name}}
                    </label>
                  </div>

                  <!-- Number -->
                  <div class="col-sm-6">

                  </div>

                  <!-- Card Number -->
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-xs-6">
                        <label>  @lang('page.from') </label>
                         <p> @{{deal.company.aramex_CountryCode}} - @{{deal.company.aramex_City}} </p>
                      </div>
                      <div class="col-xs-6">
                        <label>  @lang('page.to')</label>
                         <p> @{{Buyer_aramex_CountryCode}} - @{{Buyer_aramex_City}} </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <label>  @lang('page.street')
                       : {{auth('Buyer')->user()->street}}
                    </label>
                  </div>

                  <!-- Zip code -->
                  <div class="col-sm-4">
                    <label>  @lang('page.building_no')
                       : {{auth('Buyer')->user()->building_no}}
                    </label>
                  </div>

                  <!-- Address -->
                  <div class="col-sm-8">
                    <label>  @lang('page.Zip code')
                      : {{auth('Buyer')->user()->zip_code}}
                    </label>
                  </div>

               </div><!--End row-->
               <hr>
               <!-- - - - - - -START spinner- - - - - - - -->
               <spinner3 v-if="show_spinner_aramex"></spinner3>
               <!-- - - - - - -End spinner- - - - - - - -->

               <p> @lang('page.total_Weight') : @{{deal.total_Weight}} </p>
               {{-- <p> @lang('page.total price') : @{{deal.aramex_price}} JOD </p> --}}

              </form>
            </div>

            <!-- Select Your Transportation -->
            <div class="col-md-6">
              <div class="heading">
                <h2> @lang('page.Select Your Transportation') </h2>
                <hr>
              </div>
              <div class="transportation">
                <div class="row">

                  <!-- Free Delivery -->
                  <div class="col-sm-6">
                        <div class="charges select">
                             <h6> @lang('page.not available now') </h6>
                             <br>
                             <span>   </span>
                        </div>

                  </div>

                  <!-- Free Delivery -->
                  <div class="col-sm-6">
                        <div class="charges">
                            <h6> @lang('page.Delivery') </h6>
                            <br>
                            <span> @lang('page.Aramex soon') </span>
                       </div>
                  </div>
                  <!-- Expert Delivery -->
                  <div class="col-sm-6">
                    {{-- <div class="charges">
                      <h6> @lang('page.Expert Delivery')  </h6>
                      <br>
                      <span>  @lang('page.24 - 48 Hours') </span> <span class="deli-charges"> +$75 </span> </div> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Button -->
        <div class="pro-btn">
          {{-- <a href="#" class="btn-round btn-light" v-on:click="current_view='Payment'" >Back to Payment</a> --}}
          <button class="btn-round btn-light" v-on:click="current_view='ShoppingCart'"> @lang('page.Shopping Cart') </button>
          <button class="btn-round " v-on:click="current_view='Confirmation'" > @lang('page.Go Confirmation') </button>
        </div> @{{current_view}}
      </div>
    </section>
   <!-- ...............................................END Deleverty Method ...............................................-->


  <!-- ...............................................START Confirmation ...............................................-->
  <!-- Payout Method -->
  <section class="padding-bottom-60" id="Confirmation" v-show="current_view=='Confirmation'">
    <div class="container">
      <!-- Payout Method -->
      <div class="pay-method check-out">

        <!-- Shopping Cart -->
        <div class="heading">
          <h2> @lang('page.Shopping Cart') </h2>
          <hr>
        </div>

        <!-- Check Item List -->
        <ul class="row check-item" v-for="item in Confirmation_items">
          <li class="col-xs-6">
            <p>
                <img :src="item.image" style="width: 74px;height: 132px;" class="img-responsive" >
                @{{item.name}} <span v-show="item.type=='offer'" class="type"> @{{item.type}} </span>
            </p>
          </li>
          <li class="col-xs-2 text-center">
            <p> @{{item.price}} @lang('page.JD')</p>
          </li>
          <li class="col-xs-2 text-center">
            <p> @{{item.current_amount}} </p>
          </li>
          <li class="col-xs-2 text-center">
            <p> @{{ item.price * item.current_amount }} </p>
          </li>
        </ul>



        <!-- Totel Price -->
        <div class="totel-price">
          <h4><small> @lang('page.total_price') : </small>  @{{deal.total_price}} @lang('page.JD') </h4>
        </div>
      </div>

      <!-- Button -->
      <div class="pro-btn">
        <button class="btn-round btn-light" v-on:click="current_view='DeliveryMethods'"> @lang('page.Back to Delivery')  </button>
        <button class="btn-round  " v-on:click="current_view='Payment'"> @lang('page.Payment Methods')  </button>
        {{-- <button class="btn-round"> @lang('page.Payment Methods') </button> --}}
      </div>
    </div>
  </section>
<!-- ...............................................END Confirmation ...............................................-->

<!-- ...............................................START Payout Method ........................................-->
<section class="padding-bottom-60" id="PayoutMethod" v-show="current_view=='Payment'">
  <div class="container">
    <!-- Payout Method -->
    <div class="pay-method">
      <div class="row">
        <div class="col-md-6">

          <!-- Your Card -->
          <div class="heading" id="methods">
              <h2> @lang('page.payment') </h2>
              <hr>
              <ul class="mydir">
                <li>
                    <input type="radio" name="paymentMethod" id="payOnDelivery" value="pay on delivery" v-model="paymentMethod"  >
                    <label for="payOnDelivery">   @lang('page.Paiement when recieving')  </label>
                </li>
                {{-- <li>
                    <input type="radio" name="paymentMethod" id="bankTransfer" value="bank transfer" v-model="paymentMethod" >
                    <label for="bankTransfer">  @lang('page.Bank transfer')  </label>
                </li> --}}
                <li>
                    <input type="radio" name="paymentMethod" id="creditCard" value="credit card" v-model="paymentMethod"  v-on:click="creditCard_choosed" >
                    <label for="creditCard">  @lang('page.creditCard')  </label>
                </li>
              </ul>
          </div>
          <img src="images/card-icon.png" alt="" > </div>
        <div class="col-md-6">
           <div class="heading">
               <h2>  @lang('page.details') </h2>
               <hr>
           </div>
          <div class="mydir">

            <div class="" v-if="paymentMethod=='pay on delivery'">
              <p> @lang('page.Payment will be made when receipt of the order') </p>
            </div>

            {{-- <div class="" v-if="paymentMethod=='bank transfer'">

               <p> @lang('page.upload the recipt')  </p>
               <input type="file" name="" value="" class="form-control">

            </div> --}}

            <div class="" v-if="paymentMethod=='credit card'">

               <spinner2 v-show="show_paymentSpinner" ></spinner2>
               <div v-show="paymentMethod=='credit card'">
                   <form  :action="hyperPay_confirm_url" class="paymentWidgets" data-brands="VISA MASTER"></form>
               </div>

            </div>

          </div><!--End mydir-->

        </div><!--End col-md-6-->
      </div><!--End row-->
    </div><!--End pay-method-->

    <!-- Button -->
      <div class="pro-btn">
        <button class="btn-round btn-light" v-on:click="current_view='Confirmation'" > @lang('page.Go Confirmation')  </button>
        <button class="btn-round" v-on:click="confirm_the_deal()"  > @lang('page.Done') </button> <!-- v-on:click="donee" -->
      </div>
  </div>
</section>
<!-- ...............................................END Payout Method ........................................-->
<!-- Clients img -->


    <!-- Newslatter -->
    <section class="newslatter"> </section>
  </div>
  <!-- End Content -->


</section><!--End -->
@endsection

@section('script')
    <script>
       let get_Aramex_Countries = JSON.parse(`{!!$Aramex_Countries!!}`);
       let get_Buyer_aramex_CountryCode = '{{$Buyer_aramex_CountryCode}}' ;
       let get_Buyer_aramex_City = '{{$Buyer_aramex_City}}' ;
    </script>
    <script src="{{asset('js_site/ShoppingCart.js')}}"> </script>
@endsection
