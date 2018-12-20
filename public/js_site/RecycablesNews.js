let root = new Vue({
    el: '#root',
    data:{
      mainList: {data:[]},
      show_spinner:true,
    },
    mounted(){
        // $('.select2').select2();
        this.getResults();
    },
    methods:{
      getResults(page = 1){    
        this.mainList = {data:[]};
        this.show_spinner = true;

         $.post(base_url+'/RecycablesNews/list'+'?page=' + page ,$('#search_form').serializeArray(),(Response)=>{
             root.mainList = Response;
             root.show_spinner = false;
         });
      },
    }
});
