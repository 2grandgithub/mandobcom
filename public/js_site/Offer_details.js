
let root = new Vue({
  el: '#root',
  data:{
    item: item_get,
    comments: [],
    RelatedItems: [],
    show_spinner:true,
    AuthBuyer_id: get_AuthBuyer_id,
  },
  mounted(){
      this.get_comments_and_related_items();
  },
  methods:{
       add_ShoppingCard(list)
       {
            if(this.AuthBuyer_id == 0)
              new Noty({ text: ' يجب ان تسجل الدخول كمشتري اولا ', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
            else
            {
                  $.ajax({
                        url: `${base_url}/ShoppingCart/${this.AuthBuyer_id}/${list.offer_id}/offer`,
                        headers: {
                            'userToken': get_jwt
                        },
                        method: 'GET',
                        dataType: 'json',
                        success: function(responce){
                            if(responce.status=='unValidToken')
                              new Noty({ text: ' يجب عليك تسجيل الدخول', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
                            else if (responce.status=='success') {
                                list.in_card = responce.case;
                            }
                        }
                  });
            }
       },//End add_ShoppingCard(list)
       get_comments_and_related_items()
       {
            let sendData = {
                item_id: this.item.offer_id,
                category_id: this.item.category_id,
                type: 'offer',
                _token: csrf_token
            }; console.log(sendData);
            $.post(`${base_url}/Action/get_comments_and_related_items`,sendData,(responce)=>{ console.log('responce'); console.log(responce);
                  root.comments = responce.Comments;
                  root.RelatedItems = responce.RelatedItems;
                  setTimeout(()=>{  owl_related();  },1000);
            });
       },
       add_comment()
       {
           if(this.AuthBuyer_id == 0)
             new Noty({ text: ' يجب ان تسجل الدخول كمشتري اولا ', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
           else
           {
                  let the_data = {
                      item_id: this.item.offer_id,
                      type: 'offer',
                      comment: $('#txt_AddComment').val(),
                      _token: csrf_token
                  };
                 $.ajax({
                       url: `${base_url}/Action/add_comment`,
                       headers: {
                           'userToken': get_jwt,
                           'buyer_id': this.AuthBuyer_id
                       },
                       method: 'POST',
                       data: the_data,
                       dataType: 'json',
                       success: function(responce){
                           if(responce.status=='unValidToken')
                             new Noty({ text: ' يجب عليك تسجيل الدخول', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
                           else if (responce.status=='success')
                           {
                               root.comments.unshift({
                                 comment: $('#txt_AddComment').val() ,
                                 date:"now",
                                 name:"you"
                               });
                               $('#txt_AddComment').val('');
                               new Noty({ text: ' تم اضافت تعليقك في اعلي التعليقات ', layout: 'topRight', type: 'success' , timeout:'2000'  }).show();
                           }
                       }
                 });
           }//End else
       },//end add_comment
       like_add_or_remove()
       {
           if(this.AuthBuyer_id == 0)
             new Noty({ text: ' يجب ان تسجل الدخول كمشتري اولا ', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
           else
           {
                 $.ajax({
                       url: `${base_url}/Action/like_add_or_remove/offer/${this.item.offer_id}`,
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
                              root.item.is_liked = responce.case;
                           }
                       }
                 });
           }//End else
       },//end add_comment
       starChanged(val)
       {
         if(this.AuthBuyer_id == 0)
           new Noty({ text: ' يجب ان تسجل الدخول كمشتري اولا ', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
         else
         {
               if( this.item.stars == 1 && val == 1){
                 this.item.stars = 0 ;
               }
               else {
                 this.item.stars = val;
               }
               the_data = {
                   item_id: this.item.offer_id,
                   type: 'offer',
                   stars: this.item.stars ,
                   _token: csrf_token,
                   buyer_id: root.AuthBuyer_id
               };
               $.ajax({
                     url: `${base_apis_url}/Item/add_stars`,
                     headers: {
                         'userToken': get_jwt,
                         'buyer_id': this.AuthBuyer_id
                     },
                     method: 'POST',
                     data: the_data,
                     dataType: 'json',
                     success: function(responce){
                         if(responce.status=='unValidToken')
                           new Noty({ text: ' يجب عليك تسجيل الدخول', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
                         else if (responce.status=='success')
                         {
                             new Noty({ text: ' تم تعديل التقيم ', layout: 'topRight', type: 'success' , timeout:'2000'  }).show();
                         }
                     }
               });
         }
       }//End starChanged

  },//End methods
  computed: {

  }//End computed
});


function owl_related()
{
    $(".item-slide-4").owlCarousel({
          items : 4, autoplay:true, loop:false, margin: 30, autoplayTimeout:5000, autoplayHoverPause:true,
      	   navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
         	 lazyLoad:true, nav: true,
      	responsive:{   0:{ items:1, },   600:{ items:2, },  1000:{ items:4, } },
      	animateOut: 'fadeOut'
    });
}
