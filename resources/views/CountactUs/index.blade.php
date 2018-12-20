
@component('components.panel_default_with_blank')
    @slot('active') CountactUs @endslot
    @slot('page_title') تواصل معنا @endslot
    @slot('panel_title') تواصل معنا @endslot

    @slot('body')
        <div id="myVue">
          <br>
          <div class="col-md-6 mydirection">
            {!! Form::open([ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
                <input type="text" name="search" class="form-control mydirection" value="{{$val??''}}" placeholder="  بحث"  >
            {!! form::close() !!}
          </div>
          <br><br><br>


            <table class="table mydir">
                <thead>
                    <th>  الرقم </th>
                    <th> الاسم </th>
                    <th>  البريد </th>
                    <th>  الهاتف </th>
                    <th>  الرسالة </th>
                    <th> المزيد </th>
                </thead>
                <tbody>
                  <tr v-for="list in mainList.data">
                    <td> <p v-text="list.id"></p> </td>
                    <td> <p v-text="list.name"></p> </td>
                    <td> <p v-text="list.email"></p> </td>
                    <td> <p v-text="list.phone"></p> </td>
                    <td> <p v-text="list.message"></p> </td>
                    <td>
                         <button type="button" class="btn btn-danger btn-rounded" v-on:click="DeleteMessage(list.id)" >
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
            <div class="spinner" v-if="show_spinner">
                <div class="cube1"></div>
                <div class="cube2"></div>
            </div>
            <!-- - - - - - -End spinner- - - - - - - -->

       </div><!--End myVue-->
    @endslot

    @slot('script')
        <script>
            var delete_api = '{{url('CountactUs/delete')}}';
            var User_list = '{{url('CountactUs/list')}}';
        </script>
        <script src="{{asset('js/User.js')}}"> </script>
    @endslot

@endcomponent
