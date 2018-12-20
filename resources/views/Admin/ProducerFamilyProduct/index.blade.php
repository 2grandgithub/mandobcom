

@component('components.panel_default_with_blank')
    @slot('active') ProducerFamilyProduct @endslot
    @slot('page_title') @lang('page.ProducerFamilyProduct')  @endslot
    @slot('panel_title') @lang('page.ProducerFamilyProduct') @endslot

    @slot('body')
        <div id="myVue">
          @permission('ProducerFamilyProduct')
          <br>
          <div class="col-md-6 mydirection">
            {!! Form::model($User = new \App\ProducerFamilyProduct,[ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                    <label> @lang('page.search') </label>
                    <input type="text" name="text" class="form-control mydirection"   placeholder="  بحث"  >
            {!! form::close() !!}
          </div>
          <br><br><br>


            <table class="table mydir">
                <thead>
                    <th> @lang('page.code')  </th>
                    <th> @lang('page.image')  </th>
                    <th> @lang('page.name_en')  </th>
                    <th> @lang('page.name_ar') </th>
                    <th> @lang('page.family') </th>
                    <th> @lang('page.price') </th>
                    {{-- <th> @lang('page.description_ar') </th>
                    <th> @lang('page.description_en') </th> --}}
                    <th> @lang('page.status') </th>
                    <th> @lang('page.more') </th>
                </thead>
                <tbody>
                  <tr v-for="(list,index) in mainList.data">
                      <td> <p v-text="list.id"></p>  </td>
                      <td> <img :src="list.image" width="120px"> </td>
                      <td> <p v-text="list.name_en"></p>  </td>
                      <td> <p v-text="list.name_ar"></p>  </td>
                      <td> <p v-text="list.family"></p>  </td>
                      <td> <p v-text="list.price"></p>  </td>
                      {{-- <td> <p v-text="list.descraption_ar"></p>  </td>
                      <td> <p v-text="list.descraption_en"></p>  </td> --}}
                      <td>
                         <span class="badge badge-success"  v-if="list.status"> نعم </span>
                         <span class="badge badge-danger" v-else> لا  </span>
                      </td>
                      <td>
                           @permission('ProducerFamilyProduct_status')
                           <button :class="{'btn btn-rounded':true ,'btn-success':list.status ,'btn-danger':!list.status }"  v-on:click="showORhide(list.id)">
                               <i class="fa fa-eye" v-if="list.status"></i>
                               <i class="fa fa-eye-slash" v-else ></i>
                           </button>
                           @endpermission
                           <button class="btn btn-primary btn-rounded" v-on:click="showShowModel(list)" >
                              <i class="fa fa-search"></i>
                           </button>
                           @permission('ProducerFamilyProduct_delete')
                           <button type="button" class="btn btn-danger btn-rounded" v-on:click="DeleteMessage(list.id,index)" >
                              <i class="glyphicon glyphicon-trash"></i>
                           </button>
                           @endpermission
                      </td><!--end more-->
                  </tr>

                </tbody>
            </table>

            <!-- - - - - - -START paginate- - - - - - - -->
            <div class="row">
                  <div class="col-md-8 col-md-offset-5">
                        <pagination :data="mainList" v-on:pagination-change-page="getResults" > <!-- the_mainList -->
                            <span slot="prev-nav">&lt; السابق </span>
                            <span slot="next-nav"> التالي &gt;</span>
                        </pagination>
                  </div>
            </div><!--End row-->
            <!-- - - - - - -End paginate- - - - - - - -->
            <br>
            <!-- - - - - - -START spinner- - - - - - - -->
            <spinner2 v-if="show_spinner"></spinner2>
            <!-- - - - - - -End spinner- - - - - - - -->

            {{-- ------------------- show ------------------------ --}}

                @component('components.modal')
                    @slot('id')
                      show_model
                    @endslot
                    @slot('header')
                          @lang('page.view')
                    @endslot
                    @slot('body')
                      <img :src="SF.image" id="edit_img_temp" width="200px" style="min-height:100px;margin:5px" class="img-thumbnail">
                      <hr>
                      <table class="table mydir">
                          <tr>
                              <th> @lang('page.code') </th>
                              <td v-text="SF.id"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.name_en') </th>
                              <td v-text="SF.name_en"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.name_ar') </th>
                              <td v-text="SF.name_ar"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.family') </th>
                              <td v-text="SF.family"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.price') </th>
                              <td v-text="SF.price"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.description_en') </th>
                              <td v-text="SF.descraption_en"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.description_ar') </th>
                              <td v-text="SF.descraption_ar"> </td>
                          </tr>
                      </table>
                    @endslot
                @endcomponent


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
            var delete_api = '{{url('ProducerFamilyProduct/delete')}}';
            var get_list = '{{url('ProducerFamilyProduct/list')}}';
            var showORhide_api = '{{url('ProducerFamilyProduct/showORhide')}}';
        </script>
        <script src="{{asset('js/ProducerFamilyProduct.js')}}"> </script>
    @endslot

@endcomponent
