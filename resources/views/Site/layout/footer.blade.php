
<section class="newslatter">
    <div class="container">
      {{-- <div class="row">
        <div class="col-md-6">
          <h3>@lang('page.mandobcom')<span>  @lang('page.is the first')  <strong>B2B</strong> @lang('page.in the middle East')  </span></h3>
        </div>
        <div class="col-md-6">
        </div>
      </div> --}}
      <div style="text-align:center">
          <h3 id="footerH3">@lang('page.mandobcom')<span>  @lang('page.Everywhere or shop mandobcom is everywhere')  </span></h3>
      </div>
    </div>
  </section>


<div class="container">

  <!-- Footer Upside Links -->
    <div class="foot-link">
    <ul>
    {{--  <li><a href="{{url('Site/about')}}"> @lang('page.About us') </a></li>
       <li><a href="#."> Customer Service </a></li>
      <li><a href="#."> Privacy Policy </a></li>
      <li><a href="#."> Site Map </a></li>
      <li><a href="#."> Search Terms </a></li>
      <li><a href="#."> Advanced Search </a></li>
      <li><a href="#."> Orders and Returns </a></li>
      <li><a href="#.">  @lang('page.Contact us') </a></li> --}}
    </ul>
  </div>
  <br>  <br>
  <div class="row">

    <!-- Contact -->
    <div class="col-md-4">
      <h4> @lang('page.Contact mandobcom!') </h4>
      <p>{{$Setting_list['our_address_'.$lang]}}</p>
      <p>{{$Setting_list['our_phone']}}</p>
      <p>{{$Setting_list['our_email']}}</p>
      <!-- Social Links -->
      <div class="social-links">
        <a href="{{$Setting_list['facebook']}}"><i class="fa fa-facebook"></i></a>
        <a href="{{$Setting_list['twitter']}}"><i class="fa fa-twitter"></i></a>
        <a href="{{$Setting_list['linkedin']}}"><i class="fa fa-linkedin"></i></a>
        <a href="{{$Setting_list['instagram']}}"><i class="fa fa-instagram"></i></a>
      </div>
    </div>

    <!-- Categories -->
    <div class="col-md-3">
      <h4>@lang('page.Categories')</h4>
      <ul class="links-footer">
        @foreach ($Categories as $key => $Cat)
           @if ($key < 6 )
              <li><a href="{{url('Site/item/'.$Cat->value)}}"> {{$Cat->label}}</a></li>
           @endif
        @endforeach
           <li> <a href="{{url('Site/Category/item')}}">  @lang('page.all') </a> </li>
      </ul>
    </div>

    <!-- Categories -->
    <div class="col-md-3">
      <h4> @lang('page.pages')  </h4>
      <ul class="links-footer">
        <li><a href="{{url('Site/Category/offer')}}"> @lang('page.Offers') </a></li>
      </ul>
    </div>

    <!-- Categories -->
    <div class="col-md-2">
      <h4> @lang('page.Information') </h4>
      <ul class="links-footer">
          <li><a href="{{url('Site/about')}}">  @lang('page.About us') </a></li>
          <li><a href="{{url('Site/ContactUs')}}"> @lang('page.Contact us') </a></li>
      </ul>
    </div>
  </div>
</div>
