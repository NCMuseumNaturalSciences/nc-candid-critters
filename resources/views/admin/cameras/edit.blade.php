@extends('layouts.coreui.master')
@section('title', 'Update Camera')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Update Camera
            </div>
            <div class="card-body">
                {!! Form::model($camera, ['method' => 'PATCH', 'action' => ['Admin\CamerasController@update', $camera->id] ]) !!}
                @include('errors.form_error')
                @include('admin.cameras.form', ['btnclass' => 'btn btn-custom-update center-block', 'submitTextButton' => 'Update Camera'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
