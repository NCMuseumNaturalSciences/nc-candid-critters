<fieldset>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('camera_id', 'Camera:', ['class' => 'control-label']) !!}
                <select name="camera_id" class="form-control" id="selectCamera">
                    <option value=""></option>
                    @foreach($cameras as $camera)
                        <option value="{{ $camera->id }}"  @if($inventory->camera_id == $camera->id) selected="selected" @endif>{{ $camera->make }} {{ $camera->model }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            @if($inventory->library_id)
                <div class="form-group">
                    {!! Form::label('library_id', 'Library:', ['class' => 'control-label']) !!}
                    <select name="library_id" class="form-control" id="selectLibrary">
                        @foreach($libraries as $library)
                            <option value="{{ $library->id }}"  @if($inventory->library_id == $library->id) selected="selected" @endif>{{ $library->library_name }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <div class="form-group">
                    {!! Form::label('library_id', 'Library:', ['class' => 'control-label']) !!}
                    <select name="library_id" class="form-control" id="selectLibrary">
                        <option value=""></option>
                        @foreach($libraries as $library)
                            <option value="{{ $library->id }}">{{ $library->library_name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('barcode', 'Barcode:', ['class' => 'control-label']) !!}
                {!! Form::text('barcode', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                {!! Form::label('nccc_id', 'Candid Inventory ID:', ['class' => 'control-label']) !!}
                {!! Form::text('nccc_id', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('remarks', 'Remarks:', ['class' => 'control-label']) !!}
                {!! Form::textarea('remarks', null, ['class' => 'form-control','size' => '30x2']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('status_id', 'Inventory Item Status*:', ['class' => 'control-label']) !!}
                <select name="status_id" class="form-control" id="selectStatus">
                    @foreach($statusSet as $s)
                        <option value="{{ $s->id }}"  @if($inventory->status_id == $s->id) selected="selected" @endif>{{ $s->status_name }}</option>
                    @endforeach
                </select>
            </div>
            <p>* Changing the status of <span class="text-danger">Reserved</span> inventory may cause data <span class="text-danger"><strong>corruption</strong></span>. To change the status of reserved inventory, please close the associated reservation.</p>

        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <div class="form-group">
                {!! Form::submit($submitTextButton, array('class' => $btnclass)) !!}
            </div>
        </div>
    </div>

</fieldset>