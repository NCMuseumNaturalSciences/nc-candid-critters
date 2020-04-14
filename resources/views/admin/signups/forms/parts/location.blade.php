<fieldset>
    <h4>Location</h4>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('county', 'Please select the COUNTY where you want to run the camera:') !!}<span class="text-danger text-required">*</span>
                {!! Form::select('county', $counties, null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
</fieldset>