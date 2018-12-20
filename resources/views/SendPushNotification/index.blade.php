

@component('components.panel_default_with_blank')
    @slot('active') SendPushNotification @endslot
    @slot('page_title') ارسال الاشعارات  @endslot
    @slot('panel_title') ارسال الاشعارات @endslot

    @slot('body')
        <div id="myVue">

          <br>
          {!! Form::model($Setting = new \App\Setting,['url'=>'SendPushNotification','id'=>'create_form'   ]) !!}


            <div class="row">
                <div class="col-md-6">

                  <div class="form-group">
                      <div class="col-md-6 col-xs-12">
                          <label class="check"> المسجلين <input type="checkbox" name="registred" class="icheckbox" checked="checked"/>  </label>
                      </div>
                  </div>
                  <br>
                  <div class="form-group">
                      <div class="col-md-6 col-xs-12">
                          <label class="check"> الغير مسجلين <input type="checkbox" name="notRegistred" class="icheckbox" checked="checked"/>  </label>
                      </div>
                  </div>
                  <br><br>

                        <div class="form-group">
                          <label for=""> عنوان </label>
                          {!! Form::text('title',null,['class'=>'form-control','required' ]) !!}
                        </div>

                        <div class="form-group">
                          <label for=""> المحتوي </label>
                          {!! Form::textarea('body',null,['class'=>'form-control','required','rows'=>'4']) !!}
                        </div>

                        <div class="form-group">
                          <label for=""> الصورة </label>
                          {!! Form::file('image',['class'=>'form-control','onchange'=>'show_temp_image(this)']) !!}
                        </div>
                </div><!--end col-md-6-->

                <div class="col-md-6">

                    <img src="" class="img-img-thumbnail" id="edit_image">

                </div><!--end col-md-6-->
            </div><!--End row-->
            <br>
            {!! Form::submit( ' ارسال ',['class'=>'btn btn-success']) !!}

          {!! form::close() !!}


       </div><!--End myVue-->
    @endslot

    @slot('script')
        <script>
           $('#create_form').validate();


           function show_temp_image(input)
           {
                  if (input.files && input.files[0])
                  {
                      var reader = new FileReader();

                      reader.onload = function (e) {
                         $('#edit_image').attr('src', e.target.result).addClass('img-thumbnail');
                      }
                      reader.readAsDataURL(input.files[0]);
                  }
           }

        </script>
    @endslot

@endcomponent
