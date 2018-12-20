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
          <li><a href="{{url('Site/RecycablesNews')}}"> @lang('page.RecycablesNews') </a></li>
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
    {{-- <section class="skills" id="company">
      <div class="container">
        <!-- heading -->
        <h3> {{$RecycablesNews->title}} </h3>

        <img src="{{$RecycablesNews->image}}" width="500px"  alt="">

      <h5> {{$RecycablesNews->name}} <br> <span>   </span> </h5>
      <br><br>
      <p> {{$RecycablesNews->body}} </p>

      </div>
    </section>
    <hr> --}}





    <!-- Blog -->
    <section class="blog-single padding-top-30 padding-bottom-60">
      <div class="container">
        <div class="row">
          <div class="col-md-9">

            <!-- Blog Post -->
            <div class="blog-post">
              <article>
                <img class="img-responsive margin-bottom-20" src="{{$RecycablesNews->image}}" alt="" >
                <br>
                {{-- <span>By: <strong>Claudio Doe</strong></span> --}}
                <span><i class="fa fa-bookmark-o"></i>  {{$RecycablesNews->created_at_human}} </span>
                {{-- <span><i class="fa fa-comment-o"></i> 86 Comments</span> --}}
                <h5>{{$RecycablesNews->title}}  </h5>
                <p>{{$RecycablesNews->body}}</p>


              </article>


            </div>
          </div>

          <!-- Side Bar -->
          <div class="col-md-3">
            <div class="shop-side-bar">

              <!-- Search -->
              {{-- <div class="search">
                <form>
                  <label>
                    <input type="email" placeholder="Search here">
                  </label>
                  <button type="submit"><i class="fa fa-search"></i></button>
                </form>
              </div> --}}

              <!-- Categories -->



              <!-- Recent Posts -->
              <h6> @lang('page.Recent News') </h6>
              <div class="recent-post">
                @foreach ($RecentRecycablesNews as $News)
                  <div class="media">
                     <div class="media-left">
                        <a href="{{url('Site/RecycablesNews/details/'.$News->id)}}">
                          <img class="img-responsive" src="{{$News->image}}" alt="">
                        </a>
                     </div>
                    <div class="media-body">
                      <a href="{{url('Site/RecycablesNews/details/'.$News->id)}}">{{$News->title}} </a>
                      <span>{{$News->created_at_human}}</span>
                      {{-- <span> 86 Comments</span> --}}
                    </div>
                  </div>
                @endforeach
              </div>

              <!-- Quote of the Day -->
              {{-- <h6>Quote of the Day</h6>
              <div class="quote-day"> <i class="fa fa-quote-left"></i>
                <p>Suspendisse sodales cursus lorem vel
                  efficitur. Donec tincidunt aliquet lacus. Maecenas pulvinar egestas ex eget eleifend. Aenean eget tempus urna [...]</p>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </section>

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
        // base_url: base_url,
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
