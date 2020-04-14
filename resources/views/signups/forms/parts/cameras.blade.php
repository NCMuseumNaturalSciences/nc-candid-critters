<h3>Cameras</h3>
<fieldset>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <p>Click 'View Cameras' to view a list of approved cameras for camera traps. <span class="text-danger text-required">*</span></p>
            <button class="btn btn-primary btn-sm camera-button" type="button" data-toggle="modal" data-target="#camerasModal">
                View Cameras
            </button>
            {{ Form::hidden('camera_id', null, ['class' => 'camera-hidden', 'required']) }}
            <span class="camera-name camera-selection"></span>
        </div>
    </div>
</fieldset>