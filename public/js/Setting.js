let myVue = new Vue({
    el:'#myVue',
    data:{
        // list: get_Settings,
        list: [],
        show_spinner:true,
        EF: [],
        btn_submit: false
    },
    mounted(){
        $('#create_form').validate();
        this.show_spinner = false;
        this.getResults();

        // this.vue_initMap();
    },//End mounted()
    methods:{
         getResults()
         {
              this.show_spinner = true;
              $.get(list_api ,(Response)=>{
                  myVue.list = Response;
                  this.show_spinner = false;
                  // this.vue_initMap();
              });
         },
         save()
         {
               if( $('#create_form').valid() )
               {
                     myVue.btn_submit = true;
                     myVue.show_spinner = true;
                     let my_formData = new FormData($('#create_form')[0]);
                     my_formData.append('main_page_image1_beside_slider', $('#inp_main_page_image1_beside_slider')[0].files[0]);
                     my_formData.append('main_page_image2_beside_slider', $('#inp_main_page_image2_beside_slider')[0].files[0]);
                     console.log(my_formData);
                     $.ajax({
                         type:"post",
                         url: save_api,
                         data: my_formData,
                         processData: false,
                         contentType: false,
                         success : function(responce){
                             if(responce.status == 'success') {
                                 noty({text: ' تم تعديل المحتوي', layout: 'topRight', type: 'success' });
                                 myVue.list = responce.data;
                                 // this.getResults();
                             }
                             else if(responce.status == 'notValid')
                                  noty({text: ' البيانات غير صحيحة ', layout: 'topRight', type: 'danger' });
                             myVue.show_spinner = false;
                             myVue.btn_submit = false;
                         },
                     });//End ajax
               }//End if  valid
         },
         vue_initMap()
         {
              let get_lat = this.list.callUs_lat;
              let get_lang = this.list.callUs_lng;
              var myLatlng = new google.maps.LatLng(get_lat,get_lang);
              var mapOptions = {
               zoom: 13,
               center: myLatlng
              }

              var map = new google.maps.Map(document.getElementById("google_ptm_map"), mapOptions);

              var marker = new google.maps.Marker({
                 position: myLatlng,
                 map: map,
                 draggable:true,
              });

              google.maps.event.addListener(marker, 'dragend', function(event) {
                var myLatLng = event.latLng;
                 var lat = myLatLng.lat();
                 var lng = myLatLng.lng();

                 myVue.list.callUs_lat = lat;
                 myVue.list.callUs_lng = lng;
                 // Object.assign(myVue.mainList.data.find(row => row.id == responce.id),  responce);
              });
      },
      Preview_image(e)
      {
          let from = e.currentTarget.getAttribute('data-from');
          if (e.target.files && e.target.files[0]) //Preview_image
          {
               if(from == 'main_page_image1_beside_slider') {
                   $('#Preview_main_page_image1_beside_slider').attr( 'src',URL.createObjectURL(e.target.files[0]) );
               }
               else if(from == 'main_page_image2_beside_slider') {
                   $('#Preview_main_page_image2_beside_slider').attr( 'src',URL.createObjectURL(e.target.files[0]) );
               }

          }
      },

    }//End methods
});


function initMap()
{
   myVue.vue_initMap();
}
