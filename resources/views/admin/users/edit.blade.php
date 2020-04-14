@extends('layouts.coreui.master')
@section('title', '| Edit User')

@section('content')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <i class='fa fa-user-plus'></i> Edit {{$user->fname}} {{$user->lname}} </div>
            <div class="card-body">
    {{-- @include ('errors.list') --}}
                {!! Form::model($user, ['method' => 'POST', 'action' => ['Admin\UsersController@update', $user->id] ]) !!}

    <div class="form-group">
        {{ Form::label('fname', 'First Name') }}
        {{ Form::text('fname', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('lname', 'Last Name') }}
        {{ Form::text('lname', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Give Role</b></h5>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Password') }}<br>
        {{ Form::password('password', array('class' => 'form-control')) }}

    </div>

    <div class="form-group">
        {{ Form::label('password', 'Confirm Password') }}<br>
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

    </div>

    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection