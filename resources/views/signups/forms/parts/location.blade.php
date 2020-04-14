<h3>Location</h3>
<fieldset>
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="form-group">
                {!! Form::label('county', 'Please select the COUNTY where you want to run the camera:') !!}<span class="text-danger text-required">*</span>
                {!! Form::select('county', $counties, null, ['class'=> 'form-control', 'required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::cbGroup([
                    'cbtype' => 'primary',
                    'value' => '1',
                    'name' => 'confirm_nc_yn',
                    'id' => 'confirmNC',
                    'label' => 'I confirm my camera will be deployed in North Carolina.',
                    'required' => 'required'
                ], $errors)
                }}

            </div>
        </div>
    </div>
</fieldset>