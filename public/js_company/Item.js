let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: {data:[]},
        show_spinner:true,
        show_form_spinner:false,
        SF: {}, //show Form
        EF: {}, //edit Form
        btn_submit: false,
        Category_list: get_Category,
        subCategory_list: [],
        btn_submit: false
    },
    mounted(){
        this.getResults();
        $('#create_form').validate();
        $('#edit_form').validate();
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
         Category_change(type)
         {
             let val;
              this.subCategory_list = [];
              if (type=='create') {
                  val = $('#category_id').val();
              }
              else if (type=='edit'){
                  val = $('#edit_category_id').val();
              }  console.log(val);
              let find = this.Category_list.find(obj => obj.value == val );
              this.subCategory_list = find.SubCategory;
         },
         DeleteMessage(id,index){
              showDeleteMessage(id,delete_api+'/'+id).then(()=>{
                  myVue.mainList.data.splice(index,1);
              });
         },
         showShowModel(this_data){
            $('#show_model').modal('show');
            this.SF = this_data;
            this.SF.images = this_data.image.split(',');
         },
         showORhide(id){
             $.get(showORhide_api+'/'+id ,(responce)=>{
               let find = myVue.mainList.data.find(obj => obj.id == id);
                  find.status = responce.case;
             });
         },
         showCreateModel(){
              $('#create_model').modal('show');
         },
         showEditModel(this_data)
         {
              $('#edit_model').modal('show');
              this.EF = this_data;
              this.EF.images = this_data.image.split(',');
              //--set subCategory_list
              this.subCategory_list = [];
              let val = $('#category_id').val();
              let find = this.Category_list.find(obj => obj.value == this.EF.category_id );
              this.subCategory_list = find.SubCategory;
              $('#edit_subCategory_id').val(this.EF.category_id);
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
         create()
         {
               if( $('#create_form').valid() )
               {
                   this.btn_submit = true;
                   this.show_form_spinner = true;
                   let my_formData = new FormData($('#create_form')[0]);
                   // Attach Multiple file[]
                   my_formData.append('image', $('#create_image')[0].files);

                   $.ajax({
                       type:"post",
                       url: create_api,
                       data: my_formData,
                       processData: false,
                       contentType: false,
                       success : function(responce){
                           if(responce.status == 'success')
                           {
                               // myVue.mainList.data.unshift(responce.data);
                               myVue.getResults();
                               noty({text: ' تم اضافت المحتوي ', layout: 'topRight', type: 'success' });
                               $('#create_form').trigger("reset");
                               $('#Preview_create_images').html('');
                           }
                           else if(responce.status == 'offers_ended')
                           {
                               let message = '';
                               if( responce.type == 'membership' ){
                                  message = ' لقد انتها عدد العروض المتاحة لك - انتا علي النظام '+responce.membership_type+
                                            " -عدد العروض التي كانت متاحة لدي " + responce.membership_no_offer;
                               }
                               else {
                                 message = ' لقد انتها عدد العروض المتاحة لك - عدد العروض التي كانت متاحة لك اضافتها هي'
                                        +responce.membership_no_offer+" اشتترك في احد العضويات للزياده ";

                               }
                               noty({text: message , layout: 'topRight', type: 'error' });
                           }
                           else {
                             noty({text: ' بياناتك ناقصة ', layout: 'topRight', type: 'error' });
                           }
                           $('#create_model').modal('hide');
                           myVue.btn_submit = false;
                           myVue.show_form_spinner = false;
                       },
                   });//End ajax
               }
         },
         edit()
         {
               if( $('#edit_form').valid() )
               {
                   this.btn_submit = true;
                   this.show_form_spinner = true;
                   let my_formData = new FormData($('#edit_form')[0]);
                   // Attach Multiple file[]
                   my_formData.append('image', $('#edit_image')[0].files);

                   $.ajax({
                       type:"post",
                       url: update_api,
                       data: my_formData,
                       processData: false,
                       contentType: false,
                       success : function(responce){
                           if(responce.status == 'success')
                           {
                               myVue.getResults();
                               noty({text: ' تم تعديل المحتوي ', layout: 'topRight', type: 'success' });
                               $('#create_form').trigger("reset");
                               $('#Preview_create_images').html('');
                           }
                           else if(responce.status == 'offers_ended')
                           {
                               let message = '';
                               if( responce.type == 'membership' ){
                                  message = ' لقد انتها عدد العروض المتاحة لك - انتا علي النظام '+responce.membership_type+
                                            " -عدد العروض التي كانت متاحة لدي " + responce.membership_no_offer;
                               }
                               else {
                                 message = ' لقد انتها عدد العروض المتاحة لك - عدد العروض التي كانت متاحة لك اضافتها هي'
                                        +responce.membership_no_offer+" اشتترك في احد العضويات للزياده ";

                               }
                               noty({text: message , layout: 'topRight', type: 'error' });
                           }
                           else {
                             noty({text: ' بياناتك ناقصة ', layout: 'topRight', type: 'error' });
                           }
                           $('#edit_model').modal('hide');
                           myVue.btn_submit = false;
                           myVue.show_form_spinner = false;
                       },
                   });//End ajax
               }
         },

    }//End methods
});



function change_image(input)
{
       if (input.files && input.files[0])
       {
           var reader = new FileReader();

           reader.onload = function (e) {
              $(input).parents('form').find('img').attr('src', e.target.result).addClass('img-thumbnail');
           }
           reader.readAsDataURL(input.files[0]);
       }
}
