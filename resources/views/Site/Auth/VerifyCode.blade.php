@extends('Site.layout.blank')

@section('content')

<section id="VerificationCode">
      <br>
      <br>
      <div class="container" >
            @if ( $errors->any() )
                <ul class="alert alert-danger mydirection" >
                   @foreach ($errors->all() as $error)
                     <li class="mydirection">{{$error}}</li>
                   @endforeach
                </ul>
              @endif

              @if (Session::has('flash_message') )
                    <div class="alert alert-danger mydirection">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <div class="mydirection">
                            <i class="fa fa-thumbs-o-down white font-medium-5 mt-1"></i>
                            {{Session::get('flash_message')}}
                        </div>
                     </div>
              @endif
      </div>


   {!! Form::open(['url'=>'Site/VerificationCode','id'=>'VerificationCode_form', 'v-on:submit.prevent' => 'signUp_submit()' ]) !!}

      <div class="container four_inputs" >

          <h5> @lang('page.enter the code that send to you throw sms') </h5>

          <input type="text" name="" minlength="1" maxlength="1" v-model="n1" v-on:keyup="next_input($event)">
          <input type="text" name="" minlength="1" maxlength="1" v-model="n2" v-on:keyup="next_input($event)">
          <input type="text" name="" minlength="1" maxlength="1" v-model="n3" v-on:keyup="next_input($event)">
          <input type="text" name="" minlength="1" maxlength="1" v-model="n4" v-on:keyup="next_input($event)" >
      </div>

      <input type="hidden" name="code" v-mode="computedCode" :value="computedCode">
      <input type="hidden" name="user_type" :value="user_type">
      <input type="hidden" name="user_id" :value="user_id">

      <br>
         <center> <a :href="'{{url('Site/VerificationCode/resend_code')}}/'+user_type+'/'+user_id"> @lang('page.click for resend code') </a> </center>
      <br>
      <center>
        <button type="submit" class="btn-round" :disabled="up_btn_disabled" > @lang('page.verify') </button>
      </center>

  {!! Form::close() !!}
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <hr>
<section>

@endsection

@section('script')

    <script>
        let get_user_type = '{{$user_type}}';
        let get_user_id = '{{$user_id}}';
    </script>
    <script src="{{asset('js_site/VerificationCode.js')}}"> </script>

@endsection
