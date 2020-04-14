<h3>Uploads</h3>
<fieldset class="striped">
    <div class="row single">
        <div class="col-xs-12">
            <div class="form-group">
                <div class="form-check abc-checkbox abc-checkbox-success">
                    <input class="form-check-input" type="checkbox" id="commit_upload_yn" name="commit_upload_yn" value="1" required="">
                    <label class="form-check-label" for="commit_upload_yn">
                        I commit to uploading the photos my camera captures. <span class="text-danger text-required">*</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row single">
        <div class="col-xs-12">
            <div class="form-group">
                {{ Form::cbGroup([
                        'cbtype' => 'success',
                        'value' => '1',
                        'name' => 'pc_verify_yn',
                        'id' => 'pcConfirm',
                        'label' => 'I verify that I own and am adept at operating a computer with at least 2GB RAM and an internet connection.',
                        'required' => 'required'
                    ], $errors)
                    }}
            </div>
        </div>
    </div>
    <div class="row single">
        <div class="col-xs-12">
            <div class="form-group">
                {{ Form::cbGroup([
                        'cbtype' => 'success',
                        'value' => '1',
                        'name' => 'time_commit_yn',
                        'id' => 'timeCommit',
                        'label' => 'I am willing to commit approximately 1 hour to tagging and uploading images for each camera deployment.',
                        'required' => 'required'
                    ], $errors)
                    }}
            </div>
        </div>
    </div>
</fieldset>
