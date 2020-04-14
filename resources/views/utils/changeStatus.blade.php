@role('administrator')
    {!! Form::open(['url' => '/admin/inventory/status/edit', 'method' => 'POST', 'style' => 'display:inline']) !!}
    {!! Form::hidden('inventory_id',$inventory->id) !!}
    <div class="row">
        <div class="form-group">
            {!! Form::label('status_id','New Status:',array('class' => 'control-label col-md-4')) !!}
            <div class="col-md-7">
            {!! Form::select('status_id', $statusSet, null, array('class' => 'form-control')) !!}
            </div>
        </div>
    </div>
    <div class="row btn-row">
        {!! Form::button('Change Status', array(
            'type' => 'submit',
            'class' => 'btn btn-primary btn-xs center-block col-md-6 col-md-offset-3',
            'title' => 'Change Status',
            'onclick'=>'return confirm("Confirm change?")'
            ))
        !!}
    </div>
    {!! Form::close() !!}

@endrole

