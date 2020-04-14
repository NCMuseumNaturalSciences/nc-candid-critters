<h3>Site Information</h3>
<fieldset class="striped">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::label('county','In which county are you setting your camera?') !!} <span class="text-danger text-required">*</span>
                {!! Form::select('county', $counties, null, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                {!! Form::label('user_latitude','LATITUDE of this site (in this format please: 36.8465)') !!} <span class="text-danger text-required">*</span>
                {!! Form::text('user_latitude', null, ['class' => 'form-control', 'required', 'type' => 'number']) !!}
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                {!! Form::label('user_longitude','LONGITUDE of this site (in this format please: -81.8465)') !!} <span class="text-danger text-required">*</span>
                {!! Form::text('user_longitude', null, ['class' => 'form-control', 'required', 'type' => 'number']) !!}
            </div>
        </div>
        <small class="full-width form-text text-muted">You can use this link to get coordinates by clicking an online map: <a href="http://itouchmap.com/latlong.html">http://itouchmap.com/latlong.html</a>. Please Zoom In as far as possible!</small>
    </div>



    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('site_type', 'Site type') !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group">
                    {{ Form::rbGroup([
                            'id' => 'st1',
                            'rb-type' => 'primary',
                           'label' => 'Residential yard',
                           'name' => 'site_type',
                           'value' => 'Residential yard'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'st2',
                        'rb-type' => 'primary',
                       'label' => 'Forested Area',
                       'name' => 'site_type',
                       'value' => 'Forested Area',
                   ], $errors)
                   }}
                    {{ Form::rbGroup([
                       'id' => 'st3',
                       'rb-type' => 'primary',
                      'label' => 'Open area (Cemetary, Golf course, etc.)',
                      'name' => 'site_type',
                      'value' => 'Open area (Cemetary, Golf course, etc.)',
                           'required' => 'required'
                  ], $errors)
                  }}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('camera_facing', 'What is your camera facing?') !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group">
                    {{ Form::rbGroup([
                            'id' => 'cf1',
                            'rb-type' => 'primary',
                           'label' => 'Woods',
                           'name' => 'camera_facing',
                           'value' => 'Woods'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'cf2',
                        'rb-type' => 'primary',
                       'label' => 'Open Area',
                       'name' => 'camera_facing',
                       'value' => 'Open Area',
                       'required' => 'required'
                   ], $errors)
                   }}

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                {!! Form::label('property_type', 'What type of property is this?') !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group">
                    {{ Form::rbGroup([
                            'id' => 'pt1',
                            'rb-type' => 'primary',
                           'label' => 'Public',
                           'name' => 'property_type',
                           'value' => 'Public'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'pt2',
                        'rb-type' => 'primary',
                       'label' => 'Private',
                       'name' => 'property_type',
                       'value' => 'Private',
                       'required' => 'required'
                   ], $errors)
                   }}

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                {!! Form::label('property_name','Name of the property (if relevant)') !!}
                {!! Form::text('property_name', null, ['class' => 'form-control']) !!}
                <small class="form-text text-muted"></small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('fenced_yn', 'Is this property fenced?') !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group">
                    {{ Form::rbGroup([
                            'id' => 'fence3',
                            'rb-type' => 'primary',
                           'label' => 'Yes',
                           'name' => 'fenced_yn',
                           'value' => '1'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'fence4',
                        'rb-type' => 'primary',
                       'label' => 'No',
                       'name' => 'fenced_yn',
                       'value' => '0',
                       'required' => 'required'
                   ], $errors)
                   }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('hunting_yn', 'Is hunting or trapping allowed on the property?') !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group">
                    {{ Form::rbGroup([
                            'id' => 'hunter3',
                            'rb-type' => 'primary',
                           'label' => 'Yes',
                           'name' => 'hunting_yn',
                           'value' => '1'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'hunter4',
                        'rb-type' => 'primary',
                       'label' => 'No',
                       'name' => 'hunting_yn',
                       'value' => '0',
                       'required' => 'required'
                   ], $errors)
                   }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{ Form::textGroup([
                'label' => 'Give any details about hunting/trapping on this property that you can provide.',
                'name' => 'hunting_details',
                'md' => '12'
            ], $errors)
            }}
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('purposeful_feeding_yn', 'Do you know of any purposeful wildlife feeding within sight (~100 feet of you and/or your immediate neighbors).') !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group">
                    {{ Form::rbGroup([
                            'id' => 'pfeed1',
                            'rb-type' => 'primary',
                           'label' => 'Yes',
                           'name' => 'purposeful_feeding_yn',
                           'value' => '1'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'pfeed2',
                        'rb-type' => 'primary',
                       'label' => 'No',
                       'name' => 'purposeful_feeding_yn',
                       'value' => '0',
                       'checked' => 'checked',
                       'required' => 'required'
                   ], $errors)
                   }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('accidental_food_yn', 'Do you know of any accidental wildlife food within sight (~100 feet from you and your immediate neighbors)?') !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group">
                    {{ Form::rbGroup([
                            'id' => 'afeed1',
                            'rb-type' => 'primary',
                           'label' => 'Yes',
                           'name' => 'accidental_food_yn',
                           'value' => '1'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'afeed2',
                        'rb-type' => 'primary',
                       'label' => 'No',
                       'name' => 'accidental_food_yn',
                       'value' => '0',
                       'checked' => 'checked',
                       'required' => 'required'
                   ], $errors)
                   }}
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
                        <input class="form-check-input" type="checkbox" name="outside_dogs_yn" id="oc1" value="1">
                        <label class="form-check-label" for="oc1">
                            Dogs
                        </label>
                    </div>
                    <div class="form-check abc-checkbox abc-checkbox-primary">
                        <input class="form-check-input" type="checkbox" name="outside_cats_yn" id="oc2" value="1">
                        <label class="form-check-label" for="oc2">
                            Cats
                        </label>
                    </div><div class="form-check abc-checkbox abc-checkbox-primary">
                        <input class="form-check-input" type="checkbox" name="outside_chickens_yn" id="oc3" value="1">
                        <label class="form-check-label" for="oc3">
                            Chickens
                        </label>
                    </div><div class="form-check abc-checkbox abc-checkbox-primary">
                        <input class="form-check-input" type="checkbox" name="outside_horses_yn" id="oc4" value="1">
                        <label class="form-check-label" for="oc4">
                            Horses/cows/goats/sheep
                        </label>
                    </div><div class="form-check abc-checkbox abc-checkbox-primary">
                        <input class="form-check-input" type="checkbox" name="outside_none_yn" id="oc5" value="1">
                        <label class="form-check-label" for="oc5">
                            None
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
