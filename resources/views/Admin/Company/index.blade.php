

@component('components.panel_default_with_blank')
    @slot('active') Company @endslot
    @slot('page_title') @lang('page.Company')  @endslot
    @slot('panel_title') @lang('page.Company') @endslot

    @slot('body')
       @permission('Company')
        <div id="myVue">
           <br>
          <div class="row mydirection">
            {!! Form::model($User = new \App\Company,[ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                <div class="col-md-6">
                    <label> @lang('page.search') </label>
                    <input type="text" name="search" class="form-control mydirection" placeholder="  بحث "  >
                </div>
                <div class="col-md-6">
                  <label> @lang('page.status') </label>
                  <v-select :options="accaptance_list" :name="'accaptance'" v-on:s_change="getResults()" :f_item="'@lang('page.all')'"></v-select>
                </div>
            {!! form::close() !!}
          </div>
          <br><br><br>

            <table class="table mydir">
                <thead>
                    <th> @lang('page.code')  </th>
                    <th> @lang('page.logo')  </th>
                    <th> @lang('page.name_en')  </th>
                    <th> @lang('page.name_ar') </th>
                    <th> @lang('page.type') </th>
                    <th> @lang('page.full_location') </th>
                    <th> @lang('page.status') </th>
                    <th> @lang('page.more') </th>
                </thead>
                <tbody>
                  <tr v-for="(list,index) in mainList.data">
                      <td> <p v-text="list.id"></p>  </td>
                      <td> <img :src="list.logo" width="120px"> </td>
                      <td> <p v-text="list.name_en"></p>  </td>
                      <td> <p v-text="list.name_ar"></p>  </td>
                      <td> <p v-text="list.type"></p>  </td>
                      <td>
                           <p>
                             <span> @{{list.full_location}} </span> <br>
                             <span v-if="list.street">  @lang('page.street'): @{{list.street}}  </span>  <br>
                             <span v-if="list.building_no">  @lang('page.building_no'): @{{list.building_no}}  </span>  <br>
                           </p>
                      </td>
                      <td>
                         <span class="badge badge-success"  v-if="list.status"> نعم </span>
                         <span class="badge badge-danger" v-else> لا  </span>
                      </td>
                      <td>
                           @permission('Company_status')
                           <button :class="{'btn btn-rounded':true ,'btn-success':list.status ,'btn-danger':!list.status }"
                                   v-on:click="showORhide(list.id)" data-toggle="tooltip" title="@lang('page.status')">
                               <i class="fa fa-eye" v-if="list.status"></i>
                               <i class="fa fa-eye-slash" v-else ></i>
                           </button>
                           @endpermission
                           @permission('Company_accapt')
                           <button :class="{'btn btn-rounded':true ,'btn-success':list.is_accapted_by_admin ,'btn-danger':!list.is_accapted_by_admin }"
                                   :disabled="list.is_accapted_by_admin==1"  v-on:click="accaptedORunAccapted(list.id)" data-toggle="tooltip" title="@lang('page.accaptance_from_admin')">
                               <i class="fa fa-check-square-o" v-if="list.is_accapted_by_admin" ></i>
                               <i class="fa fa-square-o" v-else ></i>
                           </button>
                           @endpermission
                           <button class="btn btn-primary btn-rounded" v-on:click="showShowModel(list)" >
                               <i class="fa fa-search"></i>
                           </button>
                           @permission('Company_delete')
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
                      <img :src="SF.logo" id="edit_img_temp" width="200px" style="min-height:100px" class="btn btn-danger btn-rounded">

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
                              <th> @lang('page.email') </th>
                              <td v-text="SF.email"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.type') </th>
                              <td v-text="SF.type"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.full_location') </th>
                              <td v-text="SF.full_location">
                                    <span> @{{SF.full_location}} </span> <br>
                                    <span v-if="SF.street">  @lang('page.street'): @{{SF.street}}  </span>  <br>
                                    <span v-if="SF.building_no">  @lang('page.building_no'): @{{SF.building_no}}  </span>  <br>
                              </td>
                          </tr>
                          <tr>
                              <th> @lang('page.zip_code') </th>
                              <td v-text="SF.zip_code"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.phone') </th>
                              <td v-text="SF.phone"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.CommercialRegistrationNo') </th>
                              <td v-text="SF.CommercialRegistrationNo"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.CommercialRegistrationType') </th>
                              <td v-text="SF.CommercialRegistrationType"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.TypeOfCompanyActivity') </th>
                              <td v-text="SF.TypeOfCompanyActivity"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.employees_no') </th>
                              <td v-text="SF.employees_no"> </td>
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
            var delete_api = '{{url('Company/delete')}}';
            var get_list = '{{url('Company/list')}}';
            var showORhide_api = '{{url('Company/showORhide')}}';
            var accaptedORunAccapted_api = '{{url('Company/accaptedORunAccapted')}}';
            var create_api = '{{url('Company/create')}}';
            var update_api = '{{url('Company/update')}}';
        </script>
        <script src="{{asset('js/Company.js')}}"> </script>
    @endslot

@endcomponent
