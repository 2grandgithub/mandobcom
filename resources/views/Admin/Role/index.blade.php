
@extends('atlant.blank')

@section('content')
      @php($active='Role')

      <!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
  <div class="row">
      <div class="col-md-12">

<div class="page-title">
    <h2> @lang('page.Roles') </h2>
</div>
<!-- START PANEL WITH STATIC CONTROLS -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> @lang('page.Roles') </h3>
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

      <a href="{{url('Role/create')}}" class="btn btn-primary btn-rounded" > @lang('page.add new')<i class="fa fa-plus mydir"></i> </a>
      <br><br>
      <div class="col-md-6 mydirection">
            <input type="text" class="form-control mydirection" id="inp_search" value="{{$val??''}}" placeholder=" @lang('page.search') " dir="rtl">
      </div>


      <table class="table mydirection">
          <thead>
            <th> @lang('page.name') </th>
            <th> @lang('page.comment') </th>
            <th> @lang('page.more') </th>
          </thead>
          <tbody>
            @foreach ($roles as $role)
                  <tr>
                        <td> {{$role->name}} </td>
                        <td> {{$role->comment}} </td>
                        <td>
                              <a href="{{url('Role/edit/'.$role->id)}}" class="btn btn-warning btn-rounded" >
                                  <i class="fa fa-pencil"></i>
                              </a>
                                {{-- <a href="{{url('Patient/'.$role->id)}}" class="btn btn-primary btn-rounded"> <i class="fa fa-search"></i> </a> --}}
                        </td>
                  </tr>
              @endforeach
          </tbody>

      </table>

      <div class="row">
            <div class="col-md-8 col-md-offset-5"> {{$roles->links()}} </div>
      </div>

    </div><!--End panel-body-->
   </div>

 </div><!--End col-md-12-->
</div><!--End row -->
</div><!--End page-content-wrap-->
<!-- END PANEL WITH STATIC CONTROLS -->




@endsection


@section('script')
    {{-- <script type="text/javascript" src="{{asset('atlant/js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script> --}}

    <script>
        var list_path = '{{asset('Role')}}';
    </script>
    {{-- <script src="{{asset('js/Country.js')}}"> </script> --}}


@endsection
