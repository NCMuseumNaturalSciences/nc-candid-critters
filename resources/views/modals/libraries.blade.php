<div class="modal fade" id="librariesModal" role="dialog" aria-labelledby="librariesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title text-left" id="librariesModalLabel">Libraries</h4>
            </div>
            <div class="modal-body">
                {!! Form::label('library_id', 'Please select the library location where you would like to checkout a camera:') !!}
                <select class="form-control select-library" id="selectLibrary" width="100%">
                    <option value=""></option>
                    @foreach($libraries as $l)
                        <option value="{{ $l->id }}">{{ $l->library_name }} ({{ $l->street_address }} {{ $l->city }}, NC {{ $l->zip }})</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-danger" data-toggle="modal" data-target="#librariesModal">Cancel</button>
                <button type="button" class="btn btn-default btn-primary" data-toggle="modal" data-target="#librariesModal" id="btn-library-select">Select</button>
            </div>
        </div>
    </div>
</div>
