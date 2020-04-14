<fieldset>
    <h4>Data Delivery</h4>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label>We must somehow receive pictures from participants so they can be added to our database. There are three options for doing so, please choose your preferred method below: <span class="text-danger text-required">*</span></label>
                <div class="rb-group">
                    <div class="form-check abc-radio">
                        <input class="form-check-input delivery-rb" type="radio"
                               value="SD Cards" id="radioDelivery1"
                               name="delivery_method" aria-label="Single radio one">
                        <label class="form-check-label" for="radioDelivery1">SD cards (provided by this project) will be mailed to our headquarters in Raleigh after each camera deployment. Postage to Raleigh will be paid by the volunteer unless special arrangements are made with NCCC staff.</label>
                    </div>
                    <div class="form-check abc-radio">
                        <input class="form-check-input delivery-rb" type="radio"
                               value="Cloud" id="radioDelivery2"
                               name="delivery_method" aria-label="Single radio two">
                        <label class="form-check-label" for="radioDelivery2">Pictures will be uploaded to a file-sharing folder (like Google Drive or Dropbox) and shared with a member of our staff to be downloaded. An internet connection is required for this option. No SD card will be provided by the project.</label>
                    </div>
                    <div class="form-check abc-radio">
                        <input class="form-check-input delivery-rb" type="radio"
                               value="NCCC Software" id="radioDelivery3"
                               name="delivery_method" aria-label="Single radio three"
                               @if($signup->delivery_method == 1) checked="checked" @else checked="" @endif>
                        <label class="form-check-label"for="radioDelivery3">I will upload my photos using the specially designed NCCC software. I acknowledge that I have a computer with an internet connection and am willing to take a longer online training (extra 20 minutes) to learn how to use the software.</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row single">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="form-check abc-checkbox abc-checkbox-success">
                    <input class="form-check-input" type="checkbox" id="commit_provide_nccc_yn" name="commit_provide_nccc_yn" value="1" required="">
                    <label class="form-check-label" for="commit_provide_nccc_yn">
                        I commit to providing the NCCC team with the photos captured by my camera. <span class="text-danger text-required">*</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</fieldset>