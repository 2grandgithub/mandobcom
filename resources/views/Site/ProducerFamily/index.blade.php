@extends('Site.layout.blank')


@section('content')

<section id="Company_list" >

  <br>
  <!-- Content -->

      <h2> <center>  @lang('page.ProducerFamily') </center> </h2>
      <br>

      <div class="container">
        <div id="Companies_list">

          {!! Form::open([ 'id'=>'search_form' ,'v-on:submit.prevent'=>'getResults()']) !!}
              <div class="col-md-4">
                  <label> @lang('page.search') </label>
                  <input type="text" name="search" class="form-control mydirection"  placeholder=" @lang('page.search')"  >
              </div>
          {!! form::close() !!}
          <br><br><br><br>

              <!-- Product -->
                 <div class="Company" v-for="list in mainList.data">
                   <a :href="'{{url('Site/ProducerFamily/details')}}/'+list.id">
                      <article> <img class="img-responsive" :src="list.image" >

                        {{-- <span v-if="[2,3,4].includes(list.membership_id)" :class="{'Bronze':list.membership_id==2 ,'Silver':list.membership_id==3 'Golden':list.membership_id==4   }"  >
                          @{{list.membership_name}}
                        </span> --}}
                        <!-- Content -->
                        <p class="tag-1"> @{{list.name}} </p>
                        <!-- Reviews -->
                        </article>
                    </a>
                  </div>

      </div><!--End Companies_list-->

      <!-- - - - - - -START spinner- - - - - - - -->
      <spinner2 v-if="show_spinner"></spinner2>
      <!-- - - - - - -End spinner- - - - - - - -->

      <!-- - - - - - -START paginate- - - - - - - -->
      <div class="row">
            <div class="col-md-8 col-md-offset-5">
                  <pagination :data="mainList" v-on:pagination-change-page="getResults" > <!-- the_mainList -->
                      <span slot="prev-nav" aria-label="Previous">&lt;   </span>
                      <span slot="next-nav" aria-label="Next">   &gt;</span>
                  </pagination>
            </div>
      </div><!--End row-->
      <!-- - - - - - -End paginate- - - - - - - -->

     </div><!--End container-->

<br><br>



  <!-- End Content -->


</section><!--End -->
@endsection

@section('script')
    <script>



    </script>
    <script src="{{asset('js_site/ProducerFamily.js')}}"> </script>
@endsection
