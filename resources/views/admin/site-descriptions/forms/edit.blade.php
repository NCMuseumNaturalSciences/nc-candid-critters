@extends('layouts.coreui.master')
@section('title', 'Edit Site Description')
@section('content')
@include('layouts.status')
<div class="animated fadeIn">
    <div class="card">
        <div class="card-header">
            Edit Site Description {{ $model->id }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($model, ['method' => 'PATCH', 'action' => ['Admin\SiteDescriptionsController@update', $model->id] ]) !!}
                    @include('errors.form_error')
                    @include('admin.site-descriptions.forms.form', ['btnclass' => 'btn btn-custom-update center-block', 'submitTextButton' => 'Update Site Description'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
