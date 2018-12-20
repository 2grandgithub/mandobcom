@extends('atlant.blank')

@section('content')
      @php($active='Admin')
      @permission('mainSuperAdmin')
      <!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
  <div class="row">
      <div class="col-md-12">

<div class="page-title">
    <h2> @lang('page.Admin') </h2>
</div>
<!-- START PANEL WITH STATIC CONTROLS -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> @lang('page.Admin') </h3>
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

      <a class="btn btn-primary btn-rounded" href="{{url('Admin/create')}}"> @lang('page.add new')<i class="fa fa-plus mydir"></i> </a>
      <br><br>
      <div class="col-md-6 mydirection">
            <input type="text" class="form-control mydirection" id="inp_search" value="{{$val??''}}" placeholder=" @lang('page.search') " dir="rtl">
      </div>



      <table class="table mydirection">
          <thead>
            <th width="5%"> @lang('page.id') </th>
            <th> @lang('page.name') </th>
            <th> @lang('page.email') </th>
            <th> @lang('page.username') </th>
            <th> @lang('page.phone') </th>
            <th> @lang('page.role') </th>
            <th> @lang('page.more') </th>
          </thead>
          <tbody>
            @foreach ($admins as $admin)
                  <tr>
                       <td> {{$admin->id}} </td>
                       <td> {{$admin->name}} </td>
                       <td> {{$admin->email}} </td>
                       <td> {{$admin->username}} </td>
                       <td> {{$admin->phone}} </td>
                       <td>
                         @if ($admin->super_admin)
                             <span class="badge badge-info"> @lang('page.Full Power') </span>
                         @else
                             @isset($admin->get_Role->name)
                                {{$admin->get_Role->name}}
                             @endisset
                         @endif
                       </td>

                      <td>
                            <a href="{{url('Admin/edit/'.$admin->id)}}" class="btn btn-warning btn-rounded" > <i class="fa fa-pencil"></i> </a>
                            @if (!$admin->super_admin)
                              <button type="button" class="btn btn-danger btn-rounded" onclick="showDeleteMessage('{{url('Admin/delete/'.$admin->id)}}','{{$admin->name}}')" >
                                  <i class="glyphicon glyphicon-trash"></i>
                              </button>
                            @endif
                      </td>
                  </tr>
              @endforeach
          </tbody>

      </table>

      <div class="row">
            <div class="col-md-8 col-md-offset-5"> {{$admins->links()}} </div>
      </div>

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
    {{-- <script type="text/javascript" src="{{asset('atlant/js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script> --}}

    <script>
        var list_path = '{{asset('Admin')}}';
    </script>
    {{-- <script src="{{asset('js/Country.js')}}"> </script> --}}


@endsection
