

@component('components.panel_default_with_blank')
    @slot('active') Recipt @endslot
      @slot('page_title') @lang('page.Recipt')  @endslot
    @slot('panel_title') @lang('page.Recipt') @endslot

    @slot('body')
       @permission('Recipt')
        <div id="myVue">
           <br>
          <div class="row mydirection">
            {!! Form::model($User = new \App\Recipt,[ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                <div class="col-md-4">
                    <label> @lang('page.search') </label>
                    <input type="text" name="search" class="form-control mydirection" placeholder="  بحث " v-on:keyup.enter="getResults()" >
                </div>
                <div class="col-md-4">
                  <label> @lang('page.Company') </label>
                  <v-select :options="Company_list" :name="'company_id'" v-on:s_change="getResults()" :f_item="'@lang('page.all')'"></v-select>
                </div>
                <div class="col-md-4">
                  <label> @lang('page.case') </label>
                  <v-select :options="case_list" :name="'case'" v-on:s_change="getResults()" :f_item="'@lang('page.all')'"></v-select>
                </div>

                <div class="col-md-6">
                        <div class="form-group mydirection">
                            <br>
                          <label class="col-md-3 control-label "> @lang('page.date') </label>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" name="from" placeholder="@lang('page.from')" v-on:keyup.enter="getResults()" />
                                     <span class="input-group-addon add-on"> - </span>
                                    <input type="text" class="form-control datepicker" name="to" placeholder="@lang('page.to')" v-on:keyup.enter="getResults()" />
                                </div>
                        </div>
                </div><!--End col-md-6 -->
            {!! form::close() !!}
          </div>
          <br><br><br>

            <table class="table mydir">
                <thead>
                    <th> @lang('page.code')  </th>
                    <th> @lang('page.Buyer')  </th>
                    <th> @lang('page.payment_method')  </th>
                    <th> @lang('page.Company')  </th>
                    <th> @lang('page.total_price')  </th>
                    <th> @lang('page.init date')  </th>
                    <th> @lang('page.is_paid') </th>
                    <th> @lang('page.is_delivered') </th>
                    <th> @lang('page.is_cancled') </th>
                    <th> @lang('page.more') </th>
                </thead>
                <tbody>
                  <tr v-for="(list,index) in mainList.data">
                      <td> <p v-text="list.id"></p>  </td>
                      <td>
                        <p> @lang('page.buyer_id'): @{{list.buyer_id}} </p>
                        <p> @lang('page.name'): @{{list.buyer_name}} </p>
                        <p> @lang('page.email'): @{{list.buyer_email}} </p>
                        <p> @lang('page.phone'): @{{list.buyer_phone}} </p>
                      </td>
                      <td> <p v-text="list.payment_method"></p>  </td>
                      <td>
                        <p> @lang('page.company_id'): @{{list.company_id}} </p>
                        <p> @lang('page.name'): @{{list.company_name}} </p>
                        <p> @lang('page.email'): @{{list.company_email}} </p>
                        <p> @lang('page.phone'): @{{list.company_phone}} </p>
                      </td>
                      <td> <p v-text="list.total_price"></p>  </td>
                      <td>
                        <p v-text="list.created_at"></p>
                        <p v-text="diffforhumans(list.created_at)"></p>
                      </td>
                      <td>
                          <span v-if="list.is_paid" class="badge badge-success" > نعم </span>
                          <span v-else class="badge badge-danger" > لا  </span>
                      </td>
                      <td>
                          <span v-if="list.is_delivered" class="badge badge-success" > نعم </span>
                          <span v-else class="badge badge-danger" > لا  </span>
                      </td>
                      <td>
                          <span v-if="list.is_cancled" class="badge badge-success" > نعم </span>
                          <span v-else class="badge badge-danger" > لا  </span>
                      </td>
                      <td>
                           <a class="btn btn-primary btn-rounded" :href="'{{url('Recipt/invoice')}}/'+list.id" >
                                <i class="fa fa-search"></i>
                           </a>
                           <button class="btn btn-primary btn-rounded" v-on:click="showShowModel(list.id)" >
                               <i class="fa fa-search-plus"></i>
                           </button>
                           @permission('Recipt_delete')
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

       @else <!--IF don't have a permission --->
        <br><br>
        <div class="container">
            <h2> ليس لديك الصلاحية </h2>
        </div>
    @endpermission
    @endslot

    @slot('script')
        <script>
            var delete_api = '{{url('Recipt/delete')}}';
            var get_list = '{{url('Recipt/list')}}';
            var items_list = '{{url('Recipt/items_list')}}';
            var done_or_not_api = '{{url('Recipt/done_or_not')}}';
            let get_Company = JSON.parse('{!!$Company!!}');
        </script>
        <script type="text/javascript" src="{{asset('atlant/js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('js/Recipt.js')}}"> </script>
    @endslot

@endcomponent
