@extends('Site.layout.blank')


@section('content')

<section id="Company_details">

  <!-- Content -->
  <div id="content">

     <div class="container" >
       <h3 class="mydir"> @lang('page.my orders') </h3>
       <br><br><br><br><br><br>
</div>
    <!-- Linking -->
    <div class="linking">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="{{url('Site')}}"> @lang('page.Home') </a></li>
          <li><a href="{{url('Site/ProducerFamily')}}"> @lang('page.ProducerFamily') </a></li>
          <li class="active"> @lang('page.ProducerFamily') </li>
        </ol>
      </div>
    </div>

    <!-- About Sec -->
    <section class="about-sec padding-top-60 padding-bottom-60">
      <div class="container">



    <!-- Skills -->
    <section class="skills" id="company">
      <div class="container">
        <!-- heading -->
        <img src="{{$Family->image}}"  alt="">

      <h5> {{$Family->name}} <br> <span> {{$Family->phone}} </span> </h5>
      <br><br>
      <p> {{$Family->descraption}} </p>

      </div>
    </section>
    <hr>

    <!-- Team -->


    <!-- Clients img -->


    <!-- Newslatter -->

  </div>
  <!-- End Content -->


</section><!--End -->
@endsection

@section('script')
   <script>

  let root = new Vue({
     el: '#root',
     data:{
       base_url: base_url,
     },
     methods:{
         // items_url(id)
         // {
         //   return `${this.base_url}/item/${id}?company_id=${this.city_id}` ;
         // }
     }

  });
  </script>
@endsection
