<fieldset>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('first_name', 'First Name:', ['class' => 'control-label']) !!}
                {!! Form::text('first_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('last_name', 'Last Name:', ['class' => 'control-label']) !!}
                {!! Form::text('last_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                {!! Form::text('email', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('emammal_user_id', 'Emammal User ID:', ['class' => 'control-label']) !!}
                {!! Form::text('emammal_user_id', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('delivery_method', 'Delivery Method', ['class' => 'col-form-label']) !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="delivery_method_y"
                               value="0"
                               name="delivery_method"
                               @if($model->delivery_method == 'On SD cards via US Mail') checked @endif>
                        <label class="form-check-label" for="delivery_method_y">On SD cards via US Mail</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="delivery_method_n"
                               value="1"
                               name="delivery_method"
                               @if($model->delivery_method == 'Digitally using a file-sharing system like Dropbox or Google Drive') checked @endif>
                        <label class="form-check-label" for="delivery_method_n">Digitally using a file-sharing system like Dropbox or Google Drive</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row btn-row">
        <div class="col-xs-12">
            <div class="form-group">
                {!! Form::submit($submitTextButton, array('class' => $btnclass)) !!}
            </div>
        </div>
    </div>
</fieldset>