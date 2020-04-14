<fieldset>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('telephone', 'Telephone:', ['class' => 'control-label']) !!}
                {!! Form::text('telephone', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('contact_first_name', 'Contact First Name:', ['class' => 'control-label']) !!}
                {!! Form::text('contact_first_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('contact_last_name', 'Contact Last Name:', ['class' => 'control-label']) !!}
                {!! Form::text('contact_last_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('contact_email', 'Contact Email:', ['class' => 'control-label']) !!}
                {!! Form::text('contact_email', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                {!! Form::label('remarks', 'Remarks:', ['class' => 'control-label']) !!}
                {!! Form::textarea('remarks', null, ['class'=> 'form-control', 'size' => '30x2']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-12">
            <div class="form-group">
                {!! Form::submit($submitTextButton, array('class' => $btnclass)) !!}
            </div>
        </div>
    </div>

</fieldset>





