let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: {data:[]},
        show_spinner:true,
        EF: {}, //Edit Form
        btn_submit: false,
        show_content: false,
        show_model_spinner: false,
        categories_list: get_categories
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
         category_change()
         {
            if( $('#category_id').val() != '' )
            {
              this.show_content = true;
              this.getResults();
              this.EF.category_id = $('#category_id').val();
            }
            else
              this.show_content = false;
         },
         DeleteMessage(id,index){
              showDeleteMessage(id,delete_api+'/'+id).then(()=>{
                  myVue.mainList.data.splice(index,1);
              });
         },
         showCreateModel(){
            $('#create_model').modal('show');
         },
         showEditModel(this_data){
              $('#edit_model').modal('show');
              this.EF = this_data;
         },
         showORhide(id){
             $.get(showORhide_api+'/'+id ,(responce)=>{
               let find = myVue.mainList.data.find(obj => obj.id == id);
                  find.status = responce.case;
             });
         },
         create()
         {
               if( $('#create_form').valid() )
               {
                   this.btn_submit = true;
                   this.show_model_spinner = true;
                   let my_formData = new FormData($('#create_form')[0]);
                   // Attach file
                   my_formData.append('image', $('#create_image')[0].files[0]);

                   $.ajax({
                       type:"post",
                       url: create_api,
                       data: my_formData,
                       processData: false,
                       contentType: false,
                       success : function(responce){
                           if(responce.status == 'success')
                                myVue.mainList.data.unshift(responce.data);
                           $('#create_model').modal('hide');
                           myVue.btn_submit = false;
                           myVue.show_model_spinner = false;
                           noty({text: ' تم اضافت المحتوي ', layout: 'topRight', type: 'success' });
                           $('#create_form').trigger("reset");
                           $('#create_form').find('img').prop('src','');
                       },
                   });//End ajax
               }
         },
         edit()
         {
              if( $('#edit_form').valid() )
              {
                  this.btn_submit = true;
                  this.show_model_spinner = true;
                  let my_formData = new FormData($('#edit_form')[0]);
                  // Attach file
                  my_formData.append('image', $('#edit_image')[0].files[0]);

                  $.ajax({
                      type:"post",
                      url: update_api,
                      data: my_formData,
                      processData: false,
                      contentType: false,
                      success : function(responce){
                          if(responce.status == 'success')
                          {
                             let find = myVue.mainList.data.find(obj => obj.id == responce.data.id);
                             find.logo = responce.data.logo;
                             find = responce.data;
                          }
                          $('#edit_model').modal('hide');
                          myVue.btn_submit = false;
                          myVue.show_model_spinner = false;
                          noty({text: ' تم تعديل المحتوي ', layout: 'topRight', type: 'success' });
                      },
                  });//End ajax
              }
         },
         Preview_image_create(e)
         {
              if (e.target.files && e.target.files[0])
              {
                  var reader = new FileReader();

                  reader.onload = function (event) { console.log(e.target);
                      $(e.currentTarget).parents('form').find('img').attr('src', event.target.result).addClass('img-thumbnail');
                      // $('#edit_img_temp').attr('src', event.target.result).addClass('img-thumbnail');
                  }
                  reader.readAsDataURL(e.target.files[0]);
              }
         },
         Preview_image_edit(e)
         {
              if (e.target.files && e.target.files[0])
              {
                  var reader = new FileReader();

                  reader.onload = function (event) {
                        myVue.EF.logo =  event.target.result;
                  }
                  reader.readAsDataURL(e.target.files[0]);
              }
         },

    }//End methods
});
