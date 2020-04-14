@extends('layouts.coreui.master')
@section('title', 'Create Map Site')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Create Map Site
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'mapSites.create']) !!}
                @include('errors.form_error')
                @include('admin.map-sites.form', ['btnclass' => 'btn btn-success center-block', 'submitTextButton' => 'Add Map Site'])
                {!! Form::close() !!}
 	       </div>
        </div>
    </div>
@endsection
