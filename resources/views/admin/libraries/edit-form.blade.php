<fieldset>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('library_name', 'Library Name:', ['class' => 'control-label']) !!}
                {!! Form::text('library_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('telephone', 'Telephone:', ['class' => 'control-label']) !!}
                {!! Form::text('telephone', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('contact_first_name', 'Contact First Name:', ['class' => 'control-label']) !!}
                {!! Form::text('contact_first_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('contact_last_name', 'Contact Last Name:', ['class' => 'control-label']) !!}
                {!! Form::text('contact_last_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('contact_email', 'Contact Email:', ['class' => 'control-label']) !!}
                {!! Form::text('contact_email', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('street_address', 'Street Address:', ['class' => 'control-label']) !!}
                {!! Form::text('street_address', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('city', 'City:', ['class' => 'control-label']) !!}
                {!! Form::text('city', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('zip', 'Zip:', ['class' => 'control-label']) !!}
                {!! Form::text('zip', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('county', 'County:', ['class' => 'control-label']) !!}
                {!! Form::select('County', $nccounties, $library->county, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('region', 'Region:', ['class' => 'control-label']) !!}
                {!! Form::select('Region', $regions, $library->region, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('lat', 'Latitude:', ['class' => 'control-label']) !!}
                {!! Form::text('lat', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('lon', 'Longitude:', ['class' => 'control-label']) !!}
                {!! Form::text('lon', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 col-xs-12">
            <label class="col-md-3 col-form-label">Partner?</label>
            <div class="col-md-9 col-form-label">
                @if ($library->partner_yn == '1')
                    <div class="form-check">
                        {{ Form::radio('partner_yn', '1', true, ['checked' => 'checked', 'class' => 'form-check-input', 'id' => 'radio1']) }}
                        <label class="form-check-label" for="radio1">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('partner_yn', '0', false, ['class' => 'form-check-input', 'id' => 'radio2']) }}
                        <label class="form-check-label" for="radio2">
                            No
                        </label>
                    </div>
                @else
                    <div class="form-check">
                        {{ Form::radio('partner_yn', '1', true, ['class' => 'form-check-input', 'id' => 'radio1']) }}
                        <label class="form-check-label" for="radio1">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('partner_yn', '0', false, ['checked' => 'checked', 'class' => 'form-check-input', 'id' => 'radio2']) }}
                        <label class="form-check-label" for="radio2">
                            No
                        </label>
                    </div>
                @endif
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





