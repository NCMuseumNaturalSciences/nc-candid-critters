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
                {!! Form::open(['url' => '/admin/libraries/inventory/add']) !!}
                <div class="form-group">
                    {!! Form::hidden('library_id', $library->id, ['id' => 'txtLibraryId', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('camera_id', 'Camera:', ['class' => 'control-label']) !!}
                    <select name="camera_id" class="form-control" id="selectCamera">
                        <option value=""></option>

                        @foreach($cameras as $camera)
                            <option value="{{ $camera->id }}"  @if($defaultCamera->id == $camera->id) selected="selected" @endif>{{ $camera->make }} {{ $camera->model }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('barcode', 'Barcode:', ['class' => 'control-label']) !!}
                    {!! Form::text('barcode', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('nccc_id', 'Candid Inventory ID:', ['class' => 'control-label']) !!}
                    {!! Form::text('nccc_id', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-success" >Add</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>