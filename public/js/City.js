let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: {data:[]},
        show_spinner:true,
        EF: {}, //Edit Form
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
                     let my_formData = new FormData($('#create_form')[0]);

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
                             noty({text: ' تم اضافت المحتوي ', layout: 'topRight', type: 'success' });
                             $('#create_form').trigger("reset");
                             $('#create_form').find('img').prop('src','');
                         },
                     });//End ajax
               }//End if  valid
         },
         edit()
         {
              if( $('#edit_form').valid() )
              {
                  this.btn_submit = true;
                  let my_formData = new FormData($('#edit_form')[0]);

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
                          noty({text: ' تم تعديل المحتوي ', layout: 'topRight', type: 'success' });
                      },
                  });//End ajax
              }//End if  valid
         }

    }//End methods
});
