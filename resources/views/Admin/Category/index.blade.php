

@component('components.panel_default_with_blank')
    @slot('active') Category @endslot
    @slot('page_title') @lang('page.Category')  @endslot
    @slot('panel_title') @lang('page.Category') @endslot

    @slot('body')
        @permission('Category')
        <div id="myVue">
          <button class="btn btn-primary btn-rounded" v-on:click="showCreateModel()">
                @lang('page.create')  <i class="fa fa-plus mydir"></i>
          </button>
          <br><br>
          <div class="col-md-6 mydirection">
            {!! Form::model($User = new \App\Category,[ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                <input type="text" name="search" class="form-control mydirection"   placeholder="  بحث"  >
            {!! form::close() !!}
          </div>
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
                           @permission('Category_status')
                           <button :class="{'btn btn-rounded':true ,'btn-success':list.status ,'btn-danger':!list.status }"  v-on:click="showORhide(list.id)">
                               <i class="fa fa-eye" v-if="list.status"></i>
                               <i class="fa fa-eye-slash" v-else ></i>
                           </button>
                           @endpermission
                           @permission('Category_edit')
                           <button class="btn btn-primary btn-rounded" v-on:click="showEditModel(list)" >
                              <i class="fa fa-pencil"></i>
                           </button>
                           @endpermission
                           @permission('Category_delete')
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

            {{-- ------------------- create ------------------------ --}}

                @component('components.modal')
                    @slot('id')
                      create_model
                    @endslot
                    @slot('header')
                          اضافت جديد
                    @endslot
                    @slot('form_header')
                        {!! Form::model( new \App\Category,['url'=>'Category/create','class'=>"mydirection",'id'=>'create_form' ,'v-on:submit.prevent'=>'create()' ]) !!}
                    @endslot
                    @slot('body')

                      <div class="form-group">
                          {!! Form::label('logo','الصورة:') !!}
                                                            480px*634px
                          {!! Form::file('logo',['class'=>'form-control','onchange'=>"change_image(this)" ,'id'=>'create_image','required' ]) !!}
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
                        {!! Form::model( new \App\Category,['url'=>'Category/update','class'=>"mydirection",'id'=>'edit_form' ,'v-on:submit.prevent'=>'edit()'   ]) !!}
                    @endslot
                    @slot('body')

                      {!! Form::hidden('id',null,['id'=>'edit_id','v-model'=>'EF.id']) !!}

                      <div class="form-group">
                          {!! Form::label('logo','الصورة:') !!}
                                                               480px*634px
                          {!! Form::file('logo',['class'=>'form-control','onchange'=>"change_image(this)",'id'=>'edit_image' ]) !!}
                      </div>
                      <img :src="EF.logo" id="edit_img_temp" width="200px" style="min-height:100px" class="btn btn-danger btn-rounded">

                      <div class="form-group">
                          {!! Form::label('name_en',null,__('page.name_en')) !!}
                          {!! Form::text('name_en',null,['class'=>'form-control','required' ,'v-model'=>'EF.name_en']) !!}
                      </div>
                      <div class="form-group">
                          {!! Form::label('name_ar',null,__('page.name_ar')) !!}
                          {!! Form::text('name_ar',null,['class'=>'form-control','required' ,'v-model'=>'EF.name_ar']) !!}
                      </div>

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
            var delete_api = '{{url('Category/delete')}}';
            var get_list = '{{url('Category/list')}}';
            var showORhide_api = '{{url('Category/showORhide')}}';
            var create_api = '{{url('Category/create')}}';
            var update_api = '{{url('Category/update')}}';
        </script>
        <script src="{{asset('js/Category.js')}}"> </script>
    @endslot

@endcomponent
