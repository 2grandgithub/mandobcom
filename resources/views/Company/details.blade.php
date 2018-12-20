@extends('Site.layout.blank')


@section('content')

<section id="Company_details">

  <!-- Content -->
  <div id="content">

    <!-- Linking -->
    <div class="linking">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="{{url('Site')}}"> @lang('page.Home') </a></li>
          <li><a href="{{url('Site/Company')}}"> @lang('page.Company') </a></li>
          <li class="active"> @lang('page.details') </li>
        </ol>
      </div>
    </div>

    <!-- About Sec -->
    {{-- <section class="about-sec padding-top-60 padding-bottom-60">
      <div class="container">

        <!-- About Adds -->
        <div class="about-adds">
          <div class="position-center-center">
            <h2>SmartTech <small> Digital & Electronic PSD Template!</small></h2>
            <a href="#." class="btn-round">Shop with Us</a> </div>
        </div>
      </div>
    </section> --}}

    <!-- Skills -->
    <section class="skills" id="company">
      <div class="container">
        <!-- heading -->
        <img src="{{$Company->logo}}"  alt="">

      <h5> {{$Company->name}} <br> <span> {{$Company->city_name}} </span> </h5>

      </div>
    </section>
    <hr>

<section id="Category_list" >

      <h2 v-if="categoires.length == 0"> <center>  @lang('page.no categoires') </center> </h2>
      <h2 v-else> <center>  @lang('page.Category') </center> </h2>
      <br>
      <section class="top-items padding-bottom-60">
              <ul class="row">

                  <li class="col-md-3 cats" v-for="cat in categoires">
                      <a  :href="items_url(cat.id)">
                      <img class="img-responsive" :src="cat.logo" > <!-- style="width:386px;height:400px" -->
                       <h3> @{{cat.name}} </h3>
                      </a>
                  </li>

              </ul>
      </section>

</section><!--End Category_list-->
    <!-- Team -->


    <!-- Clients img -->


    <!-- Newslatter -->

  </div>
  <!-- End Content -->


</section><!--End -->
@endsection

@section('script')
    <script>
    let get_categoires = JSON.parse(`{!!$categoires!!}`);
    let get_city_id = '{{$Company->id}}';

    let root = new Vue({
      el: '#root',
      data:{
        categoires: get_categoires,
        base_url: base_url,
        city_id: get_city_id,
      },
      methods:{
          items_url(id)
          {
            return `${this.base_url}/item/${id}?company_id=${this.city_id}` ;
          }
      }

    });
    </script>
@endsection
