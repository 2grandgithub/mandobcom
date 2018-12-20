let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: [],
        show_spinner:true
    },
    mounted(){
        this.getResults();
        $('#create_form').validate();
    },//End mounted()
    methods:{
         getResults(page = 1){
           this.mainList = [];
           this.show_spinner = true;

            $.post(User_list+'?page=' + page,$('#search_form').serializeArray(),(Response)=>{
                myVue.mainList = Response;
                this.show_spinner = false;
            });
         },
         DeleteMessage(id){
              showDeleteMessage(id,delete_api+'/'+id).then(()=>{
                 myVue.getResults();
              });
         },

    }//End methods
});
