

@component('components.panel_default_with_blank')
    @slot('active') MyAuctionRequest @endslot
      @slot('page_title') @lang('page.MyAuctionRequest')  @endslot
    @slot('panel_title') @lang('page.MyAuctionRequest') @endslot

    @slot('body')
      @companyPermission('MyAuctionRequest')
        <div id="myVue">
            <button class="btn btn-primary btn-rounded" v-on:click="showCreateModel()">
                  @lang('page.create')  <i class="fa fa-plus mydir"></i>
            </button>
             <hr>
          <div class="row mydirection">
            {!! Form::open( [ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                <div class="col-md-4">
                    <label> @lang('page.search') </label>
                    <input type="text" name="search" class="form-control mydirection" placeholder=" بحث "  >
                </div>
                <div class="col-md-4">
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
                    <th> @lang('page.description') </th>
                    <th> @lang('page.required_quantity') </th>
                    <th> @lang('page.description') </th>
                    <th width="10%"> @lang('page.date') </th>
                    <th> @lang('page.more') </th>
                </thead>
                <tbody>
                  <tr v-for="(list,index) in mainList.data">
                      <td> <p v-text="list.id"></p>                       </td>
                      <td> <p v-text="list.title"></p>                    </td>
                      <td> <p v-text="list.category_name"></p>            </td>
                      <td> <p v-text="list.description"></p>              </td>
                      <td> <p v-text="list.required_quantity"></p>        </td>
                      <td width="25%"> <p v-text="list.description"></p>  </td>
                      <td>
                          <p> @lang('page.from'): @{{list.from}} </p>
                          <p> @lang('page.to'):   @{{list.to}}   </p>
                      </td>
                      <td>
                           <button class="btn btn-primary btn-rounded" v-on:click="showShowModel(list.id,list.company_id)" >
                               <i class="fa fa-search"></i>
                           </button>
                           <a v-if="list.winner_offer_id && list.status" class="btn btn-primary btn-rounded"
                              :href="'{{url('Company/MyAuctionRequest/payment')}}/'+list.id" :disabled="list.payment_method" >
                                  <i class="fa fa-check-square"></i>
                           </a>
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

                @component('components.modal')
                    @slot('id')
                      create_model
                    @endslot
                    @slot('header')
                        @lang('page.add new auction')
                    @endslot
                    @slot('form_header')
                        {!! Form::open([ 'class'=>"mydirection",'id'=>'create_form' ,'v-on:submit.prevent'=>'create()' ]) !!}
                    @endslot
                    @slot('body')

                          <div class="form-group">
                              {!! Form::label('image',__('page.images')) !!}
                              {!! Form::file('image',['class'=>'form-control','v-on:change'=>"Preview_image_create" ,'id'=>'create_image','multiple' ,'required']) !!}
                          </div>
                             <div id="Preview_create_images"> </div>

                          <div class="form-group">
                              <label> @lang('page.Category') </label>
                              <v-select :options="Category_list" :name="'category_id'" :f_item="'@lang('page.all')'" :required='true' ></v-select><!--:required='true'-->
                          </div>
                          <div class="form-group">
                              {!! Form::label('title',__('page.title')) !!}
                              {!! Form::text('title',null,['class'=>'form-control','required'  ]) !!}
                          </div>
                          <div class="form-group">
                              {!! Form::label('required_quantity',__('page.required_quantity')) !!}
                              {!! Form::text('required_quantity',null,['class'=>'form-control','required' ]) !!}
                          </div>
                          <div class="form-group">
                              {!! Form::label('description',__('page.description')) !!}
                              {!! Form::textarea('description',null,['class'=>'form-control','required','rows'=>'8'  ]) !!}
                          </div>

                    @endslot
                    @slot('submit_input')
                      <button type="submit" class="btn btn-success" :disabled="btn_submit" >  @lang('page.add new') </button>
                    @endslot
                @endcomponent

            {{-- ------------------- add_offer ------------------------ --}}

                @component('components.modal')
                    @slot('id')
                      add_offer_model
                    @endslot
                    @slot('header')
                        @lang('page.add new Offer')
                    @endslot
                    @slot('form_header')
                        {!! Form::open([ 'class'=>"mydirection",'id'=>'add_offer_form' ,'v-on:submit.prevent'=>'add_offer()' ]) !!}
                    @endslot
                    @slot('body')

                          <div class="form-group">
                              {!! Form::label('image',__('page.images')) !!}
                              {!! Form::file('image',['class'=>'form-control','v-on:change'=>"Preview_image_edit" ,'id'=>'edit_image','multiple'  ]) !!}
                          </div>

                          <div id="Preview_image_edit"></div>

                          {!! Form::hidden('auction_request_id',null,['id'=>'auction_request_id' ]) !!}
                          <p id="create_title">  </p>
                          <hr>
                          <div class="form-group">
                              {!! Form::label('price_offer',__('page.price_offer')) !!}
                              {!! Form::number('price_offer',null,['class'=>'form-control','required' ,'step'=>'0.01' ]) !!}
                          </div>
                          <div class="form-group">
                              {!! Form::label('comment',__('page.comment')) !!}
                              {!! Form::textarea('comment',null,['class'=>'form-control','required','rows'=>'8'  ]) !!}
                          </div>

                    @endslot
                    @slot('submit_input')
                      <button type="submit" class="btn btn-success" :disabled="btn_submit" >  @lang('page.add new') </button>
                    @endslot
                @endcomponent

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
                          <tr v-if="SF.company_id == company_id && !SF.winner_offer_id">
                            <th width="30%" >  </th>
                            <td>
                                <button v-on:click="accaptOffer(offer.id)" type="button" class="btn btn-success" style="width:100%" >  اوافق علي هذا العرض  </button>
                            </td>
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

             @endcompanyPermission

       </div><!--End myVue-->
    @endslot

    @slot('script')
        <script>
            var delete_api = '{{url('Company/MyAuctionRequest/delete')}}';
            var get_list = '{{url('Company/MyAuctionRequest/list')}}';
            var offers_list = '{{url('Company/MyAuctionRequest/offers_list')}}';
            var done_or_not_api = '{{url('Company/MyAuctionRequest/done_or_not')}}';
            let add_offer_api = '{{url('Company/MyAuctionRequest/add_offer')}}';
            let add_auction_api = '{{url('Company/MyAuctionRequest/add_auction')}}';
            let accapt_offer_api = '{{url('Company/MyAuctionRequest/accapt_offer')}}';
            let get_Category = JSON.parse('{!!$Category!!}');
            let company_id = "{{auth('Company')->id()}}";
            let accapt_offer_link = '{{url('Company/MyAuctionRequest/accapt_offer')}}';
        </script>
        <script src="{{asset('js_company/AuctionRequest.js')}}"> </script>
    @endslot

@endcomponent
