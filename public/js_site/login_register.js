
let root = new Vue({
  el: '#root',
  data:{
    show_spinner:false,
    Aramex_Countries: get_Aramex_Countries ,
    Country_code: '',
    Aramex_Cities: [],
    CommercialRegistrationType: [
        { label: 'مساهمة عامة محدودة' , value: 'مساهمة عامة محدودة' },
        { label: 'مساهمة خاصة محدودة' , value: 'مساهمة خاصة محدودة' },
        { label: 'ذات مسؤولية محدودة' , value: 'ذات مسؤولية محدودة' },
        { label: 'تضامن' , value: 'تضامن' },
        { label: 'توصية بسيطة' , value: 'توصية بسيطة' },
        { label: 'توصية بالأسهم' , value: 'توصية بالأسهم' },
        { label: 'عربية مشتركة' , value: 'عربية مشتركة' },
        { label: 'أجنبية فرع عامل' , value: 'أجنبية فرع عامل' },
        { label: 'اجنبية فرع غير عامل' , value: 'اجنبية فرع غير عامل' },
        { label: 'معفاة' , value: 'معفاة' },
        { label: 'لا تهدف الى ربح' , value: 'لا تهدف الى ربح' },
        { label: 'دنيه' , value: 'دنيه' },
        { label: 'استثمار مشترك' , value: 'استثمار مشترك' },
    ],
    selected_user_type: 'buyer',
    up_btn_disabled: false,
    email_exist: false,
    phone_exist: false,
  },
  mounted(){
      $('#form_signUp').validate({
        errorElement: "span",
        rules: {
            password_again: {
              equalTo: "#password"
            }}
      });
      $('#form_signIn').validate({ errorElement: "span" });


  },
  methods:{
      user_type(type)
      {
          if(type == 'buyer')
          {
            this.selected_user_type = 'buyer';
          }
          else if(type == 'company')
          {
            this.selected_user_type = 'company';
          }
      },
      signUp_submit(){
           root.email_exist = false;
           let email = $('#up_email').val().trim();
           let phone = $('#up_phone').val().trim();
           if( email.trim() != '' && phone.trim() != '')
           {
              this.up_btn_disabled = true;
              let sendData = {
                  _token: csrf_token,
                  email: email,
                  phone: phone,
                  userType: this.selected_user_type
              };
           //
              //--check For email uniqueness
              $.post(base_url+'/login_register/check_For_email',sendData,(responce)=>{
                 if(responce.status == 'The email has already been taken.'){
                    new Noty({ text: ' هذا البريد مستخدم لدينا ', layout: 'topRight', type: 'error' , timeout:'2000'  }).show();
                    root.email_exist = true;
                    window.location.hash = '#li_signup_email';
                 }
                 else if(responce.status == 'success'){
                       root.email_exist = false;

                         //--check For phone uniqueness
                       $.post(base_url+'/login_register/check_For_phone',sendData,(responce)=>{
                          if(responce.status == 'The phone has already been taken.'){
                             new Noty({ text: ' هذا الهاتف ماكد لدينا من قبل', layout: 'topRight', type: 'error' , timeout:'2000'  }).show();
                             root.phone_exist = true;
                             window.location.hash = '#li_signup_phone';
                          }
                          else if(responce.status == 'success'){
                            root.phone_exist = false;

                              if(!root.email_exist && !root.phone_exist)
                              {    console.log('if ! & !');
                                      $('#form_signUp').submit();
                                      $('#btn-submit').attr('disabled', 'disabled');
                                      root.show_spinner = true;
                                      root.up_btn_disabled = false;
                              }
                          }
                       });

                 }//if success check_For_email
                 root.up_btn_disabled = false;
              });//Ajax check_For_email


           }
      },
      CountryChanged()
      {                       console.log('Country_code '+root.Country_code);
         $.get(`${base_apis_url}/Aramex/Cities_from_country/${root.Country_code}`,(response)=>{   console.log(response); //City_list_array
              response = JSON.parse(response) ; console.log(response);
              // root.Aramex_Cities = response.Cities.string ;
              root.Aramex_Cities = response ;
             // setTimeout(function(){   $('.selectpicker').selectpicker('refresh');   }, 500);
         });
      }

  },//End methods
  computed: {
      // related_governate()
      // {
      //    let find = this.Aramex_Countries.find(gov => gov.value == this.city_id );
      //    if (find)
      //         return find.Governorate;
      //    else
      //         return [];
      // }

  }//End computed
});


$('#main_search_bar').keypress(function(e) {
    if(e.which == 13) {
         root.getResults();
    }
});
