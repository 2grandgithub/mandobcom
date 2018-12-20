
let root = new Vue({
  el: '#root',
  data:{
    mainList: {},
    data: [],
    show_spinner:true,
    AuthBuyer_id: get_AuthBuyer_id,
  },
  mounted(){
                  console.log('wishlist moounted');

        this.getResults();
  },
  methods:{
       getResults(listUrl = `${base_url}/Wishlist/list`){
         this.mainList = {data:[]};
         this.show_spinner = true;

          $.get(listUrl ,(Response)=>{
              root.mainList = Response;
              root.data.push.apply(root.data,Response.data) ;
              root.show_spinner = false;
          });
       },
       like_add_or_remove(list,index)
       {
           if(this.AuthBuyer_id == 0)
             new Noty({ text: ' يجب ان تسجل الدخول كمشتري اولا ', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
           else
           {
                 $.ajax({
                       url: `${base_url}/Action/like_add_or_remove/item/${list.item_id}`,
                       headers: {
                           'userToken': get_jwt,
                           'buyer_id': this.AuthBuyer_id
                       },
                       method: 'GET',
                       dataType: 'json',
                       success: function(responce){
                           if(responce.status=='unValidToken')
                             new Noty({ text: ' يجب عليك تسجيل الدخول', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
                           else if (responce.status=='success')
                           {
                              root.data.is_liked = responce.case;
                              root.data.splice(index,1); 
                           }
                       }
                 });
           }//End else
       }//end like_add_or_remove
       // add_ShoppingCard(list)
       // {
       //      if(this.AuthBuyer_id == 0)
       //        new Noty({ text: ' يجب ان تسجل الدخول كمشتري اولا ', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
       //      else
       //      {
       //            $.ajax({
       //                  url: `${base_url}/ShoppingCart/${this.AuthBuyer_id}/${list.item_id}/item`,
       //                  headers: {
       //                      'userToken': get_jwt
       //                  },
       //                  method: 'GET',
       //                  dataType: 'json',
       //                  success: function(responce){
       //                      if(responce.status=='unValidToken')
       //                        new Noty({ text: ' يجب عليك تسجيل الدخول', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
       //                      else if (responce.status=='success') {
       //                          list.in_card = responce.case;
       //                      }
       //                  }
       //            });
       //      }
       // }//End add_ShoppingCard(list)
  },//End methods
});


$('#main_search_bar').keypress(function(e) {
    if(e.which == 13) {
         root.getResults();
    }
});
