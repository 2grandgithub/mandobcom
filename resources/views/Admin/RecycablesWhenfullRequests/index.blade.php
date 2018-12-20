

@component('components.panel_default_with_blank')
    @slot('active') RecycablesWhenfullRequests @endslot
    @slot('page_title') @lang('page.RecycablesWhenfullRequests')  @endslot
    @slot('panel_title') @lang('page.RecycablesWhenfullRequests') @endslot

    @slot('body')
       @permission('RecycablesWhenfullRequests')
        <div id="myVue">
           <br>
          <div class="row mydirection">
            {!! Form::model($User = new \App\RecycablesWhenfullRequests,[ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                <div class="col-md-6">
                    <label> @lang('page.search') </label>
                    <input type="text" name="search" class="form-control mydirection" placeholder="  بحث "  >
                </div>
                <div class="col-md-6">
                  <label> @lang('page.request') </label>
                  <v-select :options="accaptance_list" :name="'done'" v-on:s_change="getResults()" :f_item="'@lang('page.all')'"></v-select>
                </div>
            {!! form::close() !!}
          </div>
          <br><br><br>

            <table class="table mydir">
                <thead>
                    <th> @lang('page.request_code')  </th>
                    <th> @lang('page.recycable_name')  </th>
                    <th> @lang('page.recycable_id') </th>
                    <th> @lang('page.recycable_phone') </th>
                    <th> @lang('page.Glass') </th>
                    <th> @lang('page.Plastic') </th>
                    <th> @lang('page.Metal') </th>
                    <th> @lang('page.Paper') </th>
                    <th> @lang('page.comment') </th>
                    <th> @lang('page.more') </th>
                </thead>
                <tbody>
                  <tr v-for="(list,index) in mainList.data">
                      <td> <p v-text="list.id"></p>  </td>
                      <td> <p v-text="list.recycable_name"></p>  </td>
                      <td> <p v-text="list.recycable_id"></p>  </td>
                      <td> <p v-text="list.recycable_phone"></p>  </td>
                      <td> <p v-text="list.Glass"></p>  </td>
                      <td> <p v-text="list.Plastic"></p>  </td>
                      <td> <p v-text="list.Metal"></p>  </td>
                      <td> <p v-text="list.Paper"></p>  </td>
                      <td width="25%"> <p v-text="list.comment"></p>  </td>
                      <td>
                           @permission('RecycablesWhenfullRequests_done')
                           <button :class="{'btn btn-rounded':true ,'btn-success':list.is_done ,'btn-info':!list.is_done }"
                                   v-on:click="doneORnot(list.id)" data-toggle="tooltip" title="@lang('page.click for make it done')">
                               <i class="fa fa-check-square-o" v-if="list.is_done" ></i>
                               <i class="fa fa-square-o" v-else ></i>
                           </button>
                           @endpermission
                           @permission('RecycablesWhenfullRequests_delete')
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
            var delete_api = '{{url('RecycablesWhenfullRequests/delete')}}';
            var get_list = '{{url('RecycablesWhenfullRequests/list')}}';
            var done_or_not_api = '{{url('RecycablesWhenfullRequests/done_or_not')}}';
        </script>
        <script src="{{asset('js/RecycablesWhenfullRequests.js')}}"> </script>
    @endslot

@endcomponent
