

@component('components.panel_default_with_blank')
    @slot('active') Advertising @endslot
    @slot('page_title') @lang('page.Advertising')  @endslot
    @slot('panel_title') @lang('page.Advertising') @endslot

    @slot('body')
        @permission('Advertising')
        <div id="myVue">

          <br>

            <table class="table mydir">
              <tr>
                <th> @lang('page.ads_site_home_fullWidth')  </th>
                <td> <img src="{{asset('images/ads/'.$adverting['ads_site_home_fullWidth'])}}" width="800px" alt=""> </td>
                <td>
                    @permission('Advertising_edit')
                    <button class="btn btn-primary btn-rounded" v-on:click="showEditModel('ads_site_home_fullWidth',
                                                                          '{{$adverting['ads_site_home_fullWidth']}}',
                                                                          '{{$adverting['ads_site_home_fullWidth_link']}}' )" >
                       <i class="fa fa-pencil"></i>
                    </button>
                    @endpermission
                </td>
              </tr>
              <tr>
                <th> @lang('page.ads_site_home_halfWidth_1')  </th>
                <td> <img src="{{asset('images/ads/'.$adverting['ads_site_home_halfWidth_1'])}}" width="800px" alt=""> </td>
                <td>
                    @permission('Advertising_edit')
                    <button class="btn btn-primary btn-rounded" v-on:click="showEditModel('ads_site_home_halfWidth_1',
                                                                          '{{$adverting['ads_site_home_halfWidth_1']}}',
                                                                          '{{$adverting['ads_site_home_halfWidth_1_link']}}' )" >
                       <i class="fa fa-pencil"></i>
                    </button>
                    @endpermission
                </td>
              </tr>
              <tr>
                <th> @lang('page.ads_site_home_halfWidth_2')  </th>
                <td> <img src="{{asset('images/ads/'.$adverting['ads_site_home_halfWidth_2'])}}" width="800px" alt=""> </td>
                <td>
                    @permission('Advertising_edit')
                    <button class="btn btn-primary btn-rounded" v-on:click="showEditModel('ads_site_home_halfWidth_2',
                                                                          '{{$adverting['ads_site_home_halfWidth_2']}}',
                                                                          '{{$adverting['ads_site_home_halfWidth_2_link']}}' )" >
                       <i class="fa fa-pencil"></i>
                    </button>
                    @endpermission
                </td>
              </tr>

         
            </table>

            <br>
            <!-- - - - - - -START spinner- - - - - - - -->
            <spinner2 v-if="show_spinner"></spinner2>
            <!-- - - - - - -End spinner- - - - - - - -->

            {{-- ------------------- edit ------------------------ --}}

                @component('components.modal')
                    @slot('id')
                      edit_model
                    @endslot
                    @slot('header')
                          تعديل
                    @endslot
                    @slot('form_header')
                        {!! Form::open(['url'=>'Advertising/update','class'=>"mydirection",'id'=>'edit_form' ,'files'=>true ]) !!}
                    @endslot
                    @slot('body')

                      {!! Form::hidden('name',null,['id'=>'edit_id','v-model'=>'EF.name']) !!}

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
            var get_list = JSON.parse('{!!$adverting!!}');
            var update_api = '{{url('Category/update')}}';
            let image_url = '{{asset('images/ads')}}';

            let myVue = new Vue({
                el:'#myVue',
                data:{
                    mainList: get_list,
                    show_spinner:true,
                    EF: {}, //Edit Form
                    btn_submit: false
                },
                mounted(){
                    this.show_spinner = false;
                    $('#edit_form').validate();
                },//End mounted()
                methods:{
                     showEditModel(name,image,link){
                          this.EF = {
                              name: name,
                              image: image_url+'/'+image,
                              link: link
                            };
                            $('#edit_model').modal('show');
                     },
                     Preview_image(e)
                     {
                          if (e.target.files && e.target.files[0]) {
                            $('#edit_img_temp').attr('src',URL.createObjectURL(e.target.files[0]) );
                          }
                     },

                }//End methods
            });



        </script>
        {{-- <script src="{{asset('js/Category.js')}}"> </script> --}}
    @endslot

@endcomponent
