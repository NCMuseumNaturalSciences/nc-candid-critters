@extends('layouts.coreui.master')
@section('title', 'Update Library')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Update My Library: {{ $library->library_name }}
            </div>
            <div class="card-body">
                {!! Form::model($library, ['method' => 'PATCH', 'action' => ['Librarian\LibraryController@update', $library->id] ]) !!}
                @include('errors.form_error')
                @include('librarian.library.form', ['btnclass' => 'btn btn-warning center-block', 'submitTextButton' => 'Update Library'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
