<h3>General Information</h3>
<fieldset class="striped">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                {!! Form::label('First Name', 'First Name:') !!} <span class="text-danger text-required">*</span>
                {!! Form::text('first_name', null, ['class'=> 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                {!! Form::label('Last Name', 'Last Name:') !!} <span class="text-danger text-required">*</span>
                {!! Form::text('last_name', null, ['class'=> 'form-control', 'required']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                {!! Form::label('Email', 'Email:') !!} <span class="text-danger text-required">*</span>
                {!! Form::text('email', null, ['class'=> 'form-control', 'required', 'type' => 'email']) !!}
            </div>
        </div>
    </div>
        @if($id == '2')
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="form-group">
                    <label for="emammal_user_id" class="control-label">eMammal User ID (if you do not have an eMammal account, please create one at <a href="https://emammal.si.edu/user/register">https://emammal.si.edu/user/register</a> <span class="text-danger">*</span></label>
                    {!! Form::text('emammal_user_id', null, ['class'=> 'form-control', 'required']) !!}
                </div>
            </div>

        </div>
        @endif
</fieldset>
