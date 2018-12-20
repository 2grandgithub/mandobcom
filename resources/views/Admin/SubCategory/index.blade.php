

@component('components.panel_default_with_blank')
    @slot('active') SubCategory @endslot
    @slot('page_title') @lang('page.SubCategory')  @endslot
    @slot('panel_title') @lang('page.SubCategory') @endslot

    @slot('body')
        @permission('SubCategory')
        <div id="myVue">
          {!! Form::open([ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
              <div class="row">
                  <div class="col-md-6">
                    <label> @lang('page.Category') </label>
                    <v-select :options="categories_list" :name="'category_id'" v-on:s_change="category_change()" :f_item="'@lang('page.choose')'" :s_id="'category_id'"></v-select>
                  </div>
              </div><!--End row-->
              <hr>

              <section v-show="show_content">

                <button class="btn btn-primary btn-rounded" v-on:click="showCreateModel()" type="button">
                      @lang('page.create')  <i class="fa fa-plus mydir"></i>
                </button>
                <br><br>
                <div class="col-md-6 mydirection">
                      <input type="text" name="search" class="form-control mydirection"   placeholder="  بحث"  >
                </div>
            {!! form::close() !!}
            <br><br><br>


              <table class="table mydir">
                  <thead>
                      <th> @lang('page.code')  </th>
                      <th> @lang('page.logo')  </th>
                      <th> @lang('page.name_en')  </th>
                      <th> @lang('page.name_ar') </th>
                      <th> @lang('page.status') </th>
                      <th> @lang('page.more') </th>
                  </thead>
                  <tbody>
                    <tr v-for="(list,index) in mainList.data">
                        <td> <p v-text="list.id"></p>  </td>
                        <td> <img :src="list.logo" width="120px"> </td>
                        <td> <p v-text="list.name_en"></p>  </td>
                        <td> <p v-text="list.name_ar"></p>  </td>
                        <td>
                           <span class="badge badge-success"  v-if="list.status"> نعم </span>
                           <span class="badge badge-danger" v-else> لا  </span>
                        </td>
                        <td>
                             @permission('SubCategory_status')
                             <button :class="{'btn btn-rounded':true ,'btn-success':list.status ,'btn-danger':!list.status }"  v-on:click="showORhide(list.id)" type="button">
                                 <i class="fa fa-eye" v-if="list.status"></i>
                                 <i class="fa fa-eye-slash" v-else ></i>
                             </button>
                             @endpermission
                             @permission('SubCategory_edit')
                             <button class="btn btn-primary btn-rounded" v-on:click="showEditModel(list)" type="button">
                                <i class="fa fa-pencil"></i>
                             </button>
                             @endpermission
                             @permission('SubCategory_delete')
                             <button type="button" class="btn btn-danger btn-rounded" v-on:click="DeleteMessage(list.id,index)" type="button">
                                <i class="glyphicon glyphicon-trash"></i>
                             </button>
                             @endpermission
                        </td><!--end more-->
                    </tr>

                  </tbody>
              </table>

            <section>
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

            {{-- ------------------- create ------------------------ --}}

                @component('components.modal')
                    @slot('id')
                      create_model
                    @endslot
                    @slot('header')
                          اضافت جديد
                    @endslot
                    @slot('form_header')
                        {!! Form::open(['url'=>'SubCategory/create','class'=>"mydirection",'id'=>'create_form' ,'v-on:submit.prevent'=>'create()' ]) !!}
                    @endslot
                    @slot('body')

                      {!! Form::hidden('category_id',null,['id'=>'edit_id','v-model'=>'EF.category_id']) !!}

                      <div class="form-group">
                          {!! Form::label('logo','الصورة:') !!}
                          {!! Form::file('logo',['class'=>'form-control','v-on:change'=>"Preview_image_create" ,'id'=>'create_image','required' ]) !!} 
                      </div>
                      <img id="edit_img_temp" width="200px" style="min-height:100px" class="btn btn-danger btn-rounded">

                      <div class="form-group">
                          {!! Form::label('name_en',null,__('page.name_en')) !!}
                          {!! Form::text('name_en',null,['class'=>'form-control','required' ]) !!}
                      </div>
                      <div class="form-group">
                          {!! Form::label('name_ar',null,__('page.name_ar')) !!}
                          {!! Form::text('name_ar',null,['class'=>'form-control','required' ]) !!}
                      </div>

                      <!-- - - - - - -START spinner- - - - - - - -->
                      <spinner3 v-if="show_model_spinner"></spinner3>
                      <!-- - - - - - -End spinner- - - - - - - -->

                    @endslot
                    @slot('submit_input')
                      <button type="submit" class="btn btn-success" :disabled="btn_submit" >  اضافت جديد </button>
                    @endslot
                @endcomponent


            {{-- ------------------- edit ------------------------ --}}

                @component('components.modal')
                    @slot('id')
                      edit_model
                    @endslot
                    @slot('header')
                          تعديل
                    @endslot
                    @slot('form_header')
                        {!! Form::open(['url'=>'SubCategory/update','class'=>"mydirection",'id'=>'edit_form' ,'v-on:submit.prevent'=>'edit()'   ]) !!}
                    @endslot
                    @slot('body')

                      {!! Form::hidden('id',null,['id'=>'edit_id','v-model'=>'EF.id']) !!}
                      {!! Form::hidden('category_id',null,['id'=>'edit_id','v-model'=>'EF.category_id']) !!}

                      <div class="form-group">
                          {!! Form::label('logo','الصورة:') !!}
                          {!! Form::file('logo',['class'=>'form-control','v-on:change'=>"Preview_image_edit",'id'=>'edit_image' ]) !!}
                      </div>
                      <img :src="EF.logo" id="edit_img_temp" width="200px" style="min-height:100px" class="btn btn-danger btn-rounded">

                      <div class="form-group">
                          {!! Form::label('name_en',__('page.name_en')) !!}
                          {!! Form::text('name_en',null,['class'=>'form-control','required' ,'v-model'=>'EF.name_en']) !!}
                      </div>
                      <div class="form-group">
                          {!! Form::label('name_ar',__('page.name_ar')) !!}
                          {!! Form::text('name_ar',null,['class'=>'form-control','required' ,'v-model'=>'EF.name_ar']) !!}
                      </div>

                      <!-- - - - - - -START spinner- - - - - - - -->
                      <spinner3 v-if="show_model_spinner"></spinner3>
                      <!-- - - - - - -End spinner- - - - - - - -->

                    @endslot
                    @slot('submit_input')
                      <button type="submit" class="btn btn-success" :disabled="btn_submit" > تعديل </button>
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
            var delete_api = '{{url('SubCategory/delete')}}';
            var get_list = '{{url('SubCategory/list')}}';
            var showORhide_api = '{{url('SubCategory/showORhide')}}';
            var create_api = '{{url('SubCategory/create')}}';
            var update_api = '{{url('SubCategory/update')}}';
            let get_categories = JSON.parse('{!!$categories!!}');
        </script>
        <script src="{{asset('js/SubCategory.js')}}"> </script>
    @endslot

@endcomponent
