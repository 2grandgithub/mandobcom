@extends('Site.layout.blank')

@section('content')

<section id="login_register">

    <!-- Linking -->
    <div class="linking">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="#">  @lang('page.Home') </a></li>
          <li class="active">  @lang('page.Authentication') </li>
        </ol>
      </div>
    </div>


    <!-- Blog -->
    <section class="login-sec padding-top-30 padding-bottom-100">
      <div class="container">

        {{-- <div class="row">
            <div class="col-md-6">
                <button type="button" name="button">d</button>
            </div><!--End col-md-6-->
            <div class="col-md-6">
                <button type="button" name="button">d</button>
            </div><!--End col-md-6-->
        </div><!--End row--> --}}

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
      {{--
        <div id="type_btns">
            <button type="button" name="button" v-on:click="user_type('buyer')"   :class="{'active':selected_user_type=='buyer'}">  </button>
            <button type="button" name="button" v-on:click="user_type('company')" :class="{'active':selected_user_type=='company'}">  </button>
        </div>
        --}}

        <div class="row">
          <div class="col-md-5" id="new-login">
            <!-- Login Your Account -->
            <h5> @lang('page.Login Your Account') </h5>

            <!-- FORM -->
            {!! Form::open(['url'=>'Site/login_register/login','id'=>'form_signIn']) !!}

              <input type="hidden" name="userType" :value="selected_user_type">

              <ul class="row">
                <li class="col-sm-12">
                   <label> @lang('page.type') </label>
                   <select class="form-control" name="aramex_CountryCode" v-model="selected_user_type" required  >
                       <option value="buyer"> @lang('page.Buyer single') </option>
                       <option value="company"> @lang('page.Company single') </option>
                   </select>
               </li>
                <li class="col-sm-12">
                  <label> @lang('page.email')
                    <input type="email" class="form-control" name="email" placeholder="" value="{{old('email')}}" required>
                  </label>
                </li>
                <li class="col-sm-12">
                  <label>  @lang('page.password')
                    <input type="password" class="form-control" name="password" placeholder="" required>
                  </label>
                </li>
                <li class="col-sm-6">
                  <div class="checkbox checkbox-primary">
                    <input id="cate1" class="styled" type="checkbox" name="keep_login" >
                    <label for="cate1"> @lang('page.Keep me logged in')   </label>
                  </div>
                </li>
                <li class="col-sm-6"> <a href="#." class="forget"> @lang('page.Forgot your password?') </a> </li>
                <li class="col-sm-12 text-left">
                  <button type="submit" class="btn-round"> @lang('page.Login') </button>
                </li>
              </ul>
            {!! Form::close() !!}
          </div>

          <!-- Don’t have an Account? Register now -->
          <div class="col-md-6" id="new-login2">
            <h5> @lang('page.Don’t have an Account? Register now') </h5>

            <!-- FORM -->
            {!! Form::open(['url'=>'Site/login_register/register','id'=>'form_signUp', 'v-on:submit.prevent' => 'signUp_submit()','files'=>true ]) !!}

              <input type="hidden" name="userType" :value="selected_user_type">
              <ul class="row">
                <li class="col-sm-12">
                   <label> @lang('page.type') </label>
                   <select class="form-control" name="aramex_CountryCode" v-model="selected_user_type" required  >
                       <option value="buyer"> @lang('page.Buyer single') </option>
                       <option value="company"> @lang('page.Company single') </option>
                   </select>
               </li>

                <li class="col-sm-12" v-if="selected_user_type=='company'">
                  <label> @lang('page.logo')
                    <input type="file" class="form-control" name="logo"   required>
                  </label>
                </li>
                <li class="col-sm-12" v-if="selected_user_type=='buyer'">
                  <label> @lang('page.name')
                    <input type="text" class="form-control" name="name" placeholder="" minlength="2" maxlength="30" required>
                  </label>
                </li>
                <li class="col-sm-12" v-if="selected_user_type=='company'">
                  <label> @lang('page.name_ar')
                    <input type="text" class="form-control" name="name_ar" placeholder="" minlength="2" maxlength="30" required>
                  </label>
                </li>
                <li class="col-sm-12" v-if="selected_user_type=='company'">
                  <label> @lang('page.name_en')
                    <input type="text" class="form-control" name="name_en" placeholder="" minlength="2" maxlength="30" required>
                  </label>
                </li>
                <li class="col-sm-12" id="li_signup_email">
                  <label> @lang('page.Email')
                    <input type="email" class="form-control" name="email" placeholder="" required id="up_email">
                  </label>
                  <span v-show="email_exist" style="color:red"> email exist </span>
                </li>
                <li class="col-sm-12">
                  <label> @lang('page.password')
                    <input type="password" class="form-control" name="password" placeholder="" id="password" minlength="6" maxlength="30" required>
                  </label>
                </li>
                <li class="col-sm-12">
                  <label> @lang('page.confirm password')
                    <input type="password" class="form-control" name="password_again" id="password_again" required>
                  </label>
                </li>

                 <li class="col-sm-12">
                  <label> @lang('page.Country')
                    <select class="form-control" name="aramex_CountryCode" v-model="Country_code" required v-on:change="CountryChanged()" >
                        <option value=""></option>
                        <option v-for="c in Aramex_Countries" :value="c.value" v-text="c.label"></option>
                    </select>
                  </label>
                </li>
                 <li class="col-sm-12">
                  <label> @lang('page.City')
                    <select class="form-control" name="aramex_City"  required>
                        <option value=""></option>
                        <option v-for="g in Aramex_Cities" :value="g" v-text="g"></option>
                    </select>
                  </label>
                </li>
                <li class="col-sm-12"  id="li_signup_phone">
                   <label> @lang('page.Phone')
                     <input type="number" class="form-control" name="phone" placeholder="" minlength="6" maxlength="20" id="up_phone" required>
                   </label>
                   <span v-show="phone_exist" style="color:red"> @lang('page.phone exist') </span>
                </li>
                <li class="col-sm-12">
                   <label> @lang('page.street')
                     <input type="text" class="form-control" name="street" placeholder=""  maxlength="200" required>
                   </label>
                </li>
                <li class="col-sm-12">
                   <label> @lang('page.building no')
                     <input type="text" class="form-control" name="building_no" maxlength="200" placeholder="" >
                   </label>
                </li>
                <li class="col-sm-12">
                   <label> @lang('page.zip code')
                     <input type="text" class="form-control" name="zip_code" minlength="2" maxlength="30" placeholder="" >
                   </label>
                </li>
                <li class="col-sm-12">
                   <label> @lang('page.Commercial Registration No')
                     <input type="text" class="form-control" name="CommercialRegistrationNo" minlength="2" maxlength="200" placeholder="" required>
                   </label>
                </li>
                <li class="col-sm-12">
                 <label> @lang('page.CommercialRegistrationType')
                   <select class="form-control" name="CommercialRegistrationType" required>
                       <option value=""></option>
                       <option v-for="crt in CommercialRegistrationType" :value="crt.value" v-text="crt.label"></option>
                   </select>
                 </label>
               </li>
                <li class="col-sm-12">
                   <label> @lang('page.Type Of Company Activity')
                     <input type="text" class="form-control" name="TypeOfCompanyActivity" minlength="2" maxlength="200" placeholder="" required>
                   </label>
                </li>
                <li class="col-sm-12">
                   <label> @lang('page.employees no')
                     <input type="text" class="form-control" name="employees_no"   maxlength="30" placeholder="" >
                   </label>
                </li>
                <li class="col-sm-12 text-left">

                  <!-- - - - - - -START spinner- - - - - - - -->
                  <spinner2 v-if="show_spinner"></spinner2>
                  <!-- - - - - - -End spinner- - - - - - - -->

                  <button type="submit" class="btn-round" :disabled="up_btn_disabled" id="btn-submit" > @lang('page.Register')  </button>
                </li>
              </ul>
           {!! Form::close() !!}
          </div>
        </div>
      </div>
    </section>

    <!-- Clients img -->



<section>

@endsection

@section('script')

    <script>
          let get_Aramex_Countries = JSON.parse(`{!!$Aramex_Countries!!}`);

    </script>
    <script src="{{asset('js_site/login_register.js')}}"> </script>

@endsection
