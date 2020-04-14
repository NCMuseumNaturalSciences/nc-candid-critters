<div id="equipmentCheckModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Check Inventory Equipment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => '/admin/inventory/check']) !!}
                {!! Form::hidden('inventory_id', $camera->id, ['class' => 'form-control']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('plastic_box_yn', '1 plastic box with lid') !!} <span class="text-danger text-required">*</span><br>
                            <div class="rb-group">
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="plastic_box_y"
                                           value="1"
                                           name="plastic_box_yn"
                                           @if($camera->plastic_box_yn == 1) checked="checked" @else checked="" @endif
                                           required>
                                    <label class="form-check-label" for="plastic_box_y">Yes</label>
                                </div>
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="plastic_box_n"
                                           value="0"
                                           name="plastic_box_yn"
                                           @if($camera->plastic_box_yn == 0) checked="checked" @else checked="" @endif
                                           required>
                                    <label class="form-check-label" for="plastic_box_n">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('lock_yn', '1 python lock') !!} <span class="text-danger text-required">*</span><br>
                            <div class="rb-group">
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="lock_y"
                                           value="1"
                                           name="lock_yn"
                                           @if($camera->lock_yn == 1) checked="checked" @else checked="" @endif
                                           required>
                                    <label class="form-check-label" for="lock_y">Yes</label>
                                </div>
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="lock_n"
                                           value="0"
                                           name="lock_yn"
                                           @if($camera->lock_yn == 0) checked="checked" @else checked="" @endif
                                           required>
                                    <label class="form-check-label" for="lock_n">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('item_list_yn', '1 small item list for the camera kit') !!} <span class="text-danger text-required">*</span><br>
                            <div class="rb-group">
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="sd_cards_y"
                                           value="1"
                                           name="item_list_yn"
                                           @if($camera->item_list_yn == 1) checked="checked" @else checked="" @endif
                                           required>
                                    <label class="form-check-label" for="sd_cards_y">Yes</label>
                                </div>
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="sd_cards_n"
                                           value="0"
                                           name="item_list_yn"
                                           @if($camera->item_list_yn == 0) checked="checked" @else checked="" @endif
                                           required>
                                    <label class="form-check-label" for="sd_cards_n">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('batteries_yn', '2 plastic battery cases filled with 12 - AA lithium batteries each (24 total batteries).') !!} <span class="text-danger text-required">*</span><br>
                            <div class="rb-group">
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="batteries_y"
                                           value="1"
                                           name="batteries_yn"
                                           @if($camera->batteries_yn == 1) checked="checked" @else checked="" @endif
                                           required>
                                    <label class="form-check-label" for="batteries_y">Yes</label>
                                </div>
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="batteries_n"
                                           value="0"
                                           name="batteries_yn"
                                           @if($camera->batteries_yn == 0) checked="checked" @else checked="" @endif
                                           required>
                                    <label class="form-check-label" for="batteries_n">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('sd_cards_yn', '1 small green-topped container with 2 SD cards AND 1 key for the lock') !!} <span class="text-danger text-required">*</span><br>
                            <div class="rb-group">
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="sd_cards_y"
                                           value="1"
                                           name="sd_cards_yn"
                                           @if($camera->sd_cards_yn == 1) checked="checked" @else checked="" @endif
                                           required>
                                    <label class="form-check-label" for="sd_cards_y">Yes</label>
                                </div>
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="sd_cards_n"
                                           value="0"
                                           name="sd_cards_yn"
                                           @if($camera->sd_cards_yn == 0) checked="checked" @else checked="" @endif
                                           required>
                                    <label class="form-check-label" for="sd_cards_n">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('camera_working_yn', 'Does the camera turn on (must open the camera to locate the \'on\' switch) and appear to be working?') !!} <span class="text-danger text-required">*</span><br>
                            <div class="rb-group">
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="camera_working_y"
                                           value="1"
                                           name="camera_working_yn"
                                           @if($camera->camera_working_yn == 1) checked="checked" @else checked="" @endif
                                           required>
                                    <label class="form-check-label" for="camera_y">Yes</label>
                                </div>
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="camera_working_n"
                                           value="0"
                                           name="camera_working_yn"
                                           @if($camera->camera_working_yn == 0) checked="checked" @else checked="" @endif
                                           required>
                                    <label class="form-check-label" for="camera_n">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('remarks', 'Equipment Remarks:') !!}
                            {!! Form::textarea('remarks', $camera->remarks, ['class'=> 'form-control', 'rows' => '4']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-success" >Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>