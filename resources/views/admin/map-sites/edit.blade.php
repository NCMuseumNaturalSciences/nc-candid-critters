@extends('layouts.coreui.master')
@section('title', 'Update Map Site')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Update Map Site
            </div>
            <div class="card-body">
                {!! Form::model($site, ['method' => 'PATCH', 'action' => ['Admin\MapSitesController@update', $site->id] ]) !!}
                @include('errors.form_error')
                @include('admin.map-sites.form', ['btnclass' => 'btn btn-custom-update center-block', 'submitTextButton' => 'Update Map Site'])

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
