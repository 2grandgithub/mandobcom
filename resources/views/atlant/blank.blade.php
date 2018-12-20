<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title> mandocom </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->

        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('atlant/css/theme-default_rtl.css')}}"  media="all" />
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('atlant/css/rtl.css')}}"  media="all" />
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('sweetalert/sweetalert.css')}}"  media="all" />
        <link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}"  media="all" >
          <link rel="stylesheet" href="{{asset('css/my_css.css')}}"  media="all" >
        <!-- EOF CSS INCLUDE -->

        <style media="screen">
            .align-left{
              text-align: left
            }
            .align-right{
              text-align: right;
            }
        </style>

    </head>
    <body >
          <!-- START PAGE CONTAINER -->
        @if ( \App::getLocale() == 'ar' )
            <div class="page-container page-mode-rtl page-content-rtl">
              <style>
                .mydir{ float: right; direction: rtl;}
                .mydirection{ direction: rtl;}
                .pull-atherWay{ float: left; }
              </style>
        @else
           <div class="page-container ">
              <style>
                .mydir{ float: left; direction: ltr; }
                .mydirection{ direction: ltr; }
                .pull-atherWay{ float: right; }
              </style>
        @endif


          @include('atlant.nav-side')

          @if(auth('Company')->check() )
              <div id="CompanySideMemberShip">
                  <a href="{{url('Company/CompanyMembership')}}">  <p>@lang('page.Membership')</p> </a>
              </div>
          @endif
            <!-- PAGE CONTENT -->
            <div class="page-content">


              @include('atlant.nav-top')

              @if ( $errors->any() )
                  <ul class="alert alert-danger mydirection" >
                     @foreach ($errors->all() as $error)
                       <li class="mydirection">{{$error}}</li>
                     @endforeach
                  </ul>
                @endif

                @if (Session::has('flash_message') )
                      <div class="alert alert-info mydirection">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <div class="mydirection">
                              <i class="fa fa-thumbs-o-up white font-medium-5 mt-1"></i>
                              {{Session::get('flash_message')}}
                          </div>
                       </div>
                @endif

                @if (Session::has('flash_message_danger') )
                      <div class="alert alert-danger mydirection">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <div class="mydirection">
                              <i class="fa fa-thumbs-o-down white font-medium-5 mt-1"></i>
                              {{Session::get('flash_message_danger')}}
                          </div>
                       </div>
                @endif


              @yield('content')


            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle myd">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> <strong> @lang('page.Log out')  </strong> ?</div>
                    <div class="mb-content">
                        <p>  @lang('page.Are you sure you want to log out?') </p>
                        <p> @lang('page.Press No if youwant to continue work. Press Yes to logout current user') .</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            {{-- <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a> --}}

                            <a href="{{ route('logout') }}"
                              onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-success btn-lg">
                                  @lang('page.Yes')
                            </a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     {{ csrf_field() }}
                                 </form>

                            <button class="btn btn-default btn-lg mb-control-close">@lang('page.No')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="{{asset('atlant/audio/alert.mp3')}}" preload="auto"></audio>
        <audio id="audio-fail" src="{{asset('atlant/audio/fail.mp3')}}" preload="auto"></audio>
        <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{{asset('atlant/js/plugins/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('atlant/js/plugins/jquery/jquery-ui.min.js')}}"></script>

        <script type="text/javascript" src="{{asset('atlant/js/plugins/bootstrap/bootstrap.min.js')}}"></script>
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='{{asset('atlant/js/plugins/icheck/icheck.min.js')}}'></script>
        <script type="text/javascript" src="{{asset('atlant/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

        <script type="text/javascript" src="{{asset('atlant/js/plugins/owl/owl.carousel.min.js')}}"></script>
        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="{{asset('atlant/js/plugins.js')}}"></script>
        <script type="text/javascript" src="{{asset('atlant/js/actions.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/jquery.validate.js')}}"></script>
        <script type="text/javascript" src="{{asset('sweetalert/sweetalert.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('select2/js/select2.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
        <!-- END TEMPLATE -->

        <script src="{{asset('atlant/js/plugins/noty/jquery.noty.js')}}"></script>
        <script src='{{asset('atlant/js/plugins/noty/layouts/topRight.js')}}'></script>
        <script src='{{asset('atlant/js/plugins/noty/themes/default.js')}}'></script>

        <script>
            let currrent_lang = '{{app()->getLocale()??'ar'}}';
            let showDeleteMessage = (name,delete_url) => new Promise((resolve,reject)=>{
                  swal({
                      title: " هل انت متاكد؟ ",
                      // text: "You want to delete ( "+name+" ) !",
                      text:  '!'+"انت تريد مسح "+'(' +name+ ')',
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: " ! نعم امسحها ",
                      cancelButtonText : " الغاء ",
                      closeOnConfirm: false
                  }, function () {

                        $.get(delete_url ,(responce)=>{
                              if (responce == 'true')
                              {
                                  swal("Deleted!", " تم المسح بنجاح ", "success");
                              }
                              else
                                  swal("Sorry!", " لا يمكن مسحها لتعلقها بامكن اخري ", "danger");
                           resolve();
                        });
                  });
            });


        </script>
  @yield('script')

    <!-- END SCRIPTS -->
    </body>
</html>
