let root = new Vue({
    el: '#root',
    data:{
      mainList: {data:[]},
      show_spinner:true,
    },
    mounted(){
        this.getResults();
    },
    methods:{
      getResults(page = 1){
        this.mainList = {data:[]};
        this.show_spinner = true;

         $.post(base_url+'/ProducerFamily/list'+'?page=' + page ,$('#search_form').serializeArray(),(Response)=>{
             root.mainList = Response;
             root.show_spinner = false;
         });
      },
    }
});
