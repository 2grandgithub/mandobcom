

@component('components.panel_default_with_blank')
    @slot('active') Governorate @endslot
    @slot('page_title') @lang('page.Governorate')  @endslot
    @slot('panel_title') @lang('page.Governorate') @endslot

    @slot('body')
        @permission('Governorate')
        <div id="myVue">
          <div class="col-md-6 mydirection">
             <v-select :options="city_list" :name="'city_id'" :value="''" v-on:s_change="city_changed()" :s_id="'ddl_city'" ></v-select>
          </div>
          <br><br>

          <section v-show="show_content">

            {{-- <button class="btn btn-primary btn-rounded" v-on:click="showCreateModel()">
                  @lang('page.create')  <i class="fa fa-plus mydir"></i>
            </button>
            <br> --}}
            <br>
            <div class="col-md-6 mydirection">
              {!! Form::open([ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                  <input type="text" name="search" class="form-control mydirection" id="inp_search"  placeholder="  بحث"  >
              {!! form::close() !!}
            </div>
            <br><br><br>

            <div class="mydir">
               <span class="badge badge " style="margin:8px;font-size: 20px;padding: 5px;" v-for="(list,index) in mainList"   > @{{list}}   </span>
            </div>

            <br>

         </section><!--End section-->
            <!-- - - - - - -START spinner- - - - - - - -->
            <spinner2 v-if="show_spinner"></spinner2>
            <!-- - - - - - -End spinner- - - - - - - -->

            {{-- ------------------- create ------------------------ --}}

                {{-- @component('components.modal')
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

 --}}
            {{-- ------------------- edit ------------------------ --}}
{{--
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
                @endcomponent --}}


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
            var delete_api = '{{url('Governorate/delete')}}';
            var get_list = '{{url('Governorate/list')}}';
            var showORhide_api = '{{url('Governorate/showORhide')}}';
            var create_api = '{{url('Governorate/create')}}';
            var update_api = '{{url('Governorate/update')}}';

            let get_cities = JSON.parse('{!!$cities!!}');
        </script>
        <script src="{{asset('js/Governorate.js')}}"> </script>
    @endslot

@endcomponent
