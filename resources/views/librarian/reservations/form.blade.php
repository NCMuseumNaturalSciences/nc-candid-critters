<fieldset>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('librarian_name', 'Librarian Name:', ['class' => 'control-label']) !!} <span class="text-danger text-required">*</span>
                {!! Form::text('librarian_name', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('volunteer_id', 'Volunteer:') !!} <span class="text-danger text-required">*</span>
                <select name="volunteer_id" class="form-control">
                    <option value=""></option>
                    @foreach($volunteers as $v)
                        <option value="{{ $v->volunteer_id }}">{{ $v->first_name }} {{ $v->last_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('inventory_id', 'Inventory:', ['class' => 'control-label']) !!} <span class="text-danger text-required">*</span>
                {!! Form::select('inventory_id', $inventory, null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Open Date</label> <span class="text-danger text-required">*</span>
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </span>
                    {!! Form::text('open_date', null, ['class'=> 'date-input form-control', 'id' => 'date-input']) !!}
                </div>
                <small>Today's Date: {{ $today }}</small><br>
                <small class="text-muted">ex. 99/99/9999</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('remarks', 'Remarks:', ['class' => 'control-label']) !!}
                {!! Form::textarea('remarks', null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
</fieldset>
<div class="row btn-row">
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::submit($submitTextButton, array('class' => $btnclass)) !!}
        </div>
    </div>
    <div class="col-md-4">
        <p class="disclaimer text-danger"><em>* Required</em></p>
    </div>
</div>

