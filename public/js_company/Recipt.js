let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: {data:[]},
        show_spinner:true,
        show_items_spinner:true,
        SF: {}, //show Form
        btn_submit: false,
        items: [],
        case_list: [
              {label:'	تم الدفع فقط',value:'is_paid'},
              {label:'	تم التوصيل فقط',value:'is_delivered'},
              {label:'	تم الدفع	و تم التوصيل ',value:'is_paid_AND_delivered'},
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
         showShowModel(id){
              $('#show_model').modal('show');
              myVue.items = [];
              myVue.show_items_spinner = true;
              $.get(items_list+'/'+ id ,(Response)=>{
                  myVue.items = Response;
                  myVue.show_items_spinner = false;
              });
         },
         make_paided(id)
         {
              $.get(make_paided_api+'/'+id,(responce)=>{
                    let find = myVue.mainList.data.find(obj => obj.id == id);
                       find.is_paid = responce.case.is_paid;
                       find.is_delivered = responce.case.is_delivered;
                       find.is_cancled = responce.case.is_cancled; console.log();
              });
         },
         make_delivered(id)
         {
              $.get(make_delivered_api+'/'+id,(responce)=>{
                      let find = myVue.mainList.data.find(obj => obj.id == id);
                      find.is_paid = responce.case.is_paid;
                      find.is_delivered = responce.case.is_delivered;
                      find.is_cancled = responce.case.is_cancled;
              });
         },
         make_cancled(id)
         {
              $.get(make_cancled_api+'/'+id,(responce)=>{
                      let find = myVue.mainList.data.find(obj => obj.id == id);
                      find.is_paid = responce.case.is_paid;
                      find.is_delivered = responce.case.is_delivered;
                      find.is_cancled = responce.case.is_cancled;
              });
         }
    }//End methods
});
