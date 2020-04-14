<fieldset>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('site_name', 'Site Name:', ['class' => 'control-label']) !!}
                {!! Form::text('site_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('site_number', 'Model:') !!}
                {!! Form::text('site_number', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('lat', 'Latitude:') !!}
                {!! Form::text('lat', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('lon', 'Longitude:') !!}
                {!! Form::text('lon', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('county', 'County:', ['class' => 'control-label']) !!}
                {!! Form::select('county', $nccounties, null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('land_cover', 'Land Cover:') !!}
                {!! Form::select('land_cover', $coverTypes, null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('property_name', 'Property Name:') !!}
                {!! Form::text('property_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('approved_yn', 'Approved?') !!}<br>
                <div class="rb-group">
                    {{ Form::rbGroup([
                        'id' => 'ac1',
                        'rb-type' => 'primary',
                        'label' => 'Yes',
                        'name' => 'approved_yn',
                        'value' => '1'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'ac2',
                        'rb-type' => 'primary',
                        'label' => 'No',
                        'name' => 'approved_yn',
                        'value' => '0',
                   ], $errors)
                   }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('display_on_map_yn', 'Display on Map?') !!}<br>
                <div class="rb-group">
                    {{ Form::rbGroup([
                        'id' => 'dm1',
                        'rb-type' => 'primary',
                        'label' => 'Yes',
                        'name' => 'display_on_map_yn',
                        'value' => '1'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'dm2',
                        'rb-type' => 'primary',
                        'label' => 'No',
                        'name' => 'display_on_map_yn',
                        'value' => '0',
                   ], $errors)
                   }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('date_added_map', 'Date Added to Map:', ['class' => 'control-label']) !!}
                {!! Form::text('date_added_map', null, ['class'=> 'form-control date-field']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('status', 'Status:', ['class' => 'control-label']) !!}
                {!! Form::select('status', $siteStatus, null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('source_gsheet_name', 'Google Sheet Source:', ['class' => 'control-label']) !!}
                {!! Form::text('source_gsheet_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('burn_season', 'Burn Season:') !!}
                {!! Form::text('burn_season', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('logging_season', 'Logging Season:') !!}
                {!! Form::text('logging_season', null, ['class'=> 'form-control']) !!}
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





