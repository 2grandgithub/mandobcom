@component('mail::message')

<div class="logo"> <a href="{{url('Site/Home')}}"><img src="{{asset('site_assets/images/logo.png')}}" alt="" ></a> </div>

  <h2>   <span>{{$user->name}}</span> اهلا  </h2>

  <p> من فضلك اكد علي البريد </p>


@component('mail::button', ['url' => url('api/verifyEmail/'.$type.'/'.$user->id) ])
  تاكيد البريد
@endcomponent

شكرا,<br>
{{ config('app.name') }}
@endcomponent
