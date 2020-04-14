<div id="assignmentModalPost" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Volunteer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'admin.libraries.assign.volunteer']) !!}
                    <div class="form-group">
                        {!! Form::hidden('library_id', $library->id, ['id' => 'txtLibraryId', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('volunteer_id', 'Volunteer:', ['class' => 'control-label']) !!}
                        <select name="volunteer_id" class="form-control">
                            <option value=""></option>
                            @foreach($volunteers as $v)
                                <option value="{{ $v->id }}">{{ $v->first_name }} {{ $v->last_name }} ({{ $v->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default btn-success" >Assign</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>