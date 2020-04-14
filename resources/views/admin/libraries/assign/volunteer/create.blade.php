@extends('layouts.coreui.master')
@section('title', 'Assign Library to Volunteer')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                Assign Library to @if($volunteer){{ $volunteer->first_name }} {{ $volunteer->last_name }} ({{ $volunteer->id }})@endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($chosenLibrary)
                            <p>Chosen Library: {{ $chosenLibrary->library_name }}</p>
                        @endif
                        {!! Form::open(['route' => 'admin.libraries.assign.volunteer']) !!}
                        @if($volunteer)
                            {!! Form::hidden('volunteer_id', $volunteer->id) !!}
                        @endif

                        @include('errors.form_error')
                        @include('admin.libraries.assign.volunteer.form')
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
