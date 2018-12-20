

@component('components.panel_default_with_blank')
    @slot('active') Recipt @endslot
      @slot('page_title') @lang('page.Recipt')  @endslot
    @slot('panel_title') @lang('page.Recipt') @endslot

    @slot('body')
        @companyPermission('Recipt')
        <div id="myVue">
           <br>
          <div class="row mydirection">
            {!! Form::model($User = new \App\Recipt,[ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                <div class="col-md-6">
                    <label> @lang('page.search') </label>
                    <input type="text" name="search" class="form-control mydirection" placeholder=" بحث "  >
                </div>
                <div class="col-md-6">
                  <label> @lang('page.case') </label>
                  <v-select :options="case_list" :name="'case'" v-on:s_change="getResults()" :f_item="'@lang('page.all')'"></v-select>
                </div>
            {!! form::close() !!}
          </div>
          <br><br><br>

            <table class="table mydir">
                <thead>
                    <th> @lang('page.code')  </th>
                    <th> @lang('page.Buyer')  </th>
                    <th> @lang('page.buyer_id')  </th>
                    <th> @lang('page.email')  </th>
                    <th> @lang('page.phone')  </th>
                    <th> @lang('page.payment_method')  </th>
                    <th> @lang('page.total_price')  </th>
                    <th> @lang('page.is_paid') </th>
                    <th> @lang('page.is_delivered') </th>
                    <th> @lang('page.is_cancled') </th>
                    <th> @lang('page.more') </th>
                </thead>
                <tbody>
                  <tr v-for="(list,index) in mainList.data">
                      <td> <p v-text="list.id"></p>  </td>
                      <td> <p v-text="list.buyer_name"></p>  </td>
                      <td> <p v-text="list.buyer_email"></p>  </td>
                      <td> <p v-text="list.buyer_phone"></p>  </td>
                      <td> <p v-text="list.buyer_id"></p>  </td>
                      <td> <p v-text="list.payment_method"></p>  </td>
                      <td> <p v-text="list.total_price"></p>  </td>
                      <td>
                          <span v-if="list.is_paid" class="badge badge-success" > نعم </span>
                          <span class="badge badge-primary" v-else> لا  </span>
                      </td>
                      <td>
                          <span v-if="list.is_delivered" class="badge badge-success" > نعم </span>
                          <span class="badge badge-primary" v-else> لا  </span>
                      </td>
                      <td>
                          <span v-if="list.is_cancled" class="badge badge-success" > نعم </span>
                          <span class="badge badge-primary" v-else> لا  </span>
                      </td>
                      <td>
                           <a class="btn btn-primary btn-rounded" :href="'{{url('Company/Recipt/invoice')}}/'+list.id" >
                               <i class="fa fa-search"></i>
                           </a>
                           <button class="btn btn-primary btn-rounded" v-on:click="showShowModel(list.id)" >
                               <i class="fa fa-search-plus"></i>
                           </button>
                           
                           <button :class="['btn btn-rounded',{'btn-success':list.is_paid , 'btn-primary':!list.is_paid}]"
                                    v-on:click="make_paided(list.id)"  title="@lang('page.make paid')" data-toggle="tooltip" >
                               <i class="fa fa-usd"></i>
                           </button>
                           <button :class="['btn btn-rounded',{'btn-success':list.is_delivered , 'btn-primary':!list.is_delivered}]"
                                   v-on:click="make_delivered(list.id)"  title="@lang('page.make delivered')" data-toggle="tooltip" >
                               <i class="fa fa-shopping-cart"></i>
                           </button>
                           <button :class="['btn btn-rounded',{'btn-success':list.is_cancled , 'btn-primary':!list.is_cancled}]"
                                   v-on:click="make_cancled(list.id)"  title="@lang('page.make cancled')" data-toggle="tooltip" >
                               <i class="fa fa-times"></i>
                           </button>
                           {{-- <button type="button" class="btn btn-danger btn-rounded" v-on:click="DeleteMessage(list.id,index)" >
                              <i class="glyphicon glyphicon-trash"></i>
                           </button>  --}}
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
                          @lang('page.items')
                    @endslot
                    @slot('body')
                      <spinner2 v-if="show_items_spinner"></spinner2>

                        <p v-if="items.length == 0"> @lang('page.no offers') </p>

                      <table class="table mydir" v-for="item in items" style="border: 1px solid;box-shadow: 2px 2px 5px #ccc;">
                          <tr v-if="item.item_id">
                              <th> @lang('page.item_id') </th>
                              <th> @{{item.item_id}} </th>
                          </tr>
                          <tr v-if="item.offer_id">
                              <th> @lang('page.offer_id') </th>
                              <th> @{{item.offer_id}} </th>
                          </tr>
                          <tr v-if="item.item_id">
                              <th> @lang('page.item_name') </th>
                              <th> @{{item.item_name}} </th>
                          </tr>
                          <tr v-if="item.offer_id">
                              <th> @lang('page.offer_name') </th>
                              <th> @{{item.offer_name}} --  <span class="badge badge-info" > @lang('page.Offer') </span>   </th>
                          </tr>
                          <tr >
                              <th> @lang('page.quantity') </th>
                              <th> @{{item.quantity}} </th>
                          </tr>
                          <tr >
                              <th> @lang('page.single_price') </th>
                              <th> @{{item.single_price}} </th>
                          </tr>
                          <tr >
                              <th> @lang('page.total_price') </th>
                              <th> @{{item.total_price}} </th>
                          </tr>

                      </table>
                    @endslot
                @endcomponent

       </div><!--End myVue-->
       @endcompanyPermission
    @endslot

    @slot('script')
        <script>
            var delete_api = '{{url('Company/Recipt/delete')}}';
            var get_list = '{{url('Company/Recipt/list')}}';
            var items_list = '{{url('Company/Recipt/items_list')}}';
            var make_paided_api = '{{url('Company/Recipt/make_paided')}}';
            var make_delivered_api = '{{url('Company/Recipt/make_delivered')}}';
            var make_cancled_api = '{{url('Company/Recipt/make_cancled')}}';
        </script>
        <script src="{{asset('js_company/Recipt.js')}}"> </script>
    @endslot

@endcomponent
