<fieldset class="striped">
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('county','In which county are you setting your camera?') !!}
                {!! Form::select('county', $counties, $model->county, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('user_latitude','LATITUDE of this site (in this format please: 36.8465)') !!}
                {!! Form::text('user_latitude', null, ['class' => 'form-control', 'type' => 'number']) !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('user_longitude','LONGITUDE of this site (in this format please: -81.8465)') !!}
                {!! Form::text('user_longitude', null, ['class' => 'form-control', 'type' => 'number']) !!}
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('site_type', 'Site type') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="site_type_a"
                               value="Residential yard"
                               name="site_type"
                               @if($model->site_type == 'Residential yard') checked @endif>
                        <label class="form-check-label" for="site_type_a">Residential yard</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="site_type_b"
                               value="Forested Area"
                               name="site_type"
                               @if($model->site_type == 'Forested Area') checked @endif>
                        <label class="form-check-label" for="site_type_b">Forested Area</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="site_type_c"
                               value="Open area (Cemetary, Golf course, etc.)"
                               name="site_type"
                               @if($model->site_type == 'Open area (Cemetary, Golf course, etc.)') checked @endif>
                        <label class="form-check-label" for="site_type_c">Open area (Cemetary, Golf course, etc.)</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('camera_facing', 'What is your camera facing?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="camera_facing_y"
                               value="Woods"
                               name="camera_facing"
                               @if($model->camera_facing == 'Woods') checked @endif>
                        <label class="form-check-label" for="camera_facing_y">Woods</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="camera_facing_n"
                               value="Open Area"
                               name="camera_facing"
                               @if($model->camera_facing == 'Open Area') checked @endif>
                        <label class="form-check-label" for="camera_facing_n">Open Area</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('property_type', 'What type of property is this?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="property_type_y"
                               value="Public"
                               name="property_type"
                               @if($model->property_type == 'Public') checked @endif>
                        <label class="form-check-label" for="property_type_y">Public</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="property_type_n"
                               value="Private"
                               name="property_type"
                               @if($model->property_type == 'Private') checked @endif>
                        <label class="form-check-label" for="property_type_n">Private</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('property_name','Name of the property (if relevant)') !!}
                {!! Form::text('property_name', null, ['class' => 'form-control']) !!}
                <small class="form-text text-muted"></small>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('fenced_yn', 'Is this property fenced?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="fenced_y"
                               value="1"
                               name="fenced_yn"
                               @if($model->fenced_yn == 1) checked @endif>
                        <label class="form-check-label" for="fenced_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="fenced_n"
                               value="0"
                               name="fenced_yn"
                               @if($model->fenced_yn == 0) checked @endif>
                        <label class="form-check-label" for="fenced_n">No</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('hunting_yn', 'Is hunting or trapping allowed on the property?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="hunting_y"
                               value="1"
                               name="hunting_yn"
                               @if($model->hunting_yn == 1) checked @endif>
                        <label class="form-check-label" for="hunting_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="hunting_n"
                               value="0"
                               name="hunting_yn"
                               @if($model->hunting_yn == 0) checked @endif>
                        <label class="form-check-label" for="hunting_n">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{ Form::textGroup([
                'label' => 'Give any details about hunting/trapping on this property that you can provide.',
                'name' => 'hunting_details',
                'md' => '4'
            ], $errors)
            }}
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('purposeful_feeding_yn', 'Do you know of any purposeful wildlife feeding within sight (~100 feet of you and/or your immediate neighbors).') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="purposeful_feeding_y"
                               value="1"
                               name="purposeful_feeding_yn"
                               @if($model->purposeful_feeding_yn == 1) checked @endif>
                        <label class="form-check-label" for="purposeful_feeding_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="purposeful_feeding_n"
                               value="0"
                               name="purposeful_feeding_yn"
                               @if($model->purposeful_feeding_yn == 0) checked @endif>
                        <label class="form-check-label" for="purposeful_feeding_n">No</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('accidental_food_yn', 'Do you know of any accidental wildlife food within sight (~100 feet from you and your immediate neighbors)?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="accidental_food_y"
                               value="1"
                               name="accidental_food_yn"
                               @if($model->accidental_food_yn == 1) checked @endif>
                        <label class="form-check-label" for="accidental_food_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="accidental_food_n"
                               value="0"
                               name="accidental_food_yn"
                               @if($model->accidental_food_yn == 0) checked @endif>
                        <label class="form-check-label" for="accidental_food_n">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label class="form-label">Do you have any outside pets/livestock using this site? Check all that apply. <span class="text-danger">*</span></label>
                <div class="cb-group">
                    <div class="form-check abc-checkbox abc-checkbox-primary">
                        <input class="form-check-input" type="checkbox" name="outside_dogs_yn" id="oc1" value="1" @if($model->outside_dogs_yn == 1) checked @endif>
                        <label class="form-check-label" for="oc1">
                            Dogs
                        </label>
                    </div>
                    <div class="form-check abc-checkbox abc-checkbox-primary">
                        <input class="form-check-input" type="checkbox" name="outside_cats_yn" id="oc2" value="1" @if($model->outside_cats_yn == 1) checked @endif>
                        <label class="form-check-label" for="oc2">
                            Cats
                        </label>
                    </div><div class="form-check abc-checkbox abc-checkbox-primary">
                        <input class="form-check-input" type="checkbox" name="outside_chickens_yn" id="oc3" value="1" @if($model->outside_chickens_yn == 1) checked @endif>
                        <label class="form-check-label" for="oc3">
                            Chickens
                        </label>
                    </div><div class="form-check abc-checkbox abc-checkbox-primary">
                        <input class="form-check-input" type="checkbox" name="outside_horses_yn" id="oc4" value="1" @if($model->outside_horses_yn == 1) checked @endif>
                        <label class="form-check-label" for="oc4">
                            Horses/cows/goats/sheep
                        </label>
                    </div><div class="form-check abc-checkbox abc-checkbox-primary">
                        <input class="form-check-input" type="checkbox" name="outside_none_yn" id="oc5" value="1" @if($model->outside_none_yn == 1) checked @endif>
                        <label class="form-check-label" for="oc5">
                            None
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
