let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: {data:[]},
        show_spinner:true
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
         DeleteMessage(id){
              showDeleteMessage(id,delete_api+'/'+id).then(()=>{
                 myVue.getResults();
              });
         },
         showCreateModel(){
            $('#create_model').modal('show');
         },
         showEditModel(this_data){
              $('#edit_model').modal('show');
              $('#edit_id').val(this_data.id);
              $('#edit_body').val(this_data.body);
              $('#edit_answer').val(this_data.answer);
         },
         showORhide(id){
             $.get(showORhide_api+'/'+id ,(responce)=>{ myVue.getResults() });
         }

    }//End methods
});

$('#search_form').find('select').change(()=>{ myVue.getResults(); });
