<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-check abc-checkbox abc-checkbox-success">
                <input class="form-check-input" type="checkbox" id="camera_present_yn" value="1" name="camera_present_yn">
                <label class="form-check-label" for="camera_present_yn">1 camera</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-check abc-checkbox abc-checkbox-success">
                <input class="form-check-input" type="checkbox" id="plastic_box_yn" value="1" name="plastic_box_yn">
                <label class="form-check-label" for="plastic_box_yn">1 plastic box with lid</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-check abc-checkbox abc-checkbox-success">
                <input class="form-check-input" type="checkbox" id="lock_yn" value="1" name="lock_yn">
                <label class="form-check-label" for="lock_yn">1 python lock</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-check abc-checkbox abc-checkbox-success">
                <input class="form-check-input" type="checkbox" id="item_list_yn" value="1" name="item_list_yn">
                <label class="form-check-label" for="item_list_yn">1 small item list for the camera kit</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-check abc-checkbox abc-checkbox-success">
                <input class="form-check-input" type="checkbox" id="batteries_yn" value="1" name="batteries_yn">
                <label class="form-check-label" for="batteries_yn">2 plastic battery cases filled with 12 - AA lithium batteries each (24 total batteries).</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-check abc-checkbox abc-checkbox-success">
                <input class="form-check-input" type="checkbox" id="sd_cards_yn" name="sd_cards_yn" value="1">
                <label class="form-check-label" for="sd_cards_yn">1 small green-topped container with 2 SD cards AND 1 key for the lock.</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-check abc-checkbox abc-checkbox-success">
                <input class="form-check-input" type="checkbox" id="camera_working_yn" value="1" name="camera_working_yn">
                <label class="form-check-label" for="camera_working_yn">Does the camera turn on (must open the camera to locate the 'on' switch) and appear to be working?</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('check_remarks', 'Inventory Check Remarks:') !!}
            {!! Form::textarea('check_remarks', $reservation->inventory->checked_remarks, ['class'=> 'form-control', 'rows' => '4']) !!}
        </div>
    </div>
</div>