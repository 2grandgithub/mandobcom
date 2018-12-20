let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: {data:[]},
        show_spinner:true,
        SF: {}, //show Form
        btn_submit: false,
        accaptance_list: [
              {label:' الطلبات المنتهية ',value:'is_done'},
              {label:' الطلبات الحالية ',value:'is_not_done'},
            ]
    },
    mounted(){
        this.getResults();
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
         },
         showORhide(id){
             $.get(showORhide_api+'/'+id ,(responce)=>{
               let find = myVue.mainList.data.find(obj => obj.id == id);
                  find.status = responce.case;
             });
         },
         doneORnot(id){
             $.get(done_or_not_api+'/'+id ,(responce)=>{
               let find = myVue.mainList.data.find(obj => obj.id == id);
                  find.is_done = responce.case;
             });
         },


    }//End methods
});
