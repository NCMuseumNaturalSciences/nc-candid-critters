@extends('layouts.coreui.master')
@section('title', 'Edit Map Selection')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Edit Map Selection
                <div class="pull-right">Submission {{ $model->id }}<br>Map Site {{ $model->map_site_id }}</div>
                <div class="clearfix"></div>
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::model($model, ['method' => 'PATCH', 'action' => ['Admin\MapSelectionsController@update', $model->id] ]) !!}
                        @include('errors.form_error')
                        @include('admin.map-selections.form', ['btnclass' => 'btn btn-custom-update center-block', 'submitTextButton' => 'Update Map Selection'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
