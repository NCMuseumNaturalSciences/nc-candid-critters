<fieldset>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('Library', 'Library Name:', ['class' => 'control-label']) !!}
                <select name="library_id" id="librarySelect" class="form-control" tabindex="1">
                    <option value=""></option>
                    @foreach($libraries as $lib)
                        <option value="{{ $lib->id }}">{{ $lib->library_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group library-child-group">
                {!! Form::label('volunteer_id', 'Volunteer:') !!}
                <select name="volunteer_id" id="volunteers" class="form-control" tabindex="5">

                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('librarian_name', 'Librarian Name:', ['class' => 'control-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('librarian_name', null, ['class'=> 'form-control', 'tabindex' => '2', 'required' => 'required', 'data-parsley-trigger' => 'keyup blur']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group library-child-group">
                {!! Form::label('inventory_id', 'Camera:') !!}
                <select name="inventory_id" id="inventory" class="form-control" tabindex="6">

                </select>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('librarian_email', 'Librarian Email:') !!} <span class="text-danger">*</span>
                {!! Form::text('librarian_email', null, ['class'=> 'form-control', 'tabindex' => '3', 'required' => 'required', 'data-parsley-trigger' => 'keyup blur']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Open Date</label>
                <div class="input-group">
                                    <span class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                    </span>
                    {!! Form::text('open_date', null, ['class'=> 'date-input form-control', 'tabindex' => '7', 'id' => 'date-input']) !!}
                </div>
                <small class="text-muted">ex. 99/99/9999</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('librarian_phone', 'Librarian Phone:') !!} <span class="text-danger">*</span>
                {!! Form::text('librarian_phone', null, ['class'=> 'form-control phone-input', 'tabindex' => '4', 'required' => 'required', 'data-parsley-trigger' => 'keyup blur']) !!}
            </div>
        </div>
    </div>
	<div class="row">



    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('remarks', 'Remarks:', ['class' => 'control-label']) !!}
                {!! Form::textarea('remarks', null, ['class'=> 'form-control', 'tabindex' => '8']) !!}
            </div>
        </div>
    </div>
</fieldset>
<div class="row btn-row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::submit('Open', ['class' => 'btn btn-xs btn-primary', 'tabindex' => '9']) !!}
        </div>
    </div>
</div>