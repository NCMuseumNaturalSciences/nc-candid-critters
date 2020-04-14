@role('administrator')
    {!! Form::open(['url' => $url, 'method' => 'DELETE', 'style' => 'display:inline']) !!}
    {!! Form::button('Delete', array(
        'type' => 'submit',
        'class' => 'btn btn-xs btn-sm btn-danger',
        'title' => $title,
        'onclick'=>'return confirm("Confirm delete?")'
        ))
    !!}
    {!! Form::close() !!}
@endrole

