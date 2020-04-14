@extends('layouts.coreui.master')
@section('title', 'Create Camera')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Create Camera
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'cameras.create']) !!}
                @include('errors.form_error')
                @include('admin.cameras.form', ['btnclass' => 'btn btn-success center-block', 'submitTextButton' => 'Add Camera'])
                {!! Form::close() !!}
 	       </div>
        </div>
    </div>
@endsection
