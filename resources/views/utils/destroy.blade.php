@role('administrator')
{!! Form::open(['url' => [$url, $id], 'method' => 'DELETE', 'style' => 'display:inline']) !!}
{!! Form::button('Delete', array(
    'type' => 'submit',
    'class' => 'btn btn-xs btn-dt-row btn-custom-destroy',
    'title' => 'Delete',
    'onclick'=>'return confirm("Confirm delete?")'
    ))
!!}
{!! Form::close() !!}
@endrole