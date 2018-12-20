
let root = new Vue({
  el: '#root',
  data:{
    ShoppingCart: [],
    show_spinner:true,
    show_spinner_aramex: false,
    show_paymentSpinner: false,
    AuthBuyer_id: get_AuthBuyer_id,
    paymentMethod: '',
    current_view: 'ShoppingCart',
    //----Aramex----
    Aramex_Countries: get_Aramex_Countries.Countries.Country,
    Aramex_Cities: [ ' .... '],
    Buyer_aramex_CountryCode: get_Buyer_aramex_CountryCode ,
    Buyer_aramex_City: get_Buyer_aramex_City ,
    //--full deal---
    deal: {
        company_id: 0,
        items: [],
        paymentMethod: '',
        total_Weight: '...',
        aramex_price: 0,
        total_price: 0,
        checkout_id: '' // for credit card (payment)
    },
  },
  mounted(){

        this.getResults();

  },
  methods:{
       getResults(page = 1){
         this.show_spinner = true;

           $.ajax({
                 url: `${base_url}/ShoppingCart/get_list`,
                 headers: {
                     'userToken': get_jwt
                 },
                 method: 'GET',
                 dataType: 'json',
                 success: function(response){ console.log(response);
                     root.ShoppingCart = response.ShoppingCart;
                 }
           });
       },
       removeCard(list,index,item_index)
       {
            if(this.AuthBuyer_id == 0)
              new Noty({ text: ' يجب ان تسجل الدخول كمشتري اولا ', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
            else
            {
                  $.ajax({
                        url: `${base_url}/ShoppingCart/${this.AuthBuyer_id}/${list.item_id}/${list.type}`,
                        headers: {
                            'userToken': get_jwt
                        },
                        method: 'GET',
                        dataType: 'json',
                        success: function(responce){
                            if(responce.status=='unValidToken')
                              new Noty({ text: ' يجب عليك تسجيل الدخول', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
                            else if (responce.status=='success') {
                                root.ShoppingCart[index].items.splice(item_index,1);
                            }
                        }
                  });
            }
       },//End add_ShoppingCard(list)
       doneShoppingCart(form,card)
       {
          $vaild = true;
          $(form.currentTarget).find('input[type="number"]').each(function(index, el) {

              let selected_value = parseInt($(this).val());
              let min_length = parseInt($(this).attr('minlength'));
              let max_length = parseInt($(this).attr('maxlength'));

              if( selected_value < min_length || selected_value > max_length )
              {
                $vaild = false;
              }
          });
          if(!$vaild)
          {
            new Noty({ text: ' من فضلك اختار الكميات الصحيحة ', layout: 'topCenter', type: 'error' , timeout:'2000'  }).show();
          }
          else // vaild
          {
              this.deal = { company_id: 0,   items: [],   paymentMethod: '' } //for recite
              this.deal.company_id = card.company_id;
              this.deal.company ={
                  aramex_CountryCode: card.aramex_CountryCode,
                  aramex_City: card.aramex_City,
                  company_name: card.company_name
              };
              root.deal.total_price = 0;
              card.items.forEach(function(item, index){
                  root.deal.items.splice(index,0, {} ); // add the empty object to the array
                  root.deal.items[index].item_id = item.item_id;
                  root.deal.items[index].type = item.type;
                  root.deal.items[index].price = item.price;
                  root.deal.items[index].Weight = item.Weight;
                  root.deal.items[index].quantity = $(form.currentTarget).find(`input[type="number"]:eq(${index})`).val();
                  root.deal.total_price += ( parseInt(item.price) * parseInt(root.deal.items[index].quantity)  );   console.log((parseInt(item.price) * parseInt(root.deal.items[index].quantity)  ));
              });
              this.current_view = 'DeliveryMethods';

              setTimeout(function () {   root.CalculateRate();  }, 500);
          }
       },
       done_payment()
       {
          if(this.paymentMethod == '')
            new Noty({ text: ' من فضلك اختار طريقة الدفع ', layout: 'topCenter', type: 'error' , timeout:'2000'  }).show();
          else {
            this.deal.paymentMethod = this.paymentMethod;
            this.current_view = 'DeliveryMethods';
          }
       },
       creditCard_choosed()
       {
           $.ajax({
                 url: `${base_url}/Payment/Prepare_the_checkout`,
                 headers: {
                     'userToken': get_jwt,
                     'buyer_id': get_AuthBuyer_id
                 },
                 method: 'GET',
                 dataType: 'json',
                 success: function(responce){
                   if(responce.status=='unValidToken')
                       new Noty({ text: ' يجب عليك تسجيل الدخول', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
                   else if(!responce.id )
                       new Noty({ text: ' يوجد مشكلة ', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
                    else
                    {
                          root.deal.checkout_id = responce.id;

                          let recaptchaScript = document.createElement('script')
                          recaptchaScript.setAttribute('src', `https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=${responce.id}`);
                          document.head.appendChild(recaptchaScript);
                    }

                 }
           });
       },
       CountryChanged()
       {
          $.get(`${base_apis_url}/Aramex/Cities_from_country/${this.Aramex_vars.Country}`,(response)=>{
               response = JSON.parse(response) ;
              root.Aramex_Cities = response.Cities.string ;

              setTimeout(function(){   $('.selectpicker').selectpicker('refresh');   }, 500);
          });
       },
       CalculateRate()  //Aramex
       {
           this.show_spinner_aramex = true;
           //START Calculate  total Weight ------
              let total_Weight = 0;
              this.deal.items.forEach((item)=>{
                   if(item.type == 'item'){
                      total_Weight += (item.Weight * item.quantity );
                   }
                   else if (item.type == 'offer') {
                      total_Weight += item.Weight;
                   }
             });
             root.deal.total_Weight = total_Weight;
             root.$forceUpdate();
             root.show_spinner_aramex = false;

          // //End Calculate  total Weight ------
          // //--get Calculater price
          // let Calculater_data = {
          //   Origin_City: this.deal.company.aramex_City ,
          //   Origin_CountryCode: this.deal.company.aramex_CountryCode ,
          //   Destination_City: this.Buyer_aramex_City ,
          //   Destination_CountryCode: this.Buyer_aramex_CountryCode ,
          //   Weight: total_Weight ,
          // };
          // $.post(`${base_apis_url}/Aramex/CalculateRate`,Calculater_data,(response)=>{
          //      response = JSON.parse(response);
          //      if(response.HasErrors){
          //         new Noty({ text: ' حدث مشكله في تحديد سعر الدفع ', layout: 'topCenter', type: 'error' , timeout:'2000'  }).show();
          //      }
          //      else {
          //          root.deal.aramex_price = response.TotalAmount.Value;
          //          root.$forceUpdate();
          //          root.show_spinner_aramex = false;
          //      }
          // });
       },
       confirm_the_deal()
       {
          if(this.paymentMethod == '')
            new Noty({ text: ' من فضلك اختار طريقة الدفع ', layout: 'topCenter', type: 'error' , timeout:'2000'  }).show();
          if(this.paymentMethod == 'credit card')
            new Noty({ text: ' من فضلك اضغط علي زر الدفع', layout: 'topCenter', type: 'error' , timeout:'2000'  }).show();
          else {
             window.location.replace( `${base_url}/Payment/makePayment/${ encodeURIComponent(JSON.stringify(this.deal)) }` );
          }
       }

  },//End methods
  computed:{
      Confirmation_items()
      {
         let find = this.ShoppingCart.find(obj => obj.company_id == this.deal.company_id );
         if (find) {
            return find.items;
         }
         else { return []; }
      },
      hyperPay_confirm_url()
      {
         return `${base_url}/Payment/makePayment/${ encodeURIComponent(JSON.stringify(this.deal)) }`;
      }
  },//End computed
  watch:{
     paymentMethod(val)
     {
        this.deal.paymentMethod = val;
     }
 }
});
