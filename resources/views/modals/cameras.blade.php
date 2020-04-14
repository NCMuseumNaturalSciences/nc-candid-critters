<div class="modal fade" id="camerasModal" role="dialog" aria-labelledby="camerasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-left" id="camerasModalLabel">Approved Cameras</h4>
            </div>
            <div class="modal-body">
                    {!! Form::label('camera_id', 'Please select the your camera make and model:') !!}
                    <select class="form-control select-camera" id="selectCamera"></select>
                    <p><span class="disclaimer-message">If your camera is not listed, contact us at <a href="mailto:info@nccandidcritters.org">info@nccandidcritters.org</a>. We required cameras with < 0.6 second trigger speeds.</span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-danger" data-toggle="modal" data-target="#camerasModal">Cancel</button>
                <button type="button" class="btn btn-default btn-primary" data-toggle="modal" data-target="#camerasModal" id="btn-camera-select">Select</button>
            </div>
        </div>
    </div>
</div>