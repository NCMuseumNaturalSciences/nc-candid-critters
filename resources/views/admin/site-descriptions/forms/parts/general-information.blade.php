<fieldset class="striped">
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('First Name', 'First Name:') !!}
                {!! Form::text('first_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('Last Name', 'Last Name:') !!}
                {!! Form::text('last_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('Email', 'Email:') !!}
                {!! Form::text('email', null, ['class'=> 'form-control', 'type' => 'email']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="emammal_user_id" class="control-label">eMammal User ID</label>
                {!! Form::text('emammal_user_id', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('deployment_name', 'Deployment Name:') !!}
                {!! Form::text('deployment_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
</fieldset>
