@component('components.panel_default_with_blank')
    @slot('active') Setting @endslot
    @slot('page_title') @lang('page.Setting')  @endslot
    @slot('panel_title') @lang('page.Setting') @endslot

    @slot('body')
        @permission('Setting')
        <div id="myVue">
          <br>
          {!! Form::open([ 'id'=>'create_form', 'v-on:submit.prevent'=>'save()','files'=>true]) !!}



          {{--    <h2> <center> معلومات </center>  </h2>
             <div class="row">
                 <div class="col-md-6">
                     <label> اعلان عند اضافت طلب امتلاء الحاوية </label>
                     <input type="file" class="form-control" name="advertising_for_recycables_whenfull_requests" id="v1">
                     <br>
                     <video width="320" height="240" controls>
                              <source :src="'{{asset('images/adverting')}}/'+list.advertising_for_recycables_whenfull_requests" type="video/mp4">
                              <source :src="'{{asset('images/adverting')}}/'+list.advertising_for_recycables_whenfull_requests" type="video/ogg">
                              Your browser does not support the video tag.
                     </video>

                 </div><!--End col-md-6 -->
                 <div class="col-md-6">
                     <label> اعلان عند اضافت منتج اسر منتجة </label>
                     <input type="file" class="form-control" name="advertising_for_add_producer_family_product" id="v2">
                     <br>
                     <video width="320" height="240" controls>
                              <source :src="'{{asset('images/adverting')}}/'+list.advertising_for_add_producer_family_product" type="video/mp4">
                              <source :src="'{{asset('images/adverting')}}/'+list.advertising_for_add_producer_family_product" type="video/ogg">
                              Your browser does not support the video tag.
                     </video>
                 </div><!--End col-md-6 -->
             </div><!--End row-->
             <hr>--}}
             <h2> <center> عنا </center>  </h2>
             <div class="row">
                 <div class="col-md-6">
                     <label>  عنوان عنا بالانجلزية </label>
                     <input type="text" class="form-control" name="about_us_title_en" :value="list.about_us_title_en">
                     <br>
                     <label>  عنوان عنا بالعربية</label>
                     <input type="text" class="form-control" name="about_us_title_ar" :value="list.about_us_title_ar">

                 </div><!--End col-md-6 -->
                 <div class="col-md-6">
                   <label>  عنوان عنا بالانجلزية</label>
                   <textarea rows="9" class="form-control" name="about_us_details_en" cols="80"> @{{list.about_us_details_en}} </textarea>
                   <br>
                   <label>  عنوان عنا بالعربية</label>
                   <textarea rows="9" class="form-control" name="about_us_details_ar" cols="80"> @{{list.about_us_details_ar}} </textarea>
                 </div><!--End col-md-6 -->
             </div><!--End row-->
             <hr>
              <h2> <center> معلومات </center>  </h2>
              <div class="row">
                  <div class="col-md-6">
                      <label> عنوانا بالانجلزية </label>
                      <input type="text" class="form-control" name="our_address_en" :value="list.our_address_en">
                      <br>
                      <label>  عنوانا بالعربية</label>
                      <input type="text" class="form-control" name="our_address_ar" :value="list.our_address_ar">

                  </div><!--End col-md-6 -->
                  <div class="col-md-6">
                    <label>  هاتفنا  </label>
                    <input rows="9" class="form-control" name="our_phone" :value="list.our_phone" >
                    <br>
                    <label>  البريد </label>
                    <input rows="9" class="form-control" name="our_email" :value="list.our_email" >
                  </div><!--End col-md-6 -->
              </div><!--End row-->
             <hr>
              <h2> <center> التواصل الاجتماعي </center>  </h2>
              <div class="row">
                  <div class="col-md-6">
                      <label> facebook </label>
                      <input type="text" class="form-control" name="facebook" :value="list.facebook">
                      <br>
                      <label> twitter </label>
                      <input type="text" class="form-control" name="twitter" :value="list.twitter">

                  </div><!--End col-md-6 -->
                  <div class="col-md-6">
                    <label>  linkedin  </label>
                    <input rows="9" class="form-control" name="linkedin" :value="list.linkedin" >
                    <br>
                    <label>  instagram </label>
                    <input rows="9" class="form-control" name="instagram" :value="list.instagram" >
                  </div><!--End col-md-6 -->
              </div><!--End row-->

              <h2> <center> صور الصفحة الرئسية بجانب  </center>  </h2>
              <div class="row">
                  <div class="col-md-6">
                      <label> في الاعلي </label> <br>
                      <img :src="'{{url('images/ads')}}/'+list.main_page_image1_beside_slider" id="Preview_main_page_image1_beside_slider" width="300px" >
                      <input type="file" name="main_page_image1_beside_slider" data-from="main_page_image1_beside_slider" v-on:change="Preview_image($event)" id="inp_main_page_image1_beside_slider" class="form-control" >
                  </div><!--End col-md-6 -->
                  <div class="col-md-6">
                      <label>  في الاسفل  </label><br>
                      <img :src="'{{url('images/ads')}}/'+list.main_page_image2_beside_slider" id="Preview_main_page_image2_beside_slider" width="300px" >
                      <input type="file" name="main_page_image2_beside_slider" data-from="main_page_image2_beside_slider" v-on:change="Preview_image($event)" id="inp_main_page_image2_beside_slider" class="form-control" >
                  </div><!--End col-md-6 -->
              </div><!--End row-->


             <!-- - - - - - -START spinner- - - - - - - -->
             <spinner2 v-if="show_spinner"></spinner2>
             <!-- - - - - - -End spinner- - - - - - - -->
   <br><br>

             {!! Form::submit(__('page.edit'),['class'=>'btn btn-success ','style'=>'width:100%',':disabled'=>'btn_submit']) !!}

             <br><br>
           {!! Form::close() !!}

       </div><!--End myVue-->

     @else <!--IF don't have a permission --->
         <br><br>
         <div class="container">
             <h2> ليس لديك الصلاحية </h2>
         </div>
     @endpermission

    @endslot

    @slot('script')
        <script>
            let list_api = '{{url('Setting/list')}}';
            let save_api = '{{url('Setting/save')}}';
        </script>
        <script src="{{asset('js/Setting.js')}}"> </script>

        {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALsQCIjTvYTkx4BXABnxaW-J06RCJPWdM&callback=initMap" async defer></script> --}}

    @endslot

@endcomponent
