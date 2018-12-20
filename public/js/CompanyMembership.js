let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: {data:[]},
        show_spinner:true,
        SF: {}, //Edit Form
        btn_submit: false,
        companies: get_companies,
        Memberships: get_Memberships,
        status_list: [
            {label: 'تم الدفع' , value: 'paid'},
            {label: 'لم يتم الدفع' , value: 'not_paid'},
            {label: 'تم الدفع و  لم يتم التفعيل' , value: 'paid_and_notConfirmed'},
            {label: 'تم الدفع و تم التفعيل' , value: 'paid_and_confirmed'}
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
         switchPaid(id){
             $.get(switch_paid_api+'/'+id ,(responce)=>{
               let find = myVue.mainList.data.find(obj => obj.id == id);
                  find.paid = responce.case;
             });
         },
         switchConfirmed(id){
             $.get(switch_confirmed_api+'/'+id ,(responce)=>{
               let find2 = myVue.mainList.data.find(obj => obj.id == id);
                  find2.confirmed = responce.case;
             });
         },
         diffforhumans(data)
         {
             moment.locale('ar');
             if (data) {
               return moment(data).fromNow();
             }
         },
         toDate(data)
         {
             moment.locale('en');
             if (data) {
               return moment(data).format("YYYY-MM-DD");
             }
         }
    }//End methods
});
