
let root = new Vue({
  el: '#root',
  data:{
    mainList: {data:[]},
    show_spinner:true,
    view_type: 'card',
    Cats_and_subCats_list: Categories_and_subCategories_list,
    current_category_id: get_categoiry_id,
    current_categoiry: {},
    companies: [],
    search_SubCategory: '',
    search_companies: '',
    AuthBuyer_id: get_AuthBuyer_id
  },
  mounted(){

      this.current_categoiry = this.Cats_and_subCats_list.find(obj => obj.value == this.current_category_id);

      if(get_name_search_val){
        $('#main_search_bar').val(get_name_search_val);
      }
      $('#main_app_search_categoiry').val(this.current_category_id);

        this.getResults();
  },
  methods:{
       getResults(page = 1){
         this.mainList = {data:[]};
         this.show_spinner = true;

          let subCategoiry_ids = [];
          let company_ids = [];

          $('.inp_cat:checked').each(function() {
              subCategoiry_ids.push($(this).val());
          });
          $('.inp_company:checked').each(function() {
              company_ids.push($(this).val());
          });

          let search_data = {
              _token: csrf_token ,
              category_id: this.current_category_id ,
              sort: $('#sort').val(),
              paginate_no: $('#paginate_no').val(),
              subCats_ids: subCategoiry_ids,
              company_ids: company_ids,
              text: $('#main_search_bar').val(),
              price_from: $('#price_from').val(),
              price_to: $('#price_to').val(),
          };
          $.post(base_url+'/offer_list'+'?page=' + page ,search_data,(Response)=>{  console.log(Response);
              root.mainList = Response.offers;
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
                        url: `${base_url}/ShoppingCart/${this.AuthBuyer_id}/${list.offer_id}/offer`,
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
       }//End add_ShoppingCard(list)
  },//End methods
  computed: {
      filteredSubCategory() {
          return this.current_categoiry.SubCategory.filter((cat) => cat.label.match(this.search_SubCategory));
      },
      filteredcompanies() {
          return this.companies.filter((comp) => comp.name.match(this.search_companies));
      }
  }//End computed
});


$('#main_search_bar').keypress(function(e) {
    if(e.which == 13) {
         root.getResults();
    }
});
