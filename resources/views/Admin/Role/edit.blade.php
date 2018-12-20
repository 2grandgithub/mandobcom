
@extends('atlant.blank')

@section('content')
      @php($active='Role')

      <style>
        tr td:first-child
        {
            font-weight: bold;
        }
      </style>

      <!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
  <div class="row">
      <div class="col-md-12">

        <!-- START BREADCRUMB -->
        <ul class="breadcrumb">
            <li class="active"> @lang('page.edit') </li>
            <li><a href="{{url('Role')}}"> @lang('page.Role') </a></li>
        </ul>
        <!-- END BREADCRUMB -->
<!-- START PANEL WITH STATIC CONTROLS -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> @lang('page.edit Role') </h3>
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
      {!! Form::model($role,['method'=>'PATCH','url'=>['Role',$role->id], 'id'=>'create_form' ]) !!}

      <div class="col-md-6">
          {!! Form::label('name',__('page.name')) !!}
          {!! Form::text('name',null,['class'=>'form-control','required']) !!}

          {!! Form::label('comment',__('page.comment')) !!}
          {!! Form::textarea('comment',null,['class'=>'form-control','rows'=>'3','required']) !!}
          <br>
      </div><!--End col-md-6-->

      <table class="table table-bordered mydirection">

          <thead>
              <th width="15%"> @lang('page.place') </th>
              <th> @lang('page.permissions')
                <span class="pull-atherWay">
                    <button type="button" class="btn btn-success btn-condensed" id="btn_all"> <i class="fa fa-check-square-o"></i> </button>
                </span>
              </th>
          </thead>
          <tbody>

            <tr>  <!-- ============ DashBoard ===============  -->
              <td> @lang('page.DashBoard') </td>
              <td>
                  {!! Form::label('DashBoard',__('page.DashBoard')) !!} <br>
                  <label class="switch">
                      <input type="checkbox" class="switch" value="19" name="permissions[]" {{array_search('19', $selected_permissions)?'checked':''}} />
                      <span></span>
                  </label>
              </td>
            </tr>

            <tr>  <!-- ============ location ===============  -->
                <td> @lang('page.City') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('City',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="11" name="permissions[]" {{array_search('', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('City_status',__('page.status')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="12" name="permissions[]" {{array_search('', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('City_edit',__('page.edit')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="13" name="permissions[]" {{array_search('11', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('City_delete',__('page.delete')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="14" name="permissions[]" {{array_search('14', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>
            <tr>  <!-- ============ location ===============  -->
                <td> @lang('page.Governorate') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('Governorate',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="20" name="permissions[]" {{array_search('20', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Governorate_status',__('page.status')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="21" name="permissions[]" {{array_search('21', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Governorate_edit',__('page.edit')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="22" name="permissions[]" {{array_search('22', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Governorate_delete',__('page.delete')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="23" name="permissions[]" {{array_search('23', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>
            <tr>  <!-- ============ location ===============  -->
                <td> @lang('page.Category') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('Category',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="7" name="permissions[]" {{array_search('7', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Category_status',__('page.status')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="8" name="permissions[]" {{array_search('8', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Category_edit',__('page.edit')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="9" name="permissions[]" {{array_search('9', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Category_delete',__('page.delete')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="10" name="permissions[]" {{array_search('10', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>
            <tr>  <!-- ============ location ===============  -->
                <td> @lang('page.Company') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('Company',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="15" name="permissions[]" {{array_search('15', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Company_status',__('page.status')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="16" name="permissions[]" {{array_search('16', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Company_accapt',__('page.accaptance')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="17" name="permissions[]" {{array_search('17', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Company_delete',__('page.delete')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="18" name="permissions[]" {{array_search('18', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>
            <tr>  <!-- ============ location ===============  -->
                <td> @lang('page.Buyer') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('Buyer',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="3" name="permissions[]" {{array_search('3', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Buyer_status',__('page.status')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="4" name="permissions[]" {{array_search('4', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Buyer_accapt',__('page.accaptance')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="5" name="permissions[]" {{array_search('5', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Buyer_delete',__('page.delete')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="6" name="permissions[]" {{array_search('6', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>
            <tr>  <!-- ============ location ===============  -->
                <td> @lang('page.Recycable') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('Recycable',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="39" name="permissions[]" {{array_search('39', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Recycable_status',__('page.status')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="42" name="permissions[]" {{array_search('42', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Recycable_accapt',__('page.accaptance')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="40" name="permissions[]" {{array_search('40', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Recycable_delete',__('page.delete')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="41" name="permissions[]" {{array_search('41', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>
            <tr>  <!-- ============ location ===============  -->
                <td> @lang('page.ProducerFamily') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('ProducerFamily',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="30" name="permissions[]" {{array_search('30', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('ProducerFamily_status',__('page.status')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="31" name="permissions[]" {{array_search('31', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('ProducerFamily_accapt',__('page.accaptance')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="32" name="permissions[]" {{array_search('32', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('ProducerFamily_delete',__('page.delete')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="33" name="permissions[]" {{array_search('33', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>
            <tr>  <!-- ============ location ===============  -->
                <td> @lang('page.RecycablesNews') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('RecycablesNews',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="53" name="permissions[]" {{array_search('53', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('RecycablesNews_status',__('page.status')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="54" name="permissions[]" {{array_search('54', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('RecycablesNews_edit',__('page.edit')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="55" name="permissions[]" {{array_search('55', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('RecycablesNews_delete',__('page.delete')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="56" name="permissions[]" {{array_search('56', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>
            <tr>  <!-- ============ RecycablesWhenfullRequests ===============  -->
                <td> @lang('page.RecycablesWhenfullRequests') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('RecycablesWhenfullRequests',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="46" name="permissions[]" {{array_search('46', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('RecycablesWhenfullRequests_done',__('page.make done')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="47" name="permissions[]" {{array_search('47', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('RecycablesWhenfullRequests_delete',__('page.edit')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="48" name="permissions[]" {{array_search('48', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>
            <tr>  <!-- ============ Item ===============  -->
                <td> @lang('page.Item') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('Item',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="24" name="permissions[]" {{array_search('24', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Item_status',__('page.status')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="25" name="permissions[]" {{array_search('25', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            {!! Form::label('Item_delete',__('page.delete')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="26" name="permissions[]" {{array_search('26', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>
            <tr>  <!-- ============ Offer ===============  -->
                <td> @lang('page.Offer') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('Offer',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="27" name="permissions[]" {{array_search('27', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('Offer_status',__('page.status')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="28" name="permissions[]" {{array_search('28', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            {!! Form::label('Offer_delete',__('page.delete')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="29" name="permissions[]" {{array_search('29', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>
            <tr>  <!-- ============ ProducerFamilyProduct ===============  -->
                <td> @lang('page.ProducerFamilyProduct') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('ProducerFamilyProduct',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="34" name="permissions[]" {{array_search('34', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('ProducerFamilyProduct_status',__('page.status')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="35" name="permissions[]" {{array_search('35', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            {!! Form::label('ProducerFamilyProduct_delete',__('page.delete')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="36" name="permissions[]" {{array_search('36', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>
            <tr>  <!-- ============ Recipt ===============  -->
                <td> @lang('page.Recipt') </td>
                <td>
                    <div class="row ">
                        <div class="col-md-3">
                            {!! Form::label('Recipt',__('page.main')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="37" name="permissions[]" {{array_search('37', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            {!! Form::label('Recipt_delete',__('page.delete')) !!} <br>
                            <label class="switch">
                                <input type="checkbox" class="switch" value="38" name="permissions[]" {{array_search('38', $selected_permissions)?'checked':''}} />
                                <span></span>
                            </label>
                        </div>
                    </div><!--End row-->
                </td>
            </tr>


        </tbody>
      </table>

      {!! Form::submit(__('page.update'),['class'=>'btn btn-success ','style'=>'width:100%']) !!}

      <br><br>
    {!! Form::close() !!}

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
          $('#create_form').validate();
          var checked_status = 'not_checkedAll';

          $('#btn_all').click(function(event) {
              if (checked_status == 'not_checkedAll')
              {
                  $('input[type=checkbox]').prop('checked',true);
                  $(this).removeClass('btn-success');
                  $(this).addClass('btn-danger');
                  checked_status = 'checkedAll';
              }
              else if (checked_status == 'checkedAll')
              {
                  $('input[type=checkbox]').prop('checked',false);
                  $(this).removeClass('btn-danger');
                  $(this).addClass('btn-success');
                  checked_status = 'not_checkedAll';
              }
          });
    </script>
    {{-- <script src="{{asset('js/Country.js')}}"> </script> --}}


@endsection
