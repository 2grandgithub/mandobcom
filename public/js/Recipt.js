let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: {data:[]},
        show_spinner:true,
        show_items_spinner:true,
        SF: {}, //show Form
        btn_submit: false,
        items: [] ,
        Company_list: get_Company,
        case_list: [
              {label:'	تم الدفع فقط',value:'is_paid'},
              {label:'	تم التوصيل فقط',value:'is_delivered'},
              {label:'	تم الدفع	و تم التوصيل ',value:'is_paid_AND_delivered'},
              {label:' تم الالغاء ',value:'is_cancled'},
            ]
    },
    mounted(){
        this.getResults();
        $('.datepicker').datepicker({format: 'yyyy/mm/dd'}).on('changeDate',function(e){
             myVue.getResults();
        });
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
         showShowModel(item_id){
              $('#show_model').modal('show');
              myVue.items = [];
              myVue.show_items_spinner = true;
              $.get(items_list+'/'+ item_id ,(Response)=>{
                  myVue.items = Response;
                  myVue.show_items_spinner = false;
              });
         },
         diffforhumans(data)
         {
             moment.locale('ar');
             if (data) {
               return  moment(data).fromNow()  ;
             }
         }
    }//End methods
});
