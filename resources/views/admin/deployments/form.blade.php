<fieldset class="stripe-fieldset">
    <div class="row">
        <div class="col-md-3 col-xs-12">
            {{ Form::ccText('deployment_long', 'Deployment Longitude') }}
        </div>
        <div class="col-md-3 col-xs-12">
            {{ Form::ccText('deployment_lat', 'Deployment Latitude') }}
        </div>
        <div class="col-md-3 col-xs-12">
            {{ Form::ccText('deployment_name', 'Deployment Name') }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            {{ Form::ccText('sent_sd_card_id', 'Sent SD Card ID') }}
        </div>
        <div class="col-md-3 col-xs-12">
            {{ Form::ccText('returned_sd_card_id', 'Returned SD Card ID') }}
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('volunteer_id', 'Volunteer:') !!}
                @if($selectedVolunteer)
                    Selected
                <select class="form-control" name="volunteer_id" id="selectVolunteer-search">
                    <option value=""></option>
                    @foreach($volunteers as $v)
                        <option value="{{ $v->id }}" @if($selectedVolunteer->id == $v->id) selected="selected" @endif>
                            {{ $v->first_name }} {{ $v->last_name }} ({{ $v->email }})</option>
                    @endforeach
                </select>
                @else
                    <select class="form-control" name="volunteer_id" id="selectVolunteer-search">
                        <option value=""></option>
                        @foreach($volunteers as $v)
                            <option value="{{ $v->id }}">{{ $v->first_name }} {{ $v->last_name }} ({{ $v->email }})</option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('sent_sd_yn', 'Sent Sd Card?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="sent_sd_y"
                               value="1"
                               name="sent_sd_yn"
                               @if($deployment->sent_sd_yn == 1) checked @endif>
                        <label class="form-check-label" for="sent_sd_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="sent_sd_n"
                               value="0"
                               name="sent_sd_yn"
                               @if($deployment->sent_sd_yn == 0) checked @endif>
                        <label class="form-check-label" for="sent_sd_n">No</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('google_drive_yn', 'Google Drive Setup?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="google_drive_y"
                               value="1"
                               name="google_drive_yn"
                               @if($deployment->google_drive_yn == 1) checked @endif>
                        <label class="form-check-label" for="google_drive_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="google_drive_n"
                               value="0"
                               name="google_drive_yn"
                               @if($deployment->google_drive_yn == 0) checked @endif>
                        <label class="form-check-label" for="google_drive_n">No</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('received_data_yn', 'Received Data?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="received_data_y"
                               value="1"
                               name="received_data_yn"
                               @if($deployment->received_data_yn == 1) checked @endif
                               required>
                        <label class="form-check-label" for="received_data_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="received_data_n"
                               value="0"
                               name="received_data_yn"
                               @if($deployment->received_data_yn == 0) checked @endif
                               required>
                        <label class="form-check-label" for="received_data_n">No</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('returned_sd_card_yn', 'Returned SD Card?') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="returned_sd_card_y"
                               value="1"
                               name="returned_sd_card_yn"
                               @if($deployment->returned_sd_card_yn == 1) checked @endif
                               required>
                        <label class="form-check-label" for="returned_sd_card_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="returned_sd_card_n"
                               value="0"
                               name="returned_sd_card_yn"
                               @if($deployment->returned_sd_card_yn == 0) checked @endif
                               required>
                        <label class="form-check-label" for="returned_sd_card_n">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('upload_status', 'Upload Status') !!}<br>
                <select class="form-control" name="upload_status">
                    @foreach($statusSet as $key => $node)
                        <option value="{{ $key }}" @if($key == $deployment->upload_status) selected="selected" @endif>{{ $node }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('remarks', 'Remarks:') !!}
                {!! Form::textarea('remarks', $deployment->remarks, ['class'=> 'form-control', 'rows' => '4']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <div class="form-group">
                {!! Form::submit($submitTextButton, ['class' => 'btn btn-custom-update']) !!}
            </div>
        </div>
    </div>
</fieldset>
