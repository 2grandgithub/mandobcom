let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: {data:[]},
        show_spinner:true,
        show_offers_spinner:false,
        SF: {}, //show Form
        AF: {}, //accapt Form
        btn_submit: false,
        Category_list: get_Category,
        offers: []
    },
    mounted(){
            $(".datepicker").datepicker({format: 'yyyy-mm-dd'});
             $('#accapt_form').validate();
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
         showShowModel(auction_id){
              $('#show_model').modal('show');
              myVue.offers = [];
              myVue.SF = myVue.mainList.data.find(obj=>obj.id == auction_id);
              myVue.show_offers_spinner = true;
              $.get(offers_list+'/'+ auction_id ,(Response)=>{
                  myVue.offers = Response;
                  myVue.show_offers_spinner = false;
              });
         },
         showORhide(id,status){
            if(status == 1)
            {
                $.get(unAccaptedAuction_api+'/'+id ,(responce)=>{
                    myVue.getResults();
                });
            }
            else {
              $('#accapt_model').modal('show');
              this.AF = myVue.mainList.data.find(obj=>obj.id == id);
            }
         },
         accaptAuction()
         {
            this.show_offers_spinner = true;
            this.btn_submit = true;
            $.post(accaptAuction_api, $('#accapt_form').serializeArray(),(Response)=>{
                myVue.getResults();
                this.show_offers_spinner = false;
                this.btn_submit = false;
                $('#accapt_form').trigger("reset");
                $('#accapt_model').modal('hide');
            });
         }
    }//End methods
});
