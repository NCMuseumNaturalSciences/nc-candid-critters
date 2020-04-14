<div class="modal fade" id="checkInventoryModal" tabindex="-1" role="dialog" aria-labelledby="checkInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Check Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    {!! Form::open(['url' => '/admin/inventory/check']) !!}
                    {{ Form::hidden('inventory_id', $i->id, ['class' => 'form-control', 'id' => 'inventoryId']) }}
                        <fieldset>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('camera_present_yn', '1 camera') !!}<br>
                                        <div class="rb-group">
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="camera_present_y"
                                                       value="1"
                                                       name="camera_present_yn"
                                                       @if($i->camera_present_yn == 1) checked @endif
                                                       required>
                                                <label class="form-check-label" for="camera_present_y">Yes</label>
                                            </div>
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="camera_present_n"
                                                       value="0"
                                                       name="camera_present_yn"
                                                       @if($i->camera_present_yn == 0) checked @endif
                                                       required>
                                                <label class="form-check-label" for="camera_present_n">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('plastic_box_yn', '1 plastic box with lid') !!}<br>
                                        <div class="rb-group">
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="plastic_box_y"
                                                       value="1"
                                                       name="plastic_box_yn"
                                                       @if($i->plastic_box_yn == 1) checked @endif
                                                       required>
                                                <label class="form-check-label" for="plastic_box_y">Yes</label>
                                            </div>
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="plastic_box_n"
                                                       value="0"
                                                       name="plastic_box_yn"
                                                       @if($i->plastic_box_yn == 0) checked @endif
                                                       required>
                                                <label class="form-check-label" for="plastic_box_n">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('lock_yn', '1 python lock') !!}<br>
                                        <div class="rb-group">
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="lock_y"
                                                       value="1"
                                                       name="lock_yn"
                                                       @if($i->lock_yn == 1) checked @endif
                                                       required>
                                                <label class="form-check-label" for="lock_y">Yes</label>
                                            </div>
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="lock_n"
                                                       value="0"
                                                       name="lock_yn"
                                                       @if($i->lock_yn == 0) checked @endif
                                                       required>
                                                <label class="form-check-label" for="lock_n">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('item_list_yn', '1 small item list for the camera kit') !!}<br>
                                        <div class="rb-group">
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="sd_cards_y"
                                                       value="1"
                                                       name="item_list_yn"
                                                       @if($i->item_list_yn == 1) checked @endif
                                                       required>
                                                <label class="form-check-label" for="sd_cards_y">Yes</label>
                                            </div>
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="sd_cards_n"
                                                       value="0"
                                                       name="item_list_yn"
                                                       @if($i->item_list_yn == 0) checked @endif
                                                       required>
                                                <label class="form-check-label" for="sd_cards_n">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('batteries_yn', '2 plastic battery cases filled with 12 - AA lithium batteries each (24 total batteries).') !!}<br>
                                        <div class="rb-group">
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="batteries_y"
                                                       value="1"
                                                       name="batteries_yn"
                                                       @if($i->batteries_yn == 1) checked @endif
                                                       required>
                                                <label class="form-check-label" for="batteries_y">Yes</label>
                                            </div>
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="batteries_n"
                                                       value="0"
                                                       name="batteries_yn"
                                                       @if($i->batteries_yn == 0) checked @endif
                                                       required>
                                                <label class="form-check-label" for="batteries_n">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('sd_cards_yn', 'SD Cards?') !!}<br>
                                        <div class="rb-group">
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="sd_cards_y"
                                                       value="1"
                                                       name="sd_cards_yn"
                                                       @if($i->sd_cards_yn == 1) checked @endif
                                                       required>
                                                <label class="form-check-label" for="sd_cards_y">Yes</label>
                                            </div>
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="sd_cards_n"
                                                       value="0"
                                                       name="sd_cards_yn"
                                                       @if($i->sd_cards_yn == 0) checked @endif
                                                       required>
                                                <label class="form-check-label" for="sd_cards_n">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('camera_working_yn', 'Camera Working?') !!}<br>
                                        <div class="rb-group">
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="working_y"
                                                       value="1"
                                                       name="camera_working_yn"
                                                       @if($i->camera_working_yn == 1) checked @endif
                                                       required>
                                                <label class="form-check-label" for="working_y">Yes</label>
                                            </div>
                                            <div class="form-check abc-radio abc-radio-primary">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       id="working_n"
                                                       value="0"
                                                       name="camera_working_yn"
                                                       @if($i->camera_working_yn == 0) checked @endif
                                                       required>
                                                <label class="form-check-label" for="working_n">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('remarks', 'Inventory Check Remarks:') !!}
                                        {!! Form::textarea('remarks', $i->check_remarks, ['class'=> 'form-control', 'rows' => '4']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row btn-row">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default btn-success" >Update</button>
                                </div>
                            </div>
                        </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>