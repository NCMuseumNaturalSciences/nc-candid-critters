@extends('layouts.coreui.master')
@section('title', 'Assign Library')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Assign Library @if($volunteer){{ $volunteer->first_name }} {{ $volunteer->last_name }}@endif
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'libraries.assign']) !!}
                @if($volunteer){!! Form::hidden('volunteer_id', $volunteer->id) !!}@endif
                @include('errors.form_error')
                @include('admin.libraries.assign.form', ['btnclass' => 'btn btn-success text-center', 'submitTextButton' => 'Assign Library'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
