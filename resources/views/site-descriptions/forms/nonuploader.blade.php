<header class="form-header">
    <h2>North Carolina's Candid Critters Site Description Form</h2>
    <p>This form should be filled out for EACH place you set your camera. Please use the following guidelines to choose an appropriate site:</p>
    <ol>
        <li>Each 1/2 acre of land can have ONE camera site</li>
        <li>Do not survey the same location multiple times</li>
        <li>Space new camera sites at least 200 meters (about 650 FEET) apart</li>
        <li>No high human/car traffic areas please</li>
        <li>Obtain the appropriate permissions if you are setting your camera outside of your own land</li>
    </ol>
</header>


@include('site-descriptions.forms.parts.general-information')

<h3>Camera</h3>
<fieldset>
    <div class="row">
        <div class="col">
            <div class="form-group">
                {!! Form::label('acf_borrower_yn', 'Are you using your own camera or borrowing one of ours?', ['class' => 'col-form-label']) !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group">

                    {{ Form::rbGroup([
                            'id' => 'bb1',
                            'rb-type' => 'primary',
                            'name' => 'acf_borrower_yn',
                           'label' => 'Using my own',
                           'value' => '0'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'bb2',
                        'rb-type' => 'primary',
                        'name' => 'acf_borrower_yn',
                       'label' => 'Borrowing',
                       'value' => '1',
                       'required' => 'required'
                   ], $errors)
                   }}
                </div>
            </div>
        </div>
    </div>
    <!--
    <div class="camera-select-wrapper borrower-only">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <p>Click 'View Cameras' to view a list of approved cameras for camera traps.</p>
                <button class="btn btn-primary btn-sm camera-button" type="button" data-toggle="modal" data-target="#camerasModal">
                    View Cameras
                </button>
                <input type="hidden" name="camera_id" class="camera-hidden" value="">
                <span class="camera-name camera-selection"></span>
            </div>
        </div>
    </div>
    -->
</fieldset>

<h3>Data Delivery</h3>
<fieldset>
    <div class="row">
        <div class="col">
            <div class="form-group">
                {!! Form::label('delivery_method', 'How will you get us your photos?', ['class' => 'col-form-label']) !!} <span class="text-danger text-required">*</span><br>
                <div class="rb-group" id="delivery-rbs">
                    {{ Form::rbGroup([
                            'id' => 'dm1',
                            'rb-type' => 'primary',
                           'label' => 'On SD cards via US Mail',
                           'name' => 'delivery_method',
                           'value' => 'On SD cards via US Mail'
                       ], $errors)
                       }}
                    {{ Form::rbGroup([
                        'id' => 'dm2',
                        'rb-type' => 'primary',
                       'label' => 'Digitally using a file-sharing system like Dropbox or Google Drive',
                       'name' => 'delivery_method',
                       'value' => 'Digitally using a file-sharing system like Dropbox or Google Drive',
                       'required' => 'required'
                   ], $errors)
                   }}
                </div>
            </div>
        </div>
    </div>
    <div id="google-drive" class="row delivery-method-conditional">
        <div class="col">
            <h4>Sharing your photos via Google Drive</h4>
            <p>We will create a Google Drive folder for you for this deployment and send you a link by email. Once your deployment is complete, simply copy (drag and drop) all the pictures from your SD card into the Google Drive folder. This may take some time depending on the speed of your internet connection.</p>
            <p>Be sure to include a picture of your filled-out datasheet with information on latitude, longitude and detection distance in the folder.</p>
            <p>Please do not use any software to import your pictures and please do not change any filenames or delete any photos.</p>
        </div>
    </div>
    <div id="sd-cards" class="row delivery-method-conditional">
        <div class="col">
            <h4>Sending SD Cards</h4>
            <p>If you are using your own camera, we will send you 2 SD cards and enough stamps for one season to send you pictures to us by US mail. Once your first deployment is complete and you have received the SD cards from us, please save ALL of the photos to one of the SD cards and mail them back to us.</p>
            <p>Please do not use any software to import your pictures and please do not change any filenames or delete any photos.</p>
            <p>In the letter, be sure to:</p>
            <ul>
                <li>Include a filled datasheet, found on our website, with information on latitude, longitude and detection distance.</li>
                <li>Fold the SD card into 2 layers of paper so it doesn't get caught in mail sorters</li>
            </ul>
            <p>The mailing address is:</p>
            <address>
                Arielle Parsons<br>
                NC Museum of Natural Sciences<br>
                11 West Jones Street<br>
                Raleigh, NC 27601
            </address>
            <p>We will return a new SD card to you once we receive your photos. Repeat this for each new deployment.  When you have finished participating, please return the SD cards to us. If you intend to continue, please let our staff know when you need more stamps.</p>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('mailing_address_sd', 'Please give us your mailing address so we can send you 2 SD cards.:') !!} <span class="text-danger">*</span>
                        {!! Form::textarea('mailing_address_sd', null, ['class'=> 'form-control', 'size' => '30x4']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
@include('site-descriptions.forms.parts.site-information')

@include('site-descriptions.forms.parts.form-footer')