<fieldset>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('acf_borrower_yn', 'Are you using your own camera or borrowing one of ours?', ['class' => 'col-form-label']) !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="acf_borrower_y"
                               value="0"
                               name="acf_borrower_yn"
                               @if($model->acf_borrower_yn == 0) checked @endif>
                        <label class="form-check-label" for="acf_borrower_y">BYO</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="acf_borrower_n"
                               value="1"
                               name="acf_borrower_yn"
                               @if($model->acf_borrower_yn == 1) checked @endif>
                        <label class="form-check-label" for="acf_borrower_n">Borrower</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                {!! Form::label('delivery_method', 'How will you get us your photos?', ['class' => 'col-form-label']) !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="delivery_method_y"
                               value="0"
                               name="delivery_method"
                               @if($model->delivery_method == 'On SD cards via US Mail') checked @endif>
                        <label class="form-check-label" for="delivery_method_y">On SD cards via US Mail</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="delivery_method_n"
                               value="1"
                               name="delivery_method"
                               @if($model->delivery_method == 'Digitally using a file-sharing system like Dropbox or Google Drive') checked @endif>
                        <label class="form-check-label" for="delivery_method_n">Digitally using a file-sharing system like Dropbox or Google Drive</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                {!! Form::label('mailing_address_sd', 'Please give us your mailing address so we can send you 2 SD cards.:') !!} <span class="text-danger">*</span>
                {!! Form::textarea('mailing_address_sd', null, ['class'=> 'form-control', 'size' => '30x4']) !!}
            </div>
        </div>
    </div>
</fieldset>