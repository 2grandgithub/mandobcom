
let myVue = new Vue({
    el:'#myVue',
    data:{
        mainList: {data:[]},
        show_spinner:false,
        SF: {}, //Edit Form
        btn_submit: false,
        options: [
           { name: 'Vue.js',      id:1 },
           { name: 'Rails',       id:2 },
           { name: 'Sinatra',     id:3 },
           { name: 'Laravel',     id:4 },
           { name: 'Phoenix',     id:5 }
         ],
        value: 1,
        list: [
           { name: 'Vue.js', language: 'JavaScript' , id:1  },
           // { id: 2,  },
           // { id: 3,  },
           // { id: 4,  },
        ]
    },
    mounted(){



              this.value  = this.options.find(obj=>obj.id == 2);
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
         upp()
         {
           console.log('uppp');
         },
         chh(){
           console.log('dd');
         }

    },//End methods
    // components: {
    //   Multiselect
    // },
});
