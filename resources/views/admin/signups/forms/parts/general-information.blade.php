<fieldset class="striped">
    <h4>General Information</h4>
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
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                {!! Form::label('telephone', 'Telephone:') !!} <span class="text-danger text-required">*</span>
                {!! Form::text('telephone', null, ['class'=> 'form-control phone-input', 'required', 'minlength' => '10']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                {!! Form::label('organization', 'Organization:') !!}
                {!! Form::text('organization', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('teacher_yn', 'Are you a teacher that plans to use a camera with students?') !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group">
                    {{ Form::rbGroup([
                            'id' => 'teacher1',
                            'rb-type' => 'primary',
                           'label' => 'Yes',
                           'name' => 'teacher_yn',
                           'value' => '1'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'teacher2',
                        'rb-type' => 'primary',
                       'label' => 'No',
                       'name' => 'teacher_yn',
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
                {!! Form::label('hunter_yn', 'Are you a hunter?') !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group">
                    {{ Form::rbGroup([
                            'id' => 'hunter3',
                            'rb-type' => 'primary',
                           'label' => 'Yes',
                           'name' => 'hunter_yn',
                           'value' => '1'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'hunter4',
                        'rb-type' => 'primary',
                       'label' => 'No',
                       'name' => 'hunter_yn',
                       'value' => '0',
                        'checked' => 'checked',
                           'required' => 'required'
                   ], $errors)
                   }}
                </div>
            </div>
        </div>
    </div>
</fieldset>