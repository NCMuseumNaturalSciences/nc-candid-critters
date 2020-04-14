<fieldset>
    <div class="row">
        @if(empty($volunteer))
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('volunteer_id', 'Volunteer:', ['class' => 'control-label']) !!}
                {!! Form::text('volunteer_id', $unassignedVolunteers, ['class'=> 'form-control']) !!}
            </div>
        </div>
        @endif
        <div class="col-md-6 col-xs-12">
            <div class="form-group">
                <select name="library_id" class="form-control">
                    <option value=""></option>
                    @foreach($libraries as $l)
                        <option value="{{ $l->id }}">{{ $l->library_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <button type="submit" class="btn btn-custom-success">Assign Library</button>
            </div>
        </div>
    </div>

</fieldset>
