<div class="row">
    <div class="col-md-6">
        <fieldset>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('librarian_name', 'Librarian Name:', ['class' => 'control-label']) !!}
                        {!! Form::text('librarian_name', null, ['class'=> 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('librarian_email', 'Librarian Email:') !!}
                        {!! Form::text('librarian_email', null, ['class'=> 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('librarian_phone', 'Librarian Phone:') !!}
                        {!! Form::text('librarian_phone', null, ['class'=> 'form-control phone-input']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group open-group">
                        <label>Open Date</label>
                        <div class="input-group">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                              </span>
                            </span>
                            {!! Form::text('open_date', $opendate, ['class'=> 'date-input form-control', 'id' => 'date-input']) !!}
                        </div>
                        <small class="text-muted">ex. 99/99/9999</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('remarks', 'Remarks:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('remarks', null, ['class'=> 'form-control']) !!}
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-6">
        @if($reservation->closed_yn == 0)
        <fieldset>
            <div class="row">
                <div class="col-md-12">
                    @if($action == 'edit')
                        <div class="form-group">
                            {!! Form::label('closed_yn', 'Returning Camera?') !!}<br>
                            <div class="rb-group">
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="closed_y"
                                           value="1"
                                           name="closed_yn"
                                           @if($reservation->closed_yn == 1) checked @endif>
                                    <label class="form-check-label" for="closed_y">Yes</label>
                                </div>
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="closed_n"
                                           value="0"
                                           name="closed_yn"
                                           @if($reservation->closed_yn == 0) checked @endif>
                                    <label class="form-check-label" for="closed_n">No</label>
                                </div>
                            </div>
                        </div>
                    @elseif($action == 'close')
                        <div class="form-group">
                            {!! Form::label('closed_yn', 'Returning Camera?') !!}<br>
                            <div class="rb-group">
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="closed_y"
                                           value="1"
                                           name="closed_yn"
                                           checked>
                                    <label class="form-check-label" for="closed_y">Yes</label>
                                </div>
                                <div class="form-check abc-radio abc-radio-primary">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="closed_n"
                                           value="0"
                                           name="closed_yn">
                                    <label class="form-check-label" for="closed_n">No</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div id="closed-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="close-group">
                            <label>Close Date</label>
                            <div class="input-group">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                              </span>
                            </span>
                                {!! Form::text('close_date', $closedate, ['class'=> 'date-input form-control', 'id' => 'date-input-2', 'required']) !!}
                            </div>
                            <small class="text-muted">ex. 99/99/9999</small>
                        </div>
                    </div>
                </div>
                @include('librarian.reservations.equipment-check-form')
            </div><!-- end closed-wrapper -->
        </fieldset>
        @elseif($reservation->closed_yn == 1)
            <fieldset>
            <p>Reservation Close Details <em>(cannot be edited for closed reservations)</em></p>
                <p><span>Close Date:</span> {{ $closedate }} </p>
                <p class="list-header">Inventory Check Results:</p>
            <ul class="check-list-results">
                    <li><span>Camera Missing?</span> @if($reservation->inventory->check->camera_present_yn == 0) Yes @else No @endif</li>
                    <li><span>1 Plastic Box?</span> @if($reservation->inventory->check->plastic_box_yn == 1) Yes @else No @endif</li>
                    <li><span>Python lock?</span> @if($reservation->inventory->check->lock_yn == 1) Yes @else No @endif</li>
                    <li><span>Camera kit item list?</span> @if($reservation->inventory->check->item_list_yn == 1) Yes @else No @endif</li>
                    <li><span>Two battery cases with 12 batteries/each?</span> @if($reservation->inventory->check->batteries_yn == 1) Yes @else No @endif</li>
                    <li><span>Container with 2 SD Cards and lock key?</span> @if($reservation->inventory->check->sd_cards_yn == 1) Yes @else No @endif</li>
                    <li><span>Camera Working?</span> @if($reservation->inventory->check->camera_working_yn == 1) Yes @else No @endif</li>
            </ul>
            </fieldset>
            @endif
    </div>
</div>


<div class="row btn-row">
    <div class="col-md-6">
        <div class="form-group update-btn">
            {!! Form::submit('Update Reservation', ['class' => 'btn btn-warning center-block']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group close-btn">
            {!! Form::submit('Close Reservation', ['class' => 'btn btn-warning center-block']) !!}
        </div>
    </div>

</div>

