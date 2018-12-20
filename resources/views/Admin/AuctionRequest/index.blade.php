

@component('components.panel_default_with_blank')
    @slot('active') AuctionRequest @endslot
      @slot('page_title') @lang('page.AuctionRequest')  @endslot
    @slot('panel_title') @lang('page.AuctionRequest') @endslot

    @slot('body')

                      <style> .ui-datepicker-trigger { z-index:1000; }  </style>
       @permission('AuctionRequest')
        <div id="myVue">
           <br>
          <div class="row mydirection">
            {!! Form::model($User = new \App\AuctionRequest,[ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                <div class="col-md-6">
                    <label> @lang('page.search') </label>
                    <input type="text" name="search" class="form-control mydirection" placeholder="  بحث "  >
                </div>
                <div class="col-md-6">
                  <label> @lang('page.Category') </label>
                  <v-select :options="Category_list" :name="'category_id'" v-on:s_change="getResults()" :f_item="'@lang('page.all')'"></v-select>
                </div>
            {!! form::close() !!}
          </div>
          <br><br><br>

            <table class="table mydir">
                <thead>
                    <th> @lang('page.code')  </th>
                    <th> @lang('page.title')  </th>
                    <th> @lang('page.Category')  </th>
                    <th> @lang('page.Company')  </th>
                    <th> @lang('page.Buyer')  </th>
                    <th> @lang('page.description') </th>
                    <th> @lang('page.required_quantity') </th>
                    <th> @lang('page.date') </th>
                    <th> @lang('page.winer_company') </th>
                    <th> @lang('page.more') </th>
                </thead>
                <tbody>
                  <tr v-for="(list,index) in mainList.data">
                      <td> <p v-text="list.id"></p>  </td>
                      <td> <p v-text="list.title"></p>  </td>
                      <td> <p v-text="list.category_name"></p>  </td>
                      <td> <p v-text="list.company_name"></p>  </td>
                      <td> <p v-text="list.buyer_name"></p>  </td>
                      <td  width="25%"> <p v-text="list.description"></p>  </td>
                      <td> <p v-text="list.required_quantity"></p>  </td>
                      <td>
                          <div v-if="list.auction_case != 'notAccapted'">
                              <p> @lang('page.from'): @{{list.from_date}} </p>
                              <p> @lang('page.to'): @{{list.to_date}} </p>
                                <span class="badge badge-info" v-if="list.auction_case == 'current' "> @lang('page.current') </span>
                                <span class="badge badge-info" v-if="list.auction_case == 'future' "> @lang('page.future') </span>
                                <span class="badge badge-info" v-if="list.auction_case == 'finshed' "> @lang('page.finshed') </span>
                          </div>
                          <div v-else>
                              <p> @lang('page.not accapted yet')    </p>
                          </div>
                      </td>
                      <td>
                        <span class="badge badge-danger" v-if="!list.winer_company_name"> لا يوجد </span>

                        <span class="badge badge-success"  v-if="list.winer_company_name">  @{{list.winer_company_name}} </span>
                        <p v-if="list.price_offer"> @lang('page.price'): @{{list.price_offer}} </p>
                      </td>
                      <td>
                           <button class="btn btn-primary btn-rounded" v-on:click="showShowModel(list.id)" >
                               <i class="fa fa-search"></i>
                           </button>
                           @permission('AuctionRequest_status')
                           <button :class="{'btn btn-rounded':true ,'btn-success':list.status ,'btn-danger':!list.status }"
                                   v-on:click="showORhide(list.id,list.status)" data-toggle="tooltip" title="@lang('page.status')">
                               <i class="fa fa-check-square-o" v-if="list.status"></i>
                               <i class="fa fa-square-o" v-else ></i>
                           </button>
                           @endpermission
                           @permission('AuctionRequest_delete')
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
                          @lang('page.offers order by price')
                    @endslot
                    @slot('body')
                      <spinner2 v-if="show_offers_spinner"></spinner2>

                        <p v-if="offers.length == 0"> @lang('page.no offers') </p>

                      <table class="table mydir" v-for="offer in offers" style="border: 1px solid;box-shadow: 2px 2px 5px #ccc;">
                          <tr >
                              <th> @lang('page.Company') </th>
                              <td v-text="offer.company_name"> </td>
                          </tr>
                          <tr >
                              <th> @lang('page.phone') </th>
                              <td v-text="offer.company_phone"> </td>
                          </tr>
                          <tr >
                              <th> @lang('page.price_offer') </th>
                              <td v-text="offer.price_offer"> </td>
                          </tr>
                          <tr >
                              <th> @lang('page.comment') </th>
                              <td v-text="offer.comment"> </td>
                          </tr>
                          <tr v-if="SF.winner_offer_id == offer.id">
                              <th></th>
                              <td>
                                <p class="btn btn-success" style="width:100%" >  هذا هوا العرض المقبول  </p>
                              </td>
                          </tr>
                      </table>
                    @endslot
                @endcomponent

            {{-- ------------------- accapt the auction ------------------------ --}}

                @component('components.modal')
                    @slot('id')
                      accapt_model
                    @endslot
                    @slot('header')
                          @lang('page.accapt_auction')
                    @endslot
                    @slot('form_header')
                        {!! Form::open([ 'class'=>"mydirection",'id'=>'accapt_form' ,'v-on:submit.prevent'=>'accaptAuction()' ]) !!}
                    @endslot
                    @slot('body')
                       <spinner2 v-if="show_offers_spinner"></spinner2>
                       <p> @{{AF.id}} - @{{AF.title}} </p>
                       <input type="hidden" name="id" :value="AF.id">

                       <label for=""> @lang('page.from date') </label>
                       <input type="text" name="from" value="" class="form-control datepicker" required>

                       <label for=""> @lang('page.to date') </label>
                       <input type="text" name="to" value="" class="form-control datepicker" required>

                    @endslot
                    @slot('submit_input')
                      <button type="submit" class="btn btn-success" :disabled="btn_submit"  >  @lang('page.accapted') </button>
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
            var delete_api = '{{url('AuctionRequest/delete')}}';
            var get_list = '{{url('AuctionRequest/list')}}';
            var offers_list = '{{url('AuctionRequest/offers_list')}}';
            var done_or_not_api = '{{url('AuctionRequest/done_or_not')}}';
            var unAccaptedAuction_api = '{{url('AuctionRequest/unAccaptedAuction')}}';
            var accaptAuction_api = '{{url('AuctionRequest/accaptAuction')}}';
            let get_Category = JSON.parse('{!!$Category!!}');
        </script>
          <script type="text/javascript" src="{{asset('atlant/js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('js/AuctionRequest.js')}}"> </script>
    @endslot

@endcomponent
