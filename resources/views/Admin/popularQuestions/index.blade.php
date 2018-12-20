

@component('components.panel_default_with_blank')
    @slot('active') popularQuestions @endslot
    @slot('page_title') الاسئلةالشائعة  @endslot
    @slot('panel_title') الاسئلةالشائعة @endslot

    @slot('body')
        <div id="myVue">
          <button class="btn btn-primary btn-rounded" v-on:click="showCreateModel()">
                اضافة <i class="fa fa-plus mydir"></i>
          </button>
          <br><br>
          <div class="col-md-6 mydirection">
            {!! Form::model($User = new \App\PopularQuestions,[ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                <input type="text" name="search" class="form-control mydirection" value="{{$val??''}}" placeholder="  بحث"  >
            {!! form::close() !!}
          </div>
          <br><br><br>


            <table class="table mydir">
                <thead>
                    <th> السوال  </th>
                    <th> الايجابة  </th>
                    <th> المزيد </th>
                </thead>
                <tbody>
                  <tr v-for="list in mainList.data">
                      <td> <p v-text="list.body"></p>  </td>
                      <td> <p v-text="list.answer"></p>  </td>
                      <td>
                           <button :class="{'btn btn-rounded':true ,'btn-success':list.status ,'btn-danger':!list.status }"  v-on:click="showORhide(list.id)">
                               <i class="fa fa-eye" v-if="list.status"></i>
                               <i class="fa fa-eye-slash" v-else ></i>
                           </button>

                           <button class="btn btn-primary btn-rounded" v-on:click="showEditModel(list)" >
                              <i class="fa fa-pencil"></i>
                           </button>
                           <button type="button" class="btn btn-danger btn-rounded" v-on:click="DeleteMessage(list.id)" >
                              <i class="glyphicon glyphicon-trash"></i>
                           </button>
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
            <div class="spinner" v-if="show_spinner">
                <div class="cube1"></div>
                <div class="cube2"></div>
            </div>
            <!-- - - - - - -End spinner- - - - - - - -->

       </div><!--End myVue-->
    @endslot

    @slot('script')
        <script>
            var delete_api = '{{url('popularQuestions/delete')}}';
            var get_list = '{{url('popularQuestions/list')}}';
            var showORhide_api = '{{url('popularQuestions/showORhide_api')}}';
        </script>
        <script src="{{asset('js/popularQuestions.js')}}"> </script>
    @endslot

@endcomponent



{{-- ------------------- create ------------------------ --}}

    @component('components.modal')
        @slot('id')
          create_model
        @endslot
        @slot('header')
              اضافت جديد
        @endslot
        @slot('form_header')
            {!! Form::model( new \App\popularQuestions,['url'=>'popularQuestions','class'=>"mydirection",'id'=>'create_form'  ]) !!}
        @endslot
        @slot('body')

          <div class="form-group">
              {!! Form::label('body','السوال:') !!}
              {!! Form::text('body',null,['class'=>'form-control','required']) !!} <!-- , -->
          </div>

          <div class="form-group">
              {!! Form::label('answer','الأجابة:') !!}
              {!! Form::textarea('answer',null,['class'=>'form-control','required']) !!} <!-- , -->
          </div>

        @endslot
        @slot('submit_input')
          {!! Form::submit( 'اضافت جديد',['class'=>'btn btn-success']) !!}
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
            {!! Form::model( new \App\popularQuestions,['url'=>'popularQuestions/update','class'=>"mydirection",'id'=>'edit_form'   ]) !!}
        @endslot
        @slot('body')

          {!! Form::hidden('id',null,['id'=>'edit_id']) !!}

          <div class="form-group">
              {!! Form::label('body',null,'الصورة:') !!}
              {!! Form::text('body',null,['class'=>'form-control','required','id'=>'edit_body']) !!} <!-- , -->
          </div>

          <div class="form-group">
              {!! Form::label('answer','الأجابة:') !!}
              {!! Form::textarea('answer',null,['class'=>'form-control','required','id'=>'edit_answer']) !!} <!-- , -->
          </div>

        @endslot
        @slot('submit_input')
          {!! Form::submit( ' تعديل ',['class'=>'btn btn-success']) !!}
        @endslot
    @endcomponent
