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

         $.post(base_url+'/Company/list'+'?page=' + page ,$('#search_form').serializeArray(),(Response)=>{
             root.mainList = Response;
             root.show_spinner = false;
         });
      },
      assign_meddily(list)
      {
          var membership = null;
          if( [2,3,4].includes(list.membership_id) )
          {
             switch (list.membership_id)
             {
                case 2:
                   membership = 'bronze';
                  break;
               case 3:
                   membership = 'silver';
                  break;
               case 4:
                   membership = 'gold';
                  break;
             }
          }
          if(membership){
             return `${images_path}/images/${membership}.png`;
          }
          else {
             return null;
          }
      }
    }
});
