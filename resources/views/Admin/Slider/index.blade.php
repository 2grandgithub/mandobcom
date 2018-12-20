

@component('components.panel_default_with_blank')
    @slot('active') Slider @endslot
    @slot('page_title') @lang('page.Slider')  @endslot
    @slot('panel_title') @lang('page.Slider') @endslot

    @slot('body')
        @permission('Slider')
        <div id="myVue">
           <button class="btn btn-primary btn-rounded" v-on:click="showCreateModel()">
                @lang('page.create')  <i class="fa fa-plus mydir"></i>
          </button>
          <br> <br>

            <table class="table mydir">
                <tr>
                  @foreach ($Sliders as $key => $Slider)
                    <tr>
                      <th> @lang('page.ads_site_home_fullWidth')  </th>
                      <td> <img src="{{$Slider->image}}" width="800px" alt=""> </td>
                      <td>
                          @permission('Slider_edit')
                          <br><br>
                          <button class="btn btn-primary btn-rounded" v-on:click="showEditModel('{{$Slider->id}}',
                                                                                '{{$Slider->image}}','{{$Slider->link}}' )" >
                             <i class="fa fa-pencil"></i>
                          </button>
                          @endpermission
                          <br><br>
                          <button type="button" class="btn btn-danger btn-rounded" v-on:click="DeleteMessage('{{$Slider->id}}')" >
                            <i class="glyphicon glyphicon-trash"></i>
                         </button>
                      </td>
                    </tr>
                  @endforeach
                </tr>
            </table>

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
                          تعديل
                    @endslot
                    @slot('form_header')
                        {!! Form::open(['url'=>'Slider/create','class'=>"mydirection",'id'=>'create_form' ,'files'=>true ]) !!}
                    @endslot
                    @slot('body')

                      <div class="form-group">
                          {!! Form::label('image','الصورة:') !!}
                          {!! Form::file('image',['class'=>'form-control' ,'id'=>'create_image','v-on:change'=>'Preview_image_create($event)']) !!}
                      </div>
                      <img :src="EF.image" id="create_img_temp" width="550px" style="min-height:100px" class="btn btn-danger btn-rounded">

                      <div class="form-group">
                          {!! Form::label('link',__('page.link')) !!}
                          {!! Form::text('link',null,['class'=>'form-control','required'  ]) !!}
                      </div>

                    @endslot
                    @slot('submit_input')
                      <button type="submit" class="btn btn-success" :disabled="btn_submit" > اضافة </button>
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
                        {!! Form::open(['url'=>'Slider/update','class'=>"mydirection",'id'=>'edit_form' ,'files'=>true ]) !!}
                    @endslot
                    @slot('body')

                      {!! Form::hidden('id',null,['id'=>'edit_id','v-model'=>'EF.id']) !!}

                      <div class="form-group">
                          {!! Form::label('image','الصورة:') !!}
                          {!! Form::file('image',['class'=>'form-control' ,'id'=>'edit_image','v-on:change'=>'Preview_image($event)']) !!}
                      </div>
                      <img :src="EF.image" id="edit_img_temp" width="550px" style="min-height:100px" class="btn btn-danger btn-rounded">

                      <div class="form-group">
                          {!! Form::label('link',__('page.link')) !!}
                          {!! Form::text('link',null,['class'=>'form-control','required' ,':value'=>'EF.link']) !!}
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
            var showORhide_api = '{{url('Slider/showORhide')}}';
            var delete_api = '{{url('Slider/delete')}}';

            let myVue = new Vue({
                el:'#myVue',
                data:{
                    show_spinner:true,
                    EF: {}, //Edit Form
                    btn_submit: false
                },
                mounted(){
                    this.show_spinner = false;
                    $('#edit_form').validate();
                },//End mounted()
                methods:{
                     showEditModel(id,image,link){
                          this.EF = {
                              id: id,
                              image: image,
                              link: link
                            };
                            $('#edit_model').modal('show');
                     },
                     showCreateModel( ){
                            $('#create_model').modal('show');
                     },
                     Preview_image(e)
                     {
                          if (e.target.files && e.target.files[0]) {
                            $('#edit_img_temp').attr('src',URL.createObjectURL(e.target.files[0]) );
                          }
                     },
                     Preview_image_create(e)
                     {
                          if (e.target.files && e.target.files[0]) {
                            $('#create_img_temp').attr('src',URL.createObjectURL(e.target.files[0]) );
                          }
                     },
                     showORhide(id){
                         $.get(showORhide_api+'/'+id ,(responce)=>{
                           let find = myVue.mainList.data.find(obj => obj.id == id);
                              find.status = responce.case;
                         });
                     },
                     DeleteMessage(id ){
                          showDeleteMessage(id,delete_api+'/'+id).then(()=>{
                              // myVue.mainList.data.splice(index,1);
                              location.reload();
                          });
                     },
                }//End methods
            });



        </script>
        {{-- <script src="{{asset('js/Category.js')}}"> </script> --}}
    @endslot

@endcomponent
