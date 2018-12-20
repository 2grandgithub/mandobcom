@extends('atlant.blank')

@section('content')
      @php($active='Chat')

      @permission('chat')

<!-- START BREADCRUMB -->
<ul class="breadcrumb push-down-0">
    {{-- <li><a href="#">Home</a></li>
    <li><a href="#">Pages</a></li> --}}
    <li class="active"> الرسائل </li>
</ul>
<!-- END BREADCRUMB -->

<!-- START CONTENT FRAME -->
<div class="content-frame " id="myChat">
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-comments"></span> الرسائل </h2>
        </div>
        {{-- <div class="pull-right">
            <button class="btn btn-danger"><span class="fa fa-book"></span> Contacts</button>
            <button class="btn btn-default content-frame-right-toggle"><span class="fa fa-bars"></span></button>
        </div> --}}
    </div>
    <!-- END CONTENT FRAME TOP -->

    <!-- START CONTENT FRAME RIGHT -->

      <div class="content-frame-left">



        <div class="list-group list-group-contacts border-bottom push-down-10" dir="rtl"  >
            <a href="#" class="list-group-item" v-for="user in users" v-on:click="choose_user(user)" dir="rtl">
                <div class="list-group-status status-online"></div>
                <img src="{{asset('atlant/assets/images/users/user.jpg')}}" class="pull-left" alt="img" >
                <div class="contacts-title" >
                  <span class="contacts-title" v-if="user.name" > @{{user.name}} </span>
                  <span class="contacts-title" v-else-if="user.model"> @{{user.model}} </span>
                  <span class="contacts-title" v-else> لا يتوفر اسم </span>
                    {{-- <span class="label label-danger" dir="rtl">new</span> --}}
                </div>
                <p > رسالة </p>

            </a>
        </div>

    </div>
    <!-- END CONTENT FRAME RIGHT -->

    <!-- START CONTENT FRAME BODY -->
      <div class="content-frame-body content-frame-body-right ">


        <div class="messages messages-img" id="chat_container" style="height:750px" v-chat-scroll="{always: false, smooth: true}">

            <div  v-for="chat in the_chat" v-bind:class="['item', {'in' : checkifAdmin(chat)  } , 'item-visible' ] "  >
                <div class="image">
                    <img src="{{asset('atlant/assets/images/users/user.jpg')}}" v-if="chat.admin_id">
                    <img src="{{asset('atlant/assets/images/users/user2.jpg')}}" v-else>
                </div>
                <div class="text mydirection">
                    <div class="heading ">
                        <a href="#" v-if="chat.admin_id"> مشرف </a>
                        <a v-else >
                              <span v-if="current_user_model.name"> @{{current_user_model.name}} </span>
                              <span v-else-if="current_user_model.model"> @{{current_user_model.model}} </span>
                        </a>
                        <span class="date"> @{{chat.created_at}} </span>
                    </div>
                      <span v-if="chat.message_type=='text'"> @{{chat.message}} </span>
                      <span v-if="chat.message_type=='image'">
                          <img :src="'{{asset('images/chat')}}/'+chat.message" width="200px">
                       </span>
                </div>
            </div><!--End v-for -->

            <!-- - - - - - -START spinner- - - - - - - -->
            <spinner3 v-if="show_spinner"></spinner3>
            <!-- - - - - - -End spinner- - - - - - - -->

        </div> <!--End messages-->
  {!! Form::open([ 'id'=>'send_form' ,'v-on:submit.prevent'=>'send()','files'=>true]) !!}
        <!-------send buttton------------>
        <div class="panel panel-default push-up-10">
            <div class="panel-body panel-body-search">
                <div class="input-group mydirection">

                    <div class="input-group-btn">
                        {{-- <button class="btn btn-default" v-on:click="camera_click()" ><span class="fa fa-camera"></span></button> <!-- v-on:click="camera_click()"--> --}}
                        <button type="button" class="btn btn-default" v-on:click="get_down()"> <i class="fa fa-arrow-circle-down"></i> </button>
                    </div>

                        <input type="text" class="form-control" name="the_message" placeholder=" ارسل نص " v-model='inp_message'  />

                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"> ارسال </button>
                    </div>

                </div>
            </div>
        </div>
        <input type="file" name="image" id="inp_image" style="display:none" v-on:change="image_change()"> <!-- v-on:change='send($event)' -->
      {!! form::close() !!}
    </div>
    <!-- END CONTENT FRAME BODY -->
</div>
<!-- END PAGE CONTENT FRAME -->
</div>
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<audio style="display:none;" id="sound">
    <source :src="sound" type="audio/mpeg">
    <embed src="mysound.mp3" hidden="true" autostart="false" loop="false" class="playSound" />
</audio>

<style media="screen">
  .messages
  {
    max-height: 65vh;
    overflow-y: auto;
  }
</style>

@else <!--IF don't have a permission --->
    <br><br>
    <div class="container">
        <h2> ليس لديك الصلاحية </h2>
    </div>
@endpermission


@endsection


@section('script')
    {{-- <script type="text/javascript" src="{{asset('atlant/js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script> --}}

    <script>
        var api_get_chat_users = '{{url('Chat/get_chat_users_type_Buyer')}}';
        var api_get_latest_chat = '{{url('Chat/get_latest_chat')}}';
        var api_get_chat = '{{url('Chat/get_chat')}}'; //by user id
        var api_Chat = '{{url('Chat')}}'; //by user id
        var token = '{{csrf_token()}}'; //by user id
        let user_type = 'Buyer';
    </script>
    <script type="text/javascript" src="{{asset('js/Chat.js')}}"></script>


@endsection
