<fieldset>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('make', 'Make:', ['class' => 'control-label']) !!}
                {!! Form::text('make', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('model', 'Model:') !!}
                {!! Form::text('model', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('model_number', 'Model Number:') !!}
                {!! Form::text('model_number', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('trigger_speed', 'Trigger Speed:') !!}
                {!! Form::text('trigger_speed', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                {!! Form::label('product_url', 'Product URL:', ['class' => 'control-label']) !!}
                {!! Form::text('product_url', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                {!! Form::label('acceptable_yn', 'Acceptable?') !!}<br>
                <div class="rb-group">
                    {{ Form::rbGroup([
                        'id' => 'ac1',
                        'rb-type' => 'primary',
                        'label' => 'Yes',
                        'name' => 'acceptable_yn',
                        'value' => '1'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'ac2',
                        'rb-type' => 'primary',
                        'label' => 'No',
                        'name' => 'acceptable_yn',
                        'value' => '0',
                   ], $errors)
                   }}
                </div>
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
</fieldset>

<div class="row btn-row">
    <div class="form-group">
        {!! Form::submit($submitTextButton, array('class' => $btnclass)) !!}
    </div>
</div>





