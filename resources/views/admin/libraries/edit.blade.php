@extends('layouts.coreui.master')
@section('title', 'Update Library')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Update Library
            </div>
            <div class="card-body">
                {!! Form::model($library, ['method' => 'PATCH', 'action' => ['Admin\LibrariesController@update', $library->id] ]) !!}
                @include('errors.form_error')
                @include('admin.libraries.edit-form', ['btnclass' => 'btn btn-custom-update center-block', 'submitTextButton' => 'Update Library'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
