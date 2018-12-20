<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <!-- META SECTION -->
        <title>Mandocom</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('atlant/css/theme-default.css')}}"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>

        <div class="login-container lightmode">

            <div class="login-box animated fadeInDown">
                <div class="login-logo">
                    {{-- <img src="{{asset('images/asset/logo-Lr.png')}}"  > --}}
                </div>
                <div class="login-body">
                    <div class="login-title"><strong>Log In</strong> to your account</div>
                    {{-- <form action="index.html" class="form-horizontal" method="post"> --}}
                   {!! Form::model($admin = new \App\Admin,['url'=>'login','class'=>'form-horizontal']) !!}
                    {{-- {{ csrf_field() }} --}}
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="اسم المستخدم " name="username" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="كلمة السر " name="password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        {{-- <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
                        </div> --}}
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block"> تسجيل الدخول </button>
                        </div>
                    </div>

                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2018 Mandocom
                    </div>
                    {{-- <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div> --}}
                </div>
            </div>

        </div>

    </body>
</html>
