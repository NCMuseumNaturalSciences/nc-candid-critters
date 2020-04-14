<!-- jQuery UI Dialog Window for Site Selection -->
<div class="map-selection-dialog" id="map-selection-dialog">
    <div class="dialog-content">
        <div class="dialog-header">
        </div>
        <div class="dialog-body">
            <div class="site-notes-wrapper">
                <h4>PLEASE READ!</h4>
                <div class="infowin-content"></div>
                <br>
                <p>Coordinates: <span class="infowin-lat"></span>, <span class="infowin-long"></span></p>
            </div>
            <span class="response-message"></span>
            <span class="response-error"></span>
            <span class="response-hide">
            <p>To select this site, please enter your information and then click the reserve site button</p>
                {!! Form::open(['route' => 'map-selection.create', 'class' => 'form site-select-form', 'id' => 'site-description-form']) !!}
                    <div class="form-group">
                        {!! Form::label('First Name', 'First Name:') !!} <span class="text-danger">*</span>
                        {!! Form::text('first_name', null, ['class'=> 'form-control', 'id' => 'first_name', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Last Name', 'Last Name:') !!} <span class="text-danger">*</span>
                        {!! Form::text('last_name', null, ['class'=> 'form-control', 'id' => 'last_name', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Email', 'Email:') !!} <span class="text-danger">*</span>
                        {!! Form::text('email', null, ['class'=> 'form-control', 'id' => 'email', 'required']) !!}
                    </div>
                    {!! Form::hidden('id', null, ['id' => 'selected-site-id']) !!}
                    {!! Form::submit('Reserve Site', array('class' => 'btn btn-md btn-primary center-block')) !!}
                    {!! Form::close() !!}
                </form>
                <hr>

            </span>
        </div>
    </div>
</div>
