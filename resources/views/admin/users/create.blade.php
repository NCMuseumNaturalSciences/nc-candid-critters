@extends('layouts.coreui.master')
@section('title', '| Add User')
@section('content')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <i class='fa fa-user-plus'></i> Add User
            </div>
            <div class="card-body">
                {{-- @include ('errors.list') --}}

                {{ Form::open(array('url' => 'users')) }}

                <div class="form-group">
                    {{ Form::label('fname', 'First Name') }}
                    {{ Form::text('fname', '', array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('lname', 'Last Name') }}
                    {{ Form::text('lname', '', array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::email('email', '', array('class' => 'form-control')) }}
                </div>

                <div class='form-group'>
                    @foreach ($roles as $role)
                        {{ Form::checkbox('roles[]',  $role->id ) }}
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

                {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection