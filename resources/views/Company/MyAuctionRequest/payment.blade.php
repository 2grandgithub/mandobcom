

@component('components.panel_default_with_blank')
    @slot('active') MyAuctionRequest @endslot
      @slot('page_title') @lang('page.payment')  @endslot
    @slot('panel_title') @lang('page.payment') @endslot

    @slot('body')
        @companyPermission('MyAuctionRequest')
        <div id="myVue">

             <hr>
           <br> <h2> @lang('page.AuctionRequest') </h2>
            <table class="table mydir">
                <tr>
                  <th> @lang('page.code') </th>
                  <td> {{$AuctionRequest->id}} </td>
                </tr>
                <tr>
                  <th> @lang('page.title')  </th>
                  <td> {{$AuctionRequest->title}} </td>
                </tr>
                <tr>
                  <th> @lang('page.Category')  </th>
                  <td> {{$AuctionRequest->category_name}} </td>
                </tr>
                <tr>
                  <th> @lang('page.required_quantity') </th>
                  <td> {{$AuctionRequest->required_quantity}} </td>
                </tr>
                <tr>
                  <th> @lang('page.date') </th>
                  <td> {{$AuctionRequest->from}} - {{$AuctionRequest->to}} </td>
                </tr>
                <tr>
                  <th> @lang('page.description') </th>
                  <td> {{$AuctionRequest->description}} </td>
                </tr>
            </table>
            <hr>
            <h2> @lang('page.Offer') </h2>
            <table class="table mydir">
              <thead>
                <tr>
                  <th> @lang('page.Company') </th>
                  <th> @lang('page.price_offer') </th>
                  <th> @lang('page.comment') </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td> {{$Offer->company_name}}</td>
                  <td> {{$Offer->price_offer}}</td>
                  <td> {{$Offer->comment}}</td>
                </tr>
              </tbody>
            </table>

            <div class="  mydir">
              {!! Form::open([ 'method'=>'GET', 'url'=>'Company/AuctionRequest/payment/'.$AuctionRequest->id ,'v-on:submit.prevent'=>'do_submit()','id'=>'the_form']) !!}
                  <ul class=" ">
                    <li>
                        <input type="radio" name="paymentMethod" id="payOnDelivery" value="pay on delivery" v-model="paymentMethod"   >
                        <label for="payOnDelivery">   @lang('page.Paiement when recieving')  </label>
                    </li>
                    {{-- <li>
                        <input type="radio" name="paymentMethod" id="bankTransfer" value="bank transfer" v-model="paymentMethod" >
                        <label for="bankTransfer">  @lang('page.Bank transfer')  </label>
                    </li> --}}
                    <li>
                        <input type="radio" name="paymentMethod" id="creditCard" value="credit card" v-model="paymentMethod"  >
                        <label for="creditCard">  @lang('page.creditCard')  </label>
                    </li>
                  </ul>

                    <button type="submit" name="button" class="btn btn-success"> make the deal </button>
              {!! form::close() !!}
            </div><!--End container-->

            <br><br>
             <div v-if="show_credit_card">
                <form action="hyperPay_confirm_url" class="paymentWidgets" data-brands="VISA MASTER"></form>
             </div>




       </div><!--End myVue-->
       @endcompanyPermission
    @endslot

    @slot('script')
       <script>
       let base_site_url = '{{url('Site')}}';
       let base_url = '{{url('Company/AuctionRequest/payment/'.$AuctionRequest->id)}}';

       let myVue = new Vue({
         el: '#myVue',
         data:{
           checkout_id: 0,
           show_credit_card: false,
           paymentMethod: ''
         },
         mounted()
         {
           this.creditCard_choosed();
         },
         methods:{
           creditCard_choosed()
           {
               $.ajax({
                     url: `${base_site_url}/Payment/Prepare_the_checkout`,
                     headers: {
                         // 'userToken': get_jwt,
                         // 'buyer_id': get_AuthBuyer_id
                     },
                     method: 'GET',
                     dataType: 'json',
                     success: function(responce){
                       if(responce.status=='unValidToken')
                           noty({ text: ' يجب عليك تسجيل الدخول', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
                       else if(!responce.id )
                           noty({ text: ' يوجد مشكلة ', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
                        else
                        {
                              myVue.checkout_id = responce.id;
                              let recaptchaScript = document.createElement('script');
                              recaptchaScript.setAttribute('src', `https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=${responce.id}`);
                              document.head.appendChild(recaptchaScript);
                              myVue.show_credit_card = true;
                        }
                     }
               });
           },//End creditCard_choosed
           do_submit()
           {              console.log('do_submit');
               if(this.paymentMethod =='pay on delivery'){ console.log('pay on delivery');
                    $('#the_form').submit();
               }
               else if(this.paymentMethod =='credit card') {  console.log('credit card');
                   noty({ text: ' استخدم فورمت الدفع ', layout: 'topRight', type: 'error' , timeout:'2000'  }).show();
               }
               else {     console.log('else');
                   noty({ text: ' اختار طريقة الدفع ', layout: 'topRight', type: 'error' , timeout:'2000'  }).show();
               }
           }

         },//End methods
         computed:{
             hyperPay_confirm_url()
             {
                if(this.paymentMethod =='pay on delivery'){
                    return `${base_url}?paymentMethod=pay on delivery`;
                }
                else if(this.paymentMethod =='credit card') {
                    return `${base_url}?paymentMethod=credit card`;
                }
                else {
                   return '';
                }
             }
         },//End computed

       });
       </script>
    @endslot

@endcomponent
