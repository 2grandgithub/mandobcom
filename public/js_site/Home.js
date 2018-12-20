
let root = new Vue({
  el: '#root',
  data:{
    mainList: {item:[]},
    show_spinner:true,
    Cats_and_subCats_list: Categories_and_subCategories_list,
    AuthBuyer_id: get_AuthBuyer_id,
    items: [{},{}]
  },
  mounted(){    console.log('home');
        this.getResults();
  },
  methods:{
       getResults(page = 1){
         this.mainList = {item:[]};
         this.show_spinner = false;

       },
       add_ShoppingCard(id,type,theTarget )
       {
            if(this.AuthBuyer_id == 0)
              new Noty({ text: ' يجب ان تسجل الدخول كمشتري اولا ', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
            else
            {
                  $.ajax({
                        url: `${base_url}/ShoppingCart/${this.AuthBuyer_id}/${id}/${type}`,
                        headers: {
                            'userToken': get_jwt
                        },
                        method: 'GET',
                        dataType: 'json',
                        success: function(responce){
                            if(responce.status=='unValidToken')
                              new Noty({ text: ' يجب عليك تسجيل الدخول', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
                            else if (responce.status=='success')
                            {
                                if( responce.case )
                                  $('[data-key="'+theTarget+'"]').addClass('inCard');
                                else
                                  $('[data-key="'+theTarget+'"]').removeClass('inCard');
                            }
                        }
                  });
            }
       },//End add_ShoppingCard(list)
       AuctionRequest_clicked()
       {    console.log('AuctionRequest clicked');
          new Noty({ text: ' رجاء الاشتراك كاشركة ', layout: 'center', type: 'info' , timeout:'1500'  }).show();
       }

  },//End methods
});
