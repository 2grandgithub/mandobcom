

@component('components.panel_default_with_blank')
    @slot('active') ContactUs @endslot
    @slot('page_title') @lang('page.ContactUs')  @endslot
    @slot('panel_title') @lang('page.ContactUs') @endslot

    @slot('body')
        @permission('ContactUs')
        <div id="myVue">
          <br>
          <div class="col-md-6 mydirection">
            {!! Form::open([ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                <input type="text" name="search" class="form-control mydirection"  placeholder="  بحث"  >
            {!! form::close() !!}
          </div>
          <br><br><br>


            <table class="table mydir">
                <thead>
                    <th> @lang('page.code')  </th>
                    <th> @lang('page.name')  </th>
                    <th> @lang('page.phone') </th>
                    <th> @lang('page.email') </th>
                    <th> @lang('page.message') </th>
                    <th> @lang('page.more') </th>
                </thead>
                <tbody>
                  <tr v-for="(list,index) in mainList.data">
                      <td> <p v-text="list.id"></p>  </td>
                      <td> <p v-text="list.name"></p>  </td>
                      <td> <p v-text="list.phone"></p>  </td>
                      <td> <p v-text="list.email"></p>  </td>
                      <td> <p v-text="list.message"></p>  </td>
                      <td>
                           <button type="button" class="btn btn-danger btn-rounded" v-on:click="DeleteMessage(list.id,index)" >
                              <i class="glyphicon glyphicon-trash"></i>
                           </button>
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
            var delete_api = '{{url('ContactUs/delete')}}';
            var get_list = '{{url('ContactUs/list')}}';
            var showORhide_api = '{{url('ContactUs/showORhide')}}';
            var create_api = '{{url('ContactUs/create')}}';
            var update_api = '{{url('ContactUs/update')}}';
        </script>
        <script src="{{asset('js/City.js')}}"> </script>
    @endslot

@endcomponent
