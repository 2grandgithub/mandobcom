
@extends('atlant.blank')

@section('content')
      @php($active='Admin')
      @permission('mainSuperAdmin')
      <style media="screen">

        .inp_error
        {
            border: 1px solid red;
        }
      </style>

      <!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
  <div class="row">
      <div class="col-md-12"  >

          <!-- START BREADCRUMB -->
          <ul class="breadcrumb">
              <li class="active"> @lang('page.edit') </li>
              <li><a href="{{url('Admin')}}"> @lang('page.Admin') </a></li>
          </ul>
          <!-- END BREADCRUMB -->

<!-- START PANEL WITH STATIC CONTROLS -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> @lang('page.edit Admin') </h3>
        <ul class="panel-controls">
            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span> Refresh</a></li>
                </ul>
            </li>
            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
        </ul>
    </div>

      <div class="panel-body">

        {!! Form::model($admin,['method'=>'PATCH','url'=>['Admin',$admin->id],'id'=>'create_form']) !!}


        <div class="row">
            <div class="col-md-6">
                  {!! Form::label('name',__('page.name')) !!}
                  {!! Form::text('name',null,['class'=>'form-control','required']) !!}

                  {!! Form::label('username',__('page.username')) !!}
                  {!! Form::text('username',null,['class'=>'form-control','required']) !!}

                  {!! Form::label('password',__('page.password')) !!}
                  {!! Form::password('password',['class'=>'form-control','id'=>'password','minlength'=>'6']) !!}

                  {!! Form::label('password_again',__('page.password again')) !!}
                  {!! Form::password('password_again',['class'=>'form-control','id'=>'password_again','minlength'=>'6']) !!}

            </div><!--End col-md-6-->
            <div class="col-md-6">
                  {!! Form::label('email',__('page.email')) !!}
                  {!! Form::email('email',null,['class'=>'form-control','required']) !!}

                  {!! Form::label('phone',__('page.phone')) !!}
                  {!! Form::number('phone',null,['class'=>'form-control','required']) !!}

                  {!! Form::label('role_id',__('page.role')) !!}
                  {!! Form::select('role_id',$roles,null,['class'=>'form-control','required']) !!}
            </div><!--End col-md-6-->
        </div><!--End row-->


        <br><br>
        {!! Form::submit(__('page.update'),['class'=>'btn btn-success ' ]) !!}

        <br><br>
      {!! Form::close() !!}


      </div><!--End panel-body-->
     </div>

   </div><!--End col-md-12-->
  </div><!--End row -->
  </div><!--End page-content-wrap-->
  <!-- END PANEL WITH STATIC CONTROLS -->


@else
<br><br>
<div class="container">
  <h2> @lang('page.you dont have a permissions') </h2>
</div>
@endpermission


@endsection


@section('script')
  <script>
  $(document).ready(function() { console.log('d');
        $('#create_form').validate({
          rules: {
              password_again: {
                equalTo: "#password"
              }}
        });
  });


  </script>


@endsection
