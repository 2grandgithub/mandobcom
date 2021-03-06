

@component('components.panel_default_with_blank')
    @slot('active') Item @endslot
    @slot('page_title') @lang('page.Item')  @endslot
    @slot('panel_title') @lang('page.Item') @endslot

    @slot('body')
       @companyPermission('Item')
        <div id="myVue">
          <button class="btn btn-primary btn-rounded" v-on:click="showCreateModel()">
                @lang('page.create')  <i class="fa fa-plus mydir"></i>
          </button>
           <hr>
          <div class="row mydirection">
            {!! Form::model($User = new \App\Item,[ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                <div class="col-md-4">
                    <label> @lang('page.search') </label>
                    <input type="text" name="text" class="form-control mydirection"   placeholder="  بحث"  >
                </div>
                <div class="col-md-4">
                    <label> @lang('page.Category') </label>
                    <v-select :options="Category_list" :name="'category_id'"  v-on:s_change="getResults()" :f_item="'@lang('page.all')'"></v-select>
                </div>
            {!! form::close() !!}
          </div>
          <br><br><br>


            <table class="table mydir">
                <thead>
                    <th> @lang('page.code')  </th>
                    <th> @lang('page.company code')  </th>
                    <th> @lang('page.image')  </th>
                    <th> @lang('page.name_en')  </th>
                    <th> @lang('page.name_ar') </th>
                    <th> @lang('page.Category') </th>
                    <th> @lang('page.price') </th>
                    <th> @lang('page.minimum_amount') </th>
                    <th> @lang('page.maximum_amount') </th>
                    <th> @lang('page.likes') </th>
                    <th> @lang('page.status') </th>
                    <th> @lang('page.more') </th>
                </thead>
                <tbody>
                  <tr v-for="(list,index) in mainList.data">
                      <td> <p v-text="list.id"></p>  </td>
                      <td> <p v-text="list.code"></p>  </td>
                      <td> <img :src="list.image.split(',')[0]" width="120px"> </td>
                      <td> <p v-text="list.name_en"></p>  </td>
                      <td> <p v-text="list.name_ar"></p>  </td>
                      <td>
                        <p v-text="list.category_name"></p>
                          <i class="fa fa-arrow-down"></i>
                        <p v-text="list.sub_category_name"></p>
                      </td>
                      <td> <p v-text="list.price"></p>  </td>
                      <td> <p v-text="list.minimum_amount"></p>  </td>
                      <td> <p v-text="list.maximum_amount"></p>  </td>
                      <td> <p v-text="list.likes"></p>  </td>
                      <td>
                         <span class="badge badge-success"  v-if="list.status"> نعم </span>
                         <span class="badge badge-danger" v-else> لا  </span>
                      </td>
                      <td>
                         @companyPermission('Item_status')
                           <button :class="{'btn btn-rounded':true ,'btn-success':list.status ,'btn-danger':!list.status }"  v-on:click="showORhide(list.id)">
                               <i class="fa fa-eye" v-if="list.status"></i>
                               <i class="fa fa-eye-slash" v-else ></i>
                           </button>
                         @endcompanyPermission
                           <button class="btn btn-primary btn-rounded" v-on:click="showShowModel(list)" >
                              <i class="fa fa-search"></i>
                           </button>
                         @companyPermission('Item_edit')
                           <button class="btn btn-primary btn-rounded" v-on:click="showEditModel(list)" >
                              <i class="fa fa-pencil"></i>
                           </button>
                         @endcompanyPermission
                         @companyPermission('Item_Delete')
                           <button type="button" class="btn btn-danger btn-rounded" v-on:click="DeleteMessage(list.id,index)" >
                              <i class="glyphicon glyphicon-trash"></i>
                           </button>
                         @endcompanyPermission
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

                @component('components.modal_lg')
                    @slot('id')
                      create_model
                    @endslot
                    @slot('header')
                        @lang('page.add new')
                    @endslot
                    @slot('form_header')
                        {!! Form::open([ 'class'=>"mydirection",'id'=>'create_form' ,'v-on:submit.prevent'=>'create()' ]) !!}
                    @endslot
                    @slot('body')

                      <div class="form-group">
                          {!! Form::label('image',__('page.images')) !!} 600px*600px
                          {!! Form::file('image[]',['class'=>'form-control','v-on:change'=>"Preview_image_create" ,'id'=>'create_image','multiple' ,'required']) !!}
                      </div>
                         <div id="Preview_create_images"> </div>
                      <br>
                      <hr>
                      <div class="row">
                          <div class="col-md-6">
                                <div class="form-group">
                                    <label> @lang('page.Category') </label>
                                    <v-select :options="Category_list" :name="'category_id'" :f_item="'@lang('page.all')'" v-on:s_change="Category_change('create')" :required='true' :s_id="'category_id'" ></v-select><!--:required='true'-->
                                </div>
                                <div class="form-group" v-show="subCategory_list.length>0">
                                    <label> @lang('page.SubCategory') </label>
                                    <v-select :options="subCategory_list" :name="'sub_category_id'" :f_item="'@lang('page.all')'" :required='true' ></v-select><!--:required='true'-->
                                </div>
                                <div class="form-group">
                                    {!! Form::label('code',__('page.company code')) !!}
                                    {!! Form::text('code',null,['class'=>'form-control','required' ]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name_en',__('page.name_en')) !!}
                                    {!! Form::text('name_en',null,['class'=>'form-control','required' ]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name_ar',__('page.name_ar')) !!}
                                    {!! Form::text('name_ar',null,['class'=>'form-control','required' ]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('price',__('page.price')) !!}
                                    {!! Form::number('price',null,['class'=>'form-control','required' ,'step'=>'0.01']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('minimum_amount',__('page.minimum_amount')) !!}
                                    {!! Form::number('minimum_amount',null,['class'=>'form-control','required'  ]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('maximum_amount',__('page.maximum_amount')) !!}
                                    {!! Form::number('maximum_amount',null,['class'=>'form-control','required'  ]) !!}
                                </div>
                          </div><!--End col-md-6-->
                          <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('description_en',__('page.description_en')) !!}
                                    {!! Form::textarea('description_en',null,['class'=>'form-control','required','rows'=>'8'  ]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description_ar',__('page.description_ar')) !!}
                                    {!! Form::textarea('description_ar',null,['class'=>'form-control','required','rows'=>'8'  ]) !!}
                                </div>
                          </div><!--End col-md-6-->
                      </div><!--End row-->

                    @endslot
                    @slot('submit_input')
                      <button type="submit" class="btn btn-success" :disabled="btn_submit" >  @lang('page.add new') </button>
                    @endslot
                @endcomponent

            {{-- ------------------- edit ------------------------ --}}

                @component('components.modal_lg')
                    @slot('id')
                      edit_model
                    @endslot
                    @slot('header')
                        @lang('page.edit')
                    @endslot
                    @slot('form_header')
                        {!! Form::open([ 'class'=>"mydirection",'id'=>'edit_form' ,'v-on:submit.prevent'=>'edit()'  ]) !!}
                    @endslot
                    @slot('body')

                      {!! Form::hidden('id',null,['id'=>'edit_id',':value'=>'EF.id']) !!}

                      <div class="form-group">
                          {!! Form::label('image',__('page.images')) !!} 600px*600px
                          {!! Form::file('image[]',['class'=>'form-control','v-on:change'=>"Preview_image_edit" ,'id'=>'edit_image','multiple'  ]) !!}
                      </div>
                          <div id="Preview_image_edit"></div>
                          <div v-if="EF.image">
                            <img v-for="img in EF.image.split(',')" :src="img" width="200px" style="min-height:100px" class="img-thumbnail">
                          </div>

                      <br>
                      <hr>
                      <div class="row">
                          <div class="col-md-6">
                                <div class="form-group">
                                    <label> @lang('page.Category') </label>
                                    <v-select :options="Category_list" :name="'category_id'" :value="EF.category_id" :f_item="'@lang('page.all')'" :required='true' :readonly='true' v-on:s_change="Category_change('edit')" :s_id="'edit_category_id'"></v-select><!--:required='true'-->
                                </div>
                                <div class="form-group" v-show="subCategory_list.length>0">
                                    <label> @lang('page.SubCategory') </label>
                                    <v-select :options="subCategory_list" :name="'sub_category_id'" :f_item="'@lang('page.all')'" :value="EF.sub_category_id" :required='true' :s_id="'edit_subCategory_id'"></v-select><!--:required='true'-->
                                </div>
                                <div class="form-group">
                                    {!! Form::label('code',__('page.company code')) !!}
                                    {!! Form::text('code',null,['class'=>'form-control','required' ]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name_en',__('page.name_en')) !!}
                                    {!! Form::text('name_en',null,['class'=>'form-control','required' ,':value'=>'EF.name_en' ]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name_ar',__('page.name_ar')) !!}
                                    {!! Form::text('name_ar',null,['class'=>'form-control','required' ,':value'=>'EF.name_ar' ]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('price',__('page.price')) !!}
                                    {!! Form::number('price',null,['class'=>'form-control','required' ,'step'=>'0.01' ,':value'=>'EF.price' ]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('minimum_amount',__('page.minimum_amount')) !!}
                                    {!! Form::number('minimum_amount',null,['class'=>'form-control','required' ,':value'=>'EF.minimum_amount' ]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('maximum_amount',__('page.maximum_amount')) !!}
                                    {!! Form::number('maximum_amount',null,['class'=>'form-control','required' ,':value'=>'EF.maximum_amount' ]) !!}
                                </div>
                          </div><!--End col-md-6-->
                          <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('description_en',__('page.description_en')) !!}
                                    {!! Form::textarea('description_en',null,['class'=>'form-control','required','rows'=>'8' ,':value'=>'EF.description_en' ]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description_ar',__('page.description_ar')) !!}
                                    {!! Form::textarea('description_ar',null,['class'=>'form-control','required','rows'=>'8' ,':value'=>'EF.description_ar' ]) !!}
                                </div>
                          </div><!--End col-md-6-->
                      </div><!--End row-->

                    @endslot
                    @slot('submit_input')
                        <button type="submit" class="btn btn-success" :disabled="btn_submit" >  @lang('page.edit') </button>
                    @endslot
                @endcomponent

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
                              <th> @lang('page.price') </th>
                              <td v-text="SF.price"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.Category') </th>
                              <td>
                                  @{{SF.category_name}}
                                      <i class="fa fa-arrow-left"></i>
                                  @{{SF.sub_category_name}}
                              </td>
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
                              <th> @lang('page.minimum_amount') </th>
                              <td v-text="SF.minimum_amount"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.maximum_amount') </th>
                              <td v-text="SF.maximum_amount"> </td>
                          </tr>
                          <tr>
                              <th> @lang('page.likes') </th>
                              <td v-text="SF.likes"> </td>
                          </tr>
                      </table>
                    @endslot
                @endcomponent


       </div><!--End myVue-->
@endcompanyPermission

    @endslot

    @slot('script')
        <script>
            var delete_api = '{{url('Company/Item/delete')}}';
            var get_list = '{{url('Company/Item/list')}}';
            var showORhide_api = '{{url('Company/Item/showORhide')}}';
            let create_api = '{{url('Company/Item/create')}}';
            let update_api = '{{url('Company/Item/edit')}}';
            let get_Category = JSON.parse('{!!$Category!!}');
        </script>
        <script src="{{asset('js_company/Item.js')}}"> </script>
    @endslot

@endcomponent
