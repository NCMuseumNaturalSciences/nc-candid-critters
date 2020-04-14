<div id="openReservationModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Close Reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => '/admin/reservation/close']) !!}
                {!! Form::hidden('id', $reservation->id, ['class' => 'form-control']) !!}



                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            {!! Form::label('missing_equip', 'Missing Equipment:', ['class' => 'control-label']) !!}
                            {!! Form::text('missing_equip', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            {!! Form::label('return_date', 'Return Date:', ['class' => 'control-label']) !!}
                            {!! Form::text('return_date', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            {!! Form::label('remarks', 'General Remarks:') !!}
                            {!! Form::textarea('remarks', $reservation->remarks, ['class'=> 'form-control', 'rows' => '4']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-success" >Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>