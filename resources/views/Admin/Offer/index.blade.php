

@component('components.panel_default_with_blank')
    @slot('active') Offer @endslot
    @slot('page_title') @lang('page.Offer')  @endslot
    @slot('panel_title') @lang('page.Offer') @endslot

    @slot('body')
        @permission('Offer')
        <div id="myVue">
          <br>
          <div class="row mydirection">
            {!! Form::model($User = new \App\Offer,[ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                  <div class="col-md-3">
                      <label> @lang('page.search') </label>
                      <input type="text" name="text" class="form-control mydirection"   placeholder="  بحث"  >
                  </div>
                  <div class="col-md-3">
                      <label> @lang('page.Company') </label>
                      <v-select :options="Company_list" :name="'company_id'" v-on:s_change="getResults()" :f_item="'@lang('page.all')'"></v-select>
                  </div>
                  <div class="col-md-3">
                      <label> @lang('page.Category') </label>
                      <v-select :options="Category_list" :name="'category_id'"  v-on:s_change="getResults()" :f_item="'@lang('page.all')'"></v-select>
                  </div>
                  <div class="col-md-3">
                      <label> @lang('page.status') </label>
                      <v-select :options="accaptedByAdmin_list" :name="'accapted_by_admin'"  v-on:s_change="getResults()" :f_item="'@lang('page.all')'"></v-select>
                  </div>
            {!! form::close() !!}
          </div>
          <br><br><br>

            <table class="table mydir">
                <thead>
                    <th> @lang('page.code')  </th>
                    <th> @lang('page.image')  </th>
                    <th> @lang('page.name_en')  </th>
                    <th> @lang('page.name_ar') </th>
                    <th> @lang('page.Category') </th>
                    <th> @lang('page.Company') </th>
                    <th> @lang('page.old_price') </th>
                    <th> @lang('page.new_price') </th>
                    <th> @lang('page.amount') </th>
                    <th> @lang('page.likes') </th>
                    <th> @lang('page.views') </th>
                    <th> @lang('page.status') </th>
                    <th> @lang('page.more') </th>
                </thead>
                <tbody>
                  <tr v-for="(list,index) in mainList.data">
                      <td> <p v-text="list.id"></p>  </td>
                      <td> <img :src="list.image.split(',')[0]" width="120px"> </td>
                      <td> <p v-text="list.name_en"></p>  </td>
                      <td> <p v-text="list.name_ar"></p>  </td>
                      <td>
                          <p v-text="list.category_name"></p>
                            <i class="fa fa-arrow-down"></i>
                          <p v-text="list.sub_category_name"></p>
                      </td>
                      <td> <p v-text="list.company_name"></p>  </td>
                      <td> <p v-text="list.old_price"></p>  </td>
                      <td> <p v-text="list.new_price"></p>  </td>
                      <td> <p v-text="list.amount"></p>  </td>
                      <td> <p v-text="list.likes"></p>  </td>
                      <td> <p v-text="list.views"></p>  </td>
                      <td>
                         <span class="badge badge-success"  v-if="list.accapted_by_admin"> نعم </span>
                         <span class="badge badge-danger" v-else> لا  </span>
                      </td>
                      <td>
                           @permission('Offer_status')
                           <button :class="{'btn btn-rounded':true ,'btn-success':list.accapted_by_admin ,'btn-danger':!list.accapted_by_admin }"
                                   v-on:click="accaptance_by_admin(list.id)"   data-toggle="tooltip" title="@lang('page.accaptance_from_admin')">
                               <i class="fa fa-check-square-o" v-if="list.accapted_by_admin" ></i>
                               <i class="fa fa-square-o" v-else ></i>
                           </button>
                           @endpermission
                           <button class="btn btn-primary btn-rounded" v-on:click="showShowModel(list)" >
                              <i class="fa fa-search"></i>
                           </button>
                           @permission('Offer_delete')
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
                      <img v-for="image in SF.images" :src="image" id="edit_img_temp" width="200px" style="min-height:100px;margin:5px" class="img-thumbnail">
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
                              <th> @lang('page.old_price') </th>
                              <td v-text="SF.old_price"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.new_price') </th>
                              <td v-text="SF.new_price"> </td>
                          </tr>
                          <td>
                              <th> @lang('page.Category') </th>
                              @{{SF.category_name}}
                                  <i class="fa fa-arrow-left"></i>
                              @{{SF.sub_category_name}}
                          </td>
                          <tr>
                              <th> @lang('page.Company') </th>
                              <td v-text="SF.company_name"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.description_en') </th>
                              <td v-text="SF.description_en"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.description_ar') </th>
                              <td v-text="SF.description_ar"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.amount') </th>
                              <td v-text="SF.amount"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.likes') </th>
                              <td v-text="SF.likes"> </td>
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
            var delete_api = '{{url('Offer/delete')}}';
            var get_list = '{{url('Offer/list')}}';
            var showORhide_api = '{{url('Offer/showORhide')}}';
            var accaptanceByAdmin_api = '{{url('Offer/accaptance_by_admin')}}';
            let get_Company = JSON.parse('{!!$Company!!}');
            let get_Category = JSON.parse('{!!$Category!!}');
        </script>
        <script src="{{asset('js/Item.js')}}"> </script>
    @endslot

@endcomponent
