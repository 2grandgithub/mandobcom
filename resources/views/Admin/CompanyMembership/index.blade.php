

@component('components.panel_default_with_blank')
    @slot('active') CompanyMembership @endslot
    @slot('page_title') @lang('page.CompanyMembership')  @endslot
    @slot('panel_title') @lang('page.CompanyMembership') @endslot

    @slot('body')
        @permission('CompanyMembership')
        <div id="myVue">
          <br>
          <div class="row mydirection">
            {!! Form::open([ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                <div class="col-md-3">
                    <label> @lang('page.search') </label>
                    <input type="text" name="text" class="form-control mydirection" placeholder=" بحث"  >
                </div>
                  <div class="col-md-3">
                    <label> @lang('page.Company') </label>
                    <v-select :options="companies" :name="'company_id'" v-on:s_change="getResults()" :f_CompanyMembership="'@lang('page.all')'"></v-select>
                </div>
                <div class="col-md-3">
                    <label> @lang('page.Membership') </label>
                    <v-select :options="Memberships" :name="'membership_id'"  v-on:s_change="getResults()" :f_CompanyMembership="'@lang('page.all')'"></v-select>
                </div>
                <div class="col-md-3">
                    <label> @lang('page.Category') </label>
                    <v-select :options="status_list" :name="'status'"  v-on:s_change="getResults()" :f_CompanyMembership="'@lang('page.all')'"></v-select>
                </div>
            {!! form::close() !!}
          </div>
          <br><br><br>


            <table class="table mydir">
                <thead>
                    <th> @lang('page.Membership code')  </th>
                    <th> @lang('page.company id')  </th>
                    <th> @lang('page.Company')  </th>
                    <th> @lang('page.email')  </th>
                    <th> @lang('page.phone') </th>
                    <th> @lang('page.Membership') </th>
                    <th> @lang('page.from') </th>
                    <th> @lang('page.to') </th>
                    <th> @lang('page.price') </th>
                    <th> @lang('page.is_paid') </th>
                    <th> @lang('page.confirmed') </th>
                    <th> @lang('page.created_at') </th>
                    <th> @lang('page.more') </th>
                </thead>
                <tbody>
                  <tr v-for="(list,index) in mainList.data">
                      <td> <p v-text="list.id"></p>  </td>
                      <td> <p v-text="list.company_id"></p>  </td>

                      <td> <p v-text="list.company_name"></p>  </td>
                      <td> <p v-text="list.email"></p>  </td>
                      <td> <p v-text="list.phone"></p>  </td>
                      <td> <p v-text="list.membership_name"></p>  </td>
                      <td> <p> @{{toDate(list.from)}} <br> @{{diffforhumans(list.from)}} </p>  </td>
                      <td> <p> @{{toDate(list.to)}} <br> @{{diffforhumans(list.to)}} </p>  </td>
                      <td> <p v-text="list.price"></p>  </td>
                      <td>
                         <span class="badge badge-success"  v-if="list.paid"> نعم </span>
                         <span class="badge badge-danger" v-else> لا  </span>
                      </td>
                      <td>
                         <span class="badge badge-success"  v-if="list.confirmed"> نعم </span>
                         <span class="badge badge-danger" v-else> لا  </span>
                      </td>
                      <td> <p> @{{list.created_at}} <br> @{{diffforhumans(list.created_at)}} </p>  </td>
                      <td>
                           @permission('CompanyMembership_paid')
                           <button :class="{'btn btn-rounded':true ,'btn-success':list.paid ,'btn-danger':!list.paid }"
                                   v-on:click="switchPaid(list.id)"   data-toggle="tooltip" title="@lang('page.is_paid')">
                               <i class="fa fa-dollar" v-if="list.paid" ></i>
                               <i class="fa fa-dollar" v-else ></i>
                           </button>
                           @endpermission
                           @permission('CompanyMembership_confirmed')
                           <button :class="{'btn btn-rounded':true ,'btn-success':list.confirmed ,'btn-danger':!list.confirmed }"
                                   v-on:click="switchConfirmed(list.id)"   data-toggle="tooltip" title="@lang('page.is_paid')">
                               <i class="fa fa-check-square-o" v-if="list.confirmed" ></i>
                               <i class="fa fa-square-o" v-else ></i>
                           </button>
                           @endpermission
                           @permission('CompanyMembership_delete')
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
            var delete_api = '{{url('CompanyMembership/delete')}}';
            var get_list = '{{url('CompanyMembership/list')}}';
            var switch_paid_api = '{{url('CompanyMembership/switch_paid')}}';
            var switch_confirmed_api = '{{url('CompanyMembership/switch_confirmed')}}';
            let get_companies = JSON.parse(`{!!$companies!!}`);
            let get_Memberships = JSON.parse(`{!!$Memberships!!}`);
        </script>
        <script src="{{asset('js/CompanyMembership.js')}}"> </script>
    @endslot

@endcomponent
