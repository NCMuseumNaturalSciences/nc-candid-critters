@extends('layouts.coreui.master')
@section('title', '| Edit Permission')
@section('content')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <i class='fa fa-key'></i> Edit {{$permission->name}}</div>
            <div class="card-body">
                {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}

                <div class="form-group">
                    {{ Form::label('name', 'Permission Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>
                <br>
                {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
            </div>
        </div>
</div>

@endsection