let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: {data:[]},
        show_spinner:true,
        SF: {}, //Edit Form
        btn_submit: false,
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
         showShowModel(this_data){
            $('#show_model').modal('show');
            this.SF = this_data;
            // this.SF.images = this_data.image.split(',');
         },
         showORhide(id){
             $.get(showORhide_api+'/'+id ,(responce)=>{
               let find = myVue.mainList.data.find(obj => obj.id == id);
                  find.status = responce.case;
             });
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
