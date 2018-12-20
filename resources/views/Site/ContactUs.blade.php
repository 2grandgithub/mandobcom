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
          <li class="active"> @lang('page.ContactUs') </li>
        </ol>
      </div>
    </div>

    <!-- Contact -->
    <section class="contact-sec padding-top-40 padding-bottom-80">
      <div class="container">

        <!-- MAP -->
        {{-- <section class="map-block margin-bottom-40">
          <div class="map-wrapper" id="map-canvas" data-lat="-37.814199" data-lng="144.961560" data-zoom="13" data-style="1"></div>
          <div class="markers-wrapper addresses-block"> <a class="marker" data-rel="map-canvas" data-lat="-37.814199" data-lng="144.961560" data-string="Smart Tech"></a> </div>
        </section> --}}

        <!-- Conatct -->
        <div class="contact">
          <div class="contact-form">

            @if ( $errors->any() )
                <ul class="alert alert-danger mydirection" >
                   @foreach ($errors->all() as $error)
                     <li class="mydirection">{{$error}}</li>
                   @endforeach
                </ul>
              @endif

            <!-- FORM  -->
            {{-- <form role="form" id="contact_form" class="contact-form" method="post" onSubmit="return false"> --}}
            {!! Form::model($ContactUs = new \App\ContactUs,['url'=>'Site/ContactUs','role'=>'form','id'=>'contact_form','class'=>'contact-form']) !!}
              <div class="row">
                <div class="col-md-8">

                  <!-- Payment information -->
                  <div class="heading">
                    <h2> @lang('page.Dou You have a Question for Us ?') </h2>
                  </div>
                  <ul class="row">
                    <li class="col-sm-6">
                      <label> @lang('page.First name')
                        <input type="text" class="form-control" name="fname" id="name" placeholder="" required >
                      </label>
                    </li>
                    <li class="col-sm-6">
                      <label> @lang('page.Last Name')
                        <input type="text" class="form-control" name="lname" id="email" placeholder="" required>
                      </label>
                    </li>
                    <li class="col-sm-6">
                      <label> @lang('page.phone')
                        <input type="number" class="form-control" name="phone" id="phone" placeholder="" required>
                      </label>
                    </li>
                    <li class="col-sm-6">
                      <label> @lang('page.email')
                        <input type="email" class="form-control" name="email" id="email" placeholder="" required>
                      </label>
                    </li>
                    <li class="col-sm-12">
                      <label> @lang('page.Message')
                        <textarea class="form-control" name="message" id="message" rows="5" placeholder=""  required></textarea>
                      </label>
                    </li>
                    <li class="col-sm-12 no-margin">
                      <button type="submit" class="btn-round" id="btn_submit" > @lang('page.Send Message') </button>
                    </li>
                  </ul>
                </div>

                <!-- Conatct Infomation -->
                <div class="col-md-4">
                  <div class="contact-info">
                    <h5> @lang('page.About us') </h5>
                    <p> {{$abouts['about_us_details_'.$lang]}}</p>
                  </div>
                </div>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </section>



    <!-- Clients img -->



  </div>
  <!-- End Content -->


</section><!--End -->
@endsection

@section('script')
    <script>

    let root = new Vue({
      el: '#root',
      mounted(){

      }
    });
    </script>
@endsection
