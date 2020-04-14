@extends('layouts.coreui.master')
@section('title', '| Edit Profile')
@section('content')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <i class='fa fa-user-plus'></i> Edit {{$user->fname}} {{$user->lname}} </div>
            <div class="card-body">
                {{ Form::model($user, array('route' => array('librarian.profile.update', $user->id), 'method' => 'PATCH')) }} {{-- Form model binding to automatically populate our fields with user data --}}

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