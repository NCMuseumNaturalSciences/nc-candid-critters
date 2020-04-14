@extends('layouts.coreui.master')
@section('title', 'Create Library')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Create Library
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'libraries.create']) !!}
                @include('errors.form_error')
                @include('admin.libraries.form', ['btnclass' => 'btn btn-success text-center', 'submitTextButton' => 'Add Library'])
                {!! Form::close() !!}
 	       </div>
        </div>
    </div>
@endsection
