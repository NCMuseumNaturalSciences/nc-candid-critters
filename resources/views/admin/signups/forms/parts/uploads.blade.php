<fieldset class="striped">
    <h4>Uploads</h4>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('commit_upload_yn', 'I commit to uploading the photos my camera captures.') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="commit_upload_y"
                               value="1"
                               name="commit_upload_yn"
                               @if($signup->commit_upload_yn == 1) checked @endif
                               required>
                        <label class="form-check-label" for="commit_upload_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="commit_upload_n"
                               value="0"
                               name="commit_upload_yn"
                               @if($signup->commit_upload_yn == 0) checked @endif
                               required>
                        <label class="form-check-label" for="commit_upload_n">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('pc_verify_yn', 'I verify that I own and am adept at operating a computer with at least 2GB RAM and an internet connection.') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="pc_verify_y"
                               value="1"
                               name="pc_verify_yn"
                               @if($signup->pc_verify_yn == 1) checked @endif
                               required>
                        <label class="form-check-label" for="pc_verify_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="pc_verify_n"
                               value="0"
                               name="pc_verify_yn"
                               @if($signup->pc_verify_yn == 0) checked @endif
                               required>
                        <label class="form-check-label" for="pc_verify_n">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('time_commit_yn', 'I am willing to commit approximately 1 hour to tagging and uploading images for each camera deployment.') !!}<br>
                <div class="rb-group">
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="time_commit_y"
                               value="1"
                               name="time_commit_yn"
                               @if($signup->time_commit_yn == 1) checked @endif
                               required>
                        <label class="form-check-label" for="time_commit_y">Yes</label>
                    </div>
                    <div class="form-check abc-radio abc-radio-primary">
                        <input class="form-check-input"
                               type="radio"
                               id="time_commit_n"
                               value="0"
                               name="time_commit_yn"
                               @if($signup->time_commit_yn == 0) checked @endif
                               required>
                        <label class="form-check-label" for="time_commit_n">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
