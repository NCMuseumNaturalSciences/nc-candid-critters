@extends('layouts.coreui.master')
@section('title', 'Update Volunteer')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">

                <div class="card">
                    <div class="card-header">
                        Update Volunteer
                    </div>
                    <div class="card-body">
                        {!! Form::model($model, ['method' => 'PATCH', 'action' => ['Admin\VolunteersController@update', $model->id] ]) !!}
                        @include('errors.form_error')
                        <fieldset>
                            @include('admin.volunteers.form')
                            <button type="submit" class="btn btn-custom-update">Update</button>
                        </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
