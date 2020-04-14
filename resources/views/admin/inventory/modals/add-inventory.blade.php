<div id="inventoryModalPost" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'admin.inventory.add']) !!}
                <div class="form-group">
                    {!! Form::label('library_id', 'Library:', ['class' => 'control-label']) !!}
                    <select name="library_id" class="form-control" id="selectLibrary">
                        <option value=""></option>
                        @foreach($libraries as $library)
                            <option value="{{ $library->id }}">{{ $library->library_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('camera_id', 'Camera:', ['class' => 'control-label']) !!}<span class="text-danger">*</span>
                    <select name="camera_id" class="form-control" id="selectCamera">
                        <option value=""></option>
                        @foreach($cameras as $camera)
                            <option value="{{ $camera->id }}">{{ $camera->make }} {{ $camera->model }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('barcode', 'Barcode:', ['class' => 'control-label']) !!}<span class="text-danger">*</span>
                    {!! Form::text('barcode', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('nccc_id', 'Candid Inventory ID:', ['class' => 'control-label']) !!}<span class="text-danger">*</span>
                    {!! Form::text('nccc_id', null, ['class' => 'form-control']) !!}
                </div>
                    <div class="form-group">
                    {!! Form::label('remarks', 'Remarks:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('remarks', null, ['class' => 'form-control','size' => '30x2']) !!}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-success" >Add</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>