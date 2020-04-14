<div id="openReservationModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Open Reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => '/admin/reservation/open']) !!}
                {!! Form::hidden('inventory_id', $camera->id, ['class' => 'form-control']) !!}

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            {!! Form::label('volunteer_id', 'Camera:', ['class' => 'control-label']) !!}
                            <select name="volunteer_id" class="form-control" id="selectCamera">
                                <option value=""></option>
                                @foreach($assignedVolunteers as $u)
                                    <option value="{{ $u->volunteer_id }}">{{ $u->first_name }} {{ $u->last_name }} ({{ $u->email }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            {!! Form::label('checkout_length', 'Checkout Length (Days):', ['class' => 'control-label']) !!}
                            {!! Form::text('checkout_length', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            {!! Form::label('checkout_date', 'Checkout Date:', ['class' => 'control-label']) !!}
                            {!! Form::text('checkout_date', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            {!! Form::label('remarks', 'General Remarks:') !!}
                            {!! Form::textarea('remarks', $camera->check->remarks, ['class'=> 'form-control', 'rows' => '4']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-success" >Open</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>