

@component('components.panel_default_with_blank')
    @slot('active')  Membership @endslot
    @slot('page_title') @lang('page.Membership')  @endslot
    @slot('panel_title') @lang('page.Membership') @endslot

    @slot('body')
        @permission(' Membership')
        <div id="myVue">

          <br>

            <table class="table mydir">

                 <thead>
                   <th> @lang('page.type') </th>
                   <th> @lang('page.see_auctions') </th>
                   <th> @lang('page.no_add_offers') </th>
                   <th> @lang('page.price_per_month') </th>
                   <th> @lang('page.more') </th>
                 </thead>

                    <tr v-for="Membership in Memberships">
                      <th>  @{{Membership.name}}  </th>
                      <td>
                        <span v-if="Membership.see_auctions" class="badge badge-success" > @lang('page.yes') </span>
                        <span class="badge badge-danger" v-else> @lang('page.no')  </span>
                      </td>
                      <td>  @{{Membership.no_add_offers}} </td>
                      <td>  @{{Membership.price_per_month}} @lang('page.JD') </td>
                      <td>
                          @permission('Slider_edit')
                          <button class="btn btn-primary btn-rounded" v-on:click="showEditModel(Membership)" >
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
                        {!! Form::open(['url'=>'Membership/update','class'=>"mydirection",'id'=>'edit_form' ,'files'=>true ]) !!}
                    @endslot
                    @slot('body')

                      {!! Form::hidden('id',null,['id'=>'edit_id','v-model'=>'EF.id']) !!}

                      <div class="form-group">
                          {!! Form::label('see_auctions',__('page.see_auctions')) !!}
                          {!! Form::select('see_auctions',['1'=>__('page.yes'),'0'=>__('page.no')],null,
                                          ['class'=>'form-control' ,'id'=>'edit_image',':value'=>'EF.see_auctions']) !!}
                      </div>

                      <div class="form-group">
                          {!! Form::label('no_add_offers',__('page.no_add_offers')) !!}
                          {!! Form::number('no_add_offers',null,['class'=>'form-control','required' ,':value'=>'EF.no_add_offers']) !!}
                      </div>
                      <div class="form-group">
                          {!! Form::label('price_per_month',__('page.price_per_month')) !!}
                          {!! Form::number('price_per_month',null,['class'=>'form-control','required' ,':value'=>'EF.price_per_month']) !!}
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
            let get_Memberships = JSON.parse(`{!!$Memberships!!}`);

            let myVue = new Vue({
                el:'#myVue',
                data:{
                    show_spinner:true,
                    EF: {}, //Edit Form
                    btn_submit: false,
                    Memberships: get_Memberships
                },
                mounted(){
                    this.show_spinner = false;
                    $('#edit_form').validate();
                },//End mounted()
                methods:{
                     showEditModel(list){
                          this.EF = list;
                          $('#edit_model').modal('show');
                     },

                }//End methods
            });



        </script>
        {{-- <script src="{{asset('js/Category.js')}}"> </script> --}}
    @endslot

@endcomponent
