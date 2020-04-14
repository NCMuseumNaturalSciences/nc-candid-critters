    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('first_name', 'First Name:', ['class' => 'control-label']) !!}
                {!! Form::text('first_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('last_name', 'Last Name:', ['class' => 'control-label']) !!}
                {!! Form::text('last_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                {!! Form::text('email', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                {!! Form::label('telephone', 'Telephone:', ['class' => 'control-label']) !!}
                {!! Form::text('telephone', null, ['class'=> 'form-control phone-input']) !!}
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                {!! Form::label('organization', 'Organization:', ['class' => 'control-label']) !!}
                {!! Form::text('organization', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('county', 'County', ['class' => 'control-label']) !!}
                {!! Form::text('county', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('city', 'City', ['class' => 'control-label']) !!}
                {!! Form::text('city', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="form-group">
                {!! Form::label('zip_code', 'Zip Code:', ['class' => 'control-label']) !!}
                {!! Form::text('zip_code', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('admin_remarks', 'Administrative Remarks', ['class' => 'control-label']) !!}
                {!! Form::textarea('admin_remarks', null, ['class'=> 'form-control', 'size' => '30x2']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('acf_borrower_yn', 'Borrower?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="acf_borrower_y"
                               value="1"
                               name="acf_borrower_yn"
                               @if($model->acf_borrower_yn == 1) checked @endif>
                        <label class="form-check-label" for="acf_borrower_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="acf_borrower_n"
                               value="0"
                               name="acf_borrower_yn"
                               @if($model->acf_borrower_yn == 0) checked @endif>
                        <label class="form-check-label" for="acf_borrower_n">No</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('acf_uploader_yn', 'Uploader?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="acf_uploader_y"
                               value="1"
                               name="acf_uploader_yn"
                               @if($model->acf_uploader_yn == 1) checked @endif>
                        <label class="form-check-label" for="acf_uploader_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="acf_uploader_n"
                               value="0"
                               name="acf_uploader_yn"
                               @if($model->acf_uploader_yn == 0) checked @endif>
                        <label class="form-check-label" for="acf_uploader_n">No</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('koozie_form_sent_yn', 'Koozie Form Sent?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="koozie_form_sent_y"
                               value="1"
                               name="koozie_form_sent_yn"
                               @if($model->koozie_form_sent_yn == 1) checked @endif>
                        <label class="form-check-label" for="koozie_form_sent_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="koozie_form_sent_n"
                               value="0"
                               name="koozie_form_sent_yn"
                               @if($model->koozie_form_sent_yn == 0) checked @endif>
                        <label class="form-check-label" for="koozie_form_sent_n">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('koozie_yn', 'Koozie Sent?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="koozie_y"
                               value="1"
                               name="koozie_yn"
                               @if($model->koozie_yn == 1) checked @endif>
                        <label class="form-check-label" for="koozie_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="koozie_n"
                               value="0"
                               name="koozie_yn"
                               @if($model->koozie_yn == 0) checked @endif>
                        <label class="form-check-label" for="koozie_n">No</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('tshirt_form_sent_yn', 'T-Shirt Form Sent?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="tshirt_form_sent_y"
                               value="1"
                               name="tshirt_form_sent_yn"
                               @if($model->tshirt_form_sent_yn == 1) checked @endif>
                        <label class="form-check-label" for="tshirt_form_sent_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="tshirt_form_sent_n"
                               value="0"
                               name="tshirt_form_sent_yn"
                               @if($model->tshirt_form_sent_yn == 0) checked @endif>
                        <label class="form-check-label" for="tshirt_form_sent_n">No</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('tshirt_sent_yn', 'T-Shirt Sent?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="tshirt_sent_y"
                               value="1"
                               name="tshirt_sent_yn"
                               @if($model->tshirt_sent_yn == 1) checked @endif>
                        <label class="form-check-label" for="tshirt_sent_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="tshirt_sent_n"
                               value="0"
                               name="tshirt_sent_yn"
                               @if($model->tshirt_sent_yn == 0) checked @endif>
                        <label class="form-check-label" for="tshirt_sent_n">No</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <p>Number of Deployments: {{ $model->deployments->count() }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('libraries_notes', 'Librarian Remarks', ['class' => 'control-label']) !!}
                {!! Form::textarea('libraries_notes', $model->libraries_notes, ['class'=> 'form-control', 'size' => '30x2']) !!}
            </div>
        </div>
    </div>
