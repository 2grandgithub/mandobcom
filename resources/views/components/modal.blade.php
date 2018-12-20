
<div class="container">
  {{-- <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> --}}

  <!-- Modal -->
  <div class="modal fade" id="{{$id}}" role="dialog">
    {{$form_header ?? ''}}
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        {{$top_body ?? ''}}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> {{$header??''}} </h4>
        </div>
        <div class="modal-body">
          {{$body??''}}
        </div>
        <div class="modal-footer">
            {{$submit_input??''}}
          <button type="button" class="btn btn-default" data-dismiss="modal"> الغاء </button>
        </div>
      </div>

    </div>
  </div>
  @isset($form_header)
      {!! Form::close() !!}
    @endisset
</div>
