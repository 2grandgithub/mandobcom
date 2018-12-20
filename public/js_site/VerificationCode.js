let root = new Vue({
  el: '#root',
  data:{
    up_btn_disabled: false,
    user_type: get_user_type,
    user_id: get_user_id,
    n1: '',
    n2: '',
    n3: '',
    n4: '',
  },
  mounted(){
     // $('#VerificationCode_form').validate();
  },
  methods:{
      signUp_submit()
      {
          if(this.computedCode.length == 4)
          {
              $('#VerificationCode_form').submit();
          }
          else {
            new Noty({ text: ' من فضلك ادخل الكود بشكل صحيح ', layout: 'topRight', type: 'error' , timeout:'2000'  }).show();
          }
      },
      next_input(inp){
         inp.target.nextElementSibling.focus();
      }
  },//End methods
  computed: {
      computedCode() { 
          return String(this.n1)+String(this.n2)+String(this.n3)+String(this.n4);
      },
  }//End computed
});
