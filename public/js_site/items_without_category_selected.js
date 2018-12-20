
let root = new Vue({
  el: '#root',
  data:{
    mainList: {data:[]},
    show_spinner:true,
    view_type: 'card',
    Cats_and_subCats_list: Categories_and_subCategories_list,
    current_categoiry: {},
    companies: [],
    search_SubCategory: '',
    search_companies: '',
    AuthBuyer_id: get_AuthBuyer_id,
    first_getResults_call_finshed: false ,
  },
  mounted(){

         this.current_categoiry = this.Cats_and_subCats_list;

        if(get_name_search_val){
          $('#main_search_bar').val(get_name_search_val);
        }

        this.getResults();
  },
  methods:{
       getResults(page = 1){
         this.mainList = {data:[]};
         this.show_spinner = true;


          let search_data = {
              _token: csrf_token ,
              sort: $('#sort').val(),
              paginate_no: $('#paginate_no').val(),
              text: $('#main_search_bar').val(),
              price_from: $('#price_from').val(),
              price_to: $('#price_to').val(),
          };
          $.post(base_url+'/item_list_without_cat'+'?page=' + page ,search_data,(Response)=>{
              root.mainList = Response.items;
              root.companies = Response.Companies;
              root.show_spinner = false;

          });
       },
       switch_view(view)
       {
          this.view_type = view;
       },
       add_ShoppingCard(list)
       {
            if(this.AuthBuyer_id == 0)
              new Noty({ text: ' يجب ان تسجل الدخول كمشتري اولا ', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
            else
            {
                  $.ajax({
                        url: `${base_url}/ShoppingCart/${this.AuthBuyer_id}/${list.item_id}/item`,
                        headers: {
                            'userToken': get_jwt
                        },
                        method: 'GET',
                        dataType: 'json',
                        success: function(responce){
                            if(responce.status=='unValidToken')
                              new Noty({ text: ' يجب عليك تسجيل الدخول', layout: 'topRight', type: 'info' , timeout:'2000'  }).show();
                            else if (responce.status=='success') {
                                list.in_card = responce.case;
                            }
                        }
                  });
            }
       },//End add_ShoppingCard(list)
       url_redirect(url)
       {       console.log('url = '+url);
          window.location.replace(url);
       },
       category_url(id)
       {
          if(get_name_search_val){
              return `${base_url}/item/${id}?search=${get_name_search_val}`;
          }
          else {
              return `${base_url}/item/${id}`;
          }

       }
  },//End methods
  computed: {
      filteredCategory() {
          return this.current_categoiry.filter((cat) => cat.label.match(this.search_SubCategory));
      },
  },//End computed
});


$('#main_search_bar').keypress(function(e) {
    if(e.which == 13) {
         root.getResults();
    }
});
