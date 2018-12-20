

@component('components.panel_default_with_blank')
    @slot('active') Memberships @endslot
    @slot('page_title') @lang('page.Membership')  @endslot
    @slot('panel_title') @lang('page.Membership') @endslot

    @slot('body')

      @companyPermission('Memberships')

                 <style>
                 * {
                     box-sizing: border-box;
                 }

                 .columns {
                     float: left;
                     width: 33.3%;
                     padding: 8px;
                 }

                 .price {
                     list-style-type: none;
                     border: 1px solid #eee;
                     margin: 0;
                     padding: 0;
                     -webkit-transition: 0.3s;
                     transition: 0.3s;
                 }

                 .price:hover {
                     box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
                 }

                 .price .header {
                     background-color: #111;
                     color: white;
                     font-size: 25px;
                 }

                 .price li {
                     border-bottom: 1px solid #eee;
                     padding: 20px;
                     text-align: center;
                 }

                 .price .grey {
                     background-color: #eee;
                     font-size: 20px;
                 }

                 .button {
                     background-color: #4CAF50;
                     border: none;
                     color: white;
                     padding: 10px 25px;
                     text-align: center;
                     text-decoration: none;
                     font-size: 18px;
                 }

                 @media only screen and (max-width: 600px) {
                     .columns {
                         width: 100%;
                     }
                 }

                 .header.Bronze{ background-color: #cd7f32; }
                 .header.Silver{ background-color: #848080; }
                 .header.Golden{ background-color: #D4AF37; }

                 .popupHeader
                 {
                    color: white;
                    padding: 5px;
                    text-align: center;
                    font-size: 20px;
                 }

        </style>


        <div id="myVue">

           <hr>  <br>

           <!-- - - - - - -START spinner- - - - - - - -->
           <spinner2 v-if="show_spinner"></spinner2>
           <!-- - - - - - -End spinner- - - - - - - -->

           <h2 style="text-align:center"> @lang('page.subscription') </h2>
           <p style="text-align:center"> @lang('page.subscribe for better chances of your business')  </p>

           @foreach ($Memberships as $Membership)
             @if($Membership->id ==1 ) @continue @endif
             <div class="columns mydir">
               <ul class="price">
                 <li class="header {{($Membership->id==2)?'Bronze':''}} {{($Membership->id==3)?'Silver':''}} {{($Membership->id==4)?'Golden':''}}"  >
                    {{$Membership->name}}
                 </li>
                 <li class="grey"> {{$Membership->price_per_month}} @lang('page.JD') / @lang('page.per_month')</li>
                 <li>
                    @lang('page.see_auctions')
                     @if($Membership->see_auctions)
                        <span class="badge badge-success" > @lang('page.yes') </span>
                     @else
                        <span class="badge badge-danger" > @lang('page.no')  </span>
                     @endif
                 </li>
                 <li>
                   @lang('page.no_add_offers')
                   <span class="badge badge-success" > {{$Membership->no_add_offers}}</span>
                   @lang('page.per_month')
                 </li>
                 <li>
                   @lang('page.arrangement')
                   @lang('page.arrangement_'.$Membership->id)
                 </li>
                 <li>
                   @lang('page.indication for subscription')
                   <span class="badge badge-success" > @lang('page.yes') </span>
                 </li>
                 <li class="grey">
                   <button class="button" v-on:click="subscribe('{{$Membership->id}}','{{$Membership->name}}','{{$Membership->price_per_month}}')" > @lang('page.subscribe') </button>
                 </li>
               </ul>
             </div>
           @endforeach

            <br><br><br>

            {{-- ------------------- edit ------------------------ --}}

                @component('components.modal')
                    @slot('id')
                      subscribe_model
                    @endslot
                    @slot('header')
                        @lang('page.subscribe')
                    @endslot
                    @slot('form_header')
                        {!! Form::open(['url'=>'Company/CompanyMembership/assign_membership', 'class'=>"mydirection",'id'=>'edit_form' ]) !!}
                    @endslot
                    @slot('body')

                      {!! Form::hidden('membership_id',null,['id'=>'edit_id','v-model'=>'current_Membership.Membership_id']) !!}

                      {{-- <label> @lang('page.Category') </label> --}}
                      {{-- <v-select :options="Category_list" :name="'category_id'" :value="EF.category_id" :f_item="'@lang('page.all')'" :required='true' :readonly='true' v-on:s_change="Category_change('edit')" :s_id="'edit_category_id'"></v-select><!--:required='true'--> --}}

                      <div :class="['header','popupHeader',{'Bronze':current_Membership.Membership_id==2,
                                             'Silver':current_Membership.Membership_id==3,
                                             'Golden':current_Membership.Membership_id==4} ]">
                                <p>  @{{current_Membership.name}}   </p>
                      </div>

                      <label> @lang('page.from') </label>
                      <input type="text" name="from"  class="form-control datepicker" required  >

                      <label> @lang('page.no months') </label>
                      <select class="form-control" name="months" v-model="current_Membership.no_month" required>
                          <option v-for="n in 12" :value="n" > @{{n}} </option>
                      </select>
                      <br>
                      <label> @lang('page.no months') </label>
                      <p> @lang('page.total price'): @{{total_price}} @lang('page.JD') </p>
                      <hr><br>

                    @endslot
                    @slot('submit_input')
                        <button type="submit" class="btn btn-success" :disabled="btn_submit" >  @lang('page.subscribe') </button>
                    @endslot
                @endcomponent


       </div><!--End myVue-->
       @endcompanyPermission
    @endslot

    @slot('script')
        <script type="text/javascript" src="{{asset('atlant/js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
        <script>
            var delete_api = '{{url('Company/Offer/delete')}}';

            let myVue = new Vue({
                el:'#myVue',
                data:{
                    show_spinner:true,
                    btn_submit: false,
                    btn_submit: false,
                    current_Membership: {
                        name: '',
                        Membership_id: 0 ,
                        no_month: 1,
                        total_price: 0,
                        from_date: '',
                        price: 0
                    }
                },
                mounted(){
                    this.show_spinner = false;
                    $('#create_form').validate();
                    $('#edit_form').validate();

                    var date = new Date();
                    date.setDate(date.getDate()+1);


                    $(".datepicker").datepicker({format: 'yyyy-mm-dd',startDate: date });
                },//End mounted()
                methods:{
                    subscribe(Membership_id,name,price)
                    {
                        this.current_Membership = {
                            name: name,
                            Membership_id: Membership_id,
                            price: price,
                            no_month: 1,
                            total_price: 0,
                            from_date: '',
                        };
                        $('#subscribe_model').modal('show');
                    }
                },
                computed:{
                    total_price()
                    {
                      return this.current_Membership.no_month * this.current_Membership.price ;
                    }
                }
             });
        </script>
        {{-- <script src="{{asset('js_company/Item.js')}}"> </script> --}}
    @endslot

@endcomponent
