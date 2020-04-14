<fieldset>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('user_id', 'User Name:', ['class' => 'control-label']) !!}
                {!! Form::text('user_id', $unassignedUsers, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('library_id', 'Library Name:', ['class' => 'control-label']) !!}
                <select name="library_id" class="form-control">
                    <option value=""></option>
                    @foreach($libraries as $l)
                        <option value="{{ $library->id }}">{{ $library->library_name }}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    {!! Form::submit($submitTextButton, array('class' => $btnclass)) !!}
                </div>
            </div>
        </div>
    </div>
</fieldset>
