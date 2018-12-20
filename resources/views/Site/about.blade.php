@extends('Site.layout.blank')


@section('content')

<section id="home_list">

  <!-- Content -->
  <div id="content">

    <!-- Linking -->
    <div class="linking">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="{{url('Site')}}"> @lang('page.Home') </a></li>
          <li class="active"> @lang('page.About Us') </li>
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

    <!-- Shipping Info -->
    <section class="shipping-info padding-bottom-30">
      <div class="container">

        <ul>
          <!-- Free Shipping -->
          {{-- <li>
            <div class="media-left"> <i class="flaticon-delivery-truck-1"></i> </div>
            <div class="media-body">
              <h5>Free Shipping</h5>
              <span>On order over $99</span></div>
          </li> --}}
          <!-- Money Return -->
          <li>
            <div class="media-left"> <i class="flaticon-arrows"></i> </div>
            <div class="media-body">
              <h5> @lang('page.Money Return') </h5>
              <span> @lang('page.30 Days money return') </span></div>
          </li>
          <!-- Support 24/7 -->
          <li>
            <div class="media-left"> <i class="flaticon-operator"></i> </div>
            <div class="media-body">
              <h5> @lang('page.Support 24/7') </h5>
              <span> @lang('page.all the day')  </span></div>
          </li>
          <!-- Safe Payment -->
          <li>
            <div class="media-left"> <i class="flaticon-business"></i> </div>
            <div class="media-body">
              <h5> @lang('page.Safe Payment')</h5>
              <span> @lang('page.Protect online payment')</span></div>
          </li>
        </ul>

      </div>
    </section>

    <!-- Skills -->
    <section class="skills  padding-bottom-60">
      <div class="container">
        <!-- heading -->
      <h5> {{$abouts['about_us_title_'.$lang]}} </h5>
      <p> {{$abouts['about_us_details_'.$lang]}} </p>
      </div>
    </section>

    <!-- Team -->


    <!-- Clients img -->



  </div>
  <!-- End Content -->


</section><!--End -->
@endsection

@section('script')
    <script>

    let root = new Vue({
      el: '#root',
    });
    </script>
@endsection
