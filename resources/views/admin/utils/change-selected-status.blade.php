{!! Form::open(['url' => '/admin/map-selections/change-status', 'method' => 'POST', 'class' => 'form-inline', 'id' => 'status-change-form']) !!}
{!! Form::hidden('id',$site->id) !!}
    <div class="form-group">
        {!! Form::label('status','New Status:',array('class' => 'control-label')) !!}
        {!! Form::select('status', $statusSet, null, array('class' => 'form-control')) !!}
    </div>
    <div class="btn-group">
        {!! Form::button('Change Status', array(
            'type' => 'submit',
            'class' => 'btn btn-primary',
            'title' => 'Change Status',
            'onclick'=>'return confirm("Confirm change?")'
            ))
        !!}
    </div>
{!! Form::close() !!}

<style>
    #status-change-form label,
    #status-change-form select {
        padding-right: 10px;
    }
    #status-change-form button {
        margin-left: 15px;
    }
</style>