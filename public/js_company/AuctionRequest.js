let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: {data:[]},
        show_spinner:true,
        show_offers_spinner:true,
        SF: {}, //show Form
        btn_submit: false,
        Category_list: get_Category,
        offers: [],
        company_id: company_id,
        offer_types: [
          { label:' مناقصاتي ', value:company_id }
        ]
    },
    mounted(){
        this.getResults();
        $('#create_form').validate();
        $('#add_offer_form').validate();
    },//End mounted()
    methods:{
         getResults(page = 1){
           this.mainList = {data:[]};
           this.show_spinner = true;

            $.post(get_list+'?page=' + page ,$('#search_form').serializeArray(),(Response)=>{
                myVue.mainList = Response;
                myVue.show_spinner = false;
            });
         },
         showShowModel(auction_id,company_id){
              $('#show_model').modal('show');
              myVue.offers = [];
              myVue.SF = myVue.mainList.data.find(obj=>obj.id == auction_id);
              myVue.show_offers_spinner = true;
              $.get(offers_list+'/'+ auction_id ,(Response)=>{
                  myVue.offers = Response;
                  myVue.show_offers_spinner = false;
              });
         },
         show_add_offer_model(id,title){
              $('#add_offer_model').modal('show');
              $('#auction_request_id').val(id);
              $('#create_title').text(title);
         },
         showCreateModel(id,title){
              $('#create_model').modal('show');
         },
         add_offer()
         {
               if( $('#add_offer_form').valid() )
               {
                   this.btn_submit = true;
                   let my_formData = new FormData($('#add_offer_form')[0]);

                   $.ajax({
                       type:"post",
                       url: add_offer_api,
                       data: my_formData,
                       processData: false,
                       contentType: false,
                       success : function(responce){
                           if(responce.status == 'success')
                           {
                               // myVue.mainList.data.unshift(responce.data);
                               // myVue.getResults();
                               noty({text: ' تم اضافت العرض', layout: 'topRight', type: 'success' });
                               $('#add_offer_form').trigger("reset");
                           }
                           $('#add_offer_model').modal('hide');
                           myVue.btn_submit = false;
                       },
                   });//End ajax
               }
         },
         create()
         {
               if( $('#create_form').valid() )
               {
                   this.btn_submit = true;
                   let my_formData = new FormData($('#create_form')[0]);

                   $.ajax({
                       type:"post",
                       url: add_auction_api,
                       data: my_formData,
                       processData: false,
                       contentType: false,
                       success : function(responce){
                           if(responce.status == 'success')
                           {
                               myVue.getResults();
                               noty({text: ' تم اضافت المناقصة', layout: 'topRight', type: 'success' });
                               $('#create_form').trigger("reset");
                           }
                           $('#create_model').modal('hide');
                           myVue.btn_submit = false;
                       },
                   });//End ajax
               }
         },
         accaptOffer(offer_id)
         {

             swal({
                 title: " هل انت متاكد؟ ",
                 // text: "You want to delete ( "+name+" ) !",
                 text:  '!'+"انت  توافق علي العرض  "+'(' +offer_id+ ')',
                 type: "info",
                 showCancelButton: true,
                 confirmButtonColor: "#DD6B55",
                 confirmButtonText: " ! نعم اوافق ",
                 cancelButtonText : " الغاء ",
                 closeOnConfirm: false
             }, function () {

                 window.location.href = accapt_offer_link+'/'+offer_id;
                 swal("Deleted!", " تم الموافقة بنجاح", "success");

            });//End swal


         },
         Preview_image_create(e)
         {
             $('#Preview_create_images').html('');
             if (e.target.files) //Preview_image
             {
                    var filesAmount = e.target.files.length;
                    for (i = 0; i < filesAmount; i++)
                    {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $('#Preview_create_images').append('<img src="'+event.target.result+'" width="200px" style="min-height:100px" class="img-thumbnail">');
                        }
                        reader.readAsDataURL(e.target.files[i]);
                    }
              }
         },
         Preview_image_edit(e)
         {
             this.EF.image = '';
             $('#Preview_image_edit').html('');
             if (e.target.files) //Preview_image
             {
                    var filesAmount = e.target.files.length;
                    for (i = 0; i < filesAmount; i++)
                    {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $('#Preview_image_edit').append('<img src="'+event.target.result+'" width="200px" style="min-height:100px" class="img-thumbnail">');
                        }
                        reader.readAsDataURL(e.target.files[i]);
                    }
              }
         },
    }//End methods
});
