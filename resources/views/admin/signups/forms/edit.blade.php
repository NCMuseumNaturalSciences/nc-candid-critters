@extends('layouts.coreui.master')
@section('title', 'Edit Signup')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <span class="col text-left">
                        <h4 class="card-title">Edit Signup {{ $signup->id }}</h4>
                    </span>
                    <span class="col text-right">
                        <h4 class="card-subtitle">Form Type: {{ $formtitle }}</h4>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::model($signup, ['method' => 'PATCH', 'action' => ['Admin\SignupsController@update', $signup->id] ]) !!}
                        @include('errors.form_error')
                        @include('admin.signups.forms.form', ['btnclass' => 'btn btn-custom-update center-block', 'submitTextButton' => 'Update Signup'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
