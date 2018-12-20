
let root = new Vue({
  el: '#root',
  data:{
    mainList: {data:[]},
    show_spinner:true,
    lang:lang,
  },
  mounted(){

        this.getResults();

  },
  methods:{

       getResults(page = 1)
       {
              this.mainList = {data:[]};
              this.show_spinner = true;

             $.ajax({
                   url: `${base_apis_url}/Recipt/recipt_list/${get_AuthBuyer_id}`+'?page=' + page ,
                   headers: {
                       'userToken': get_jwt,
                   },
                   method: 'GET',
                   dataType: 'json',
                   success: function(responce){
                     if(responce.status=='unValidToken'){
                        new Noty({ text: ' يجب عليك تسجيل الدخول', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
                     }
                     root.mainList = responce;
                  }
             });

    },

  },//End methods


});
