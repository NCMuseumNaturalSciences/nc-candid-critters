@extends('layouts.master')
@section('title', 'Authentication Error')
@section('content')
    <div class="col-xs-12">
        <h4>You are not permitted to view this page</h4>
        @if ( Auth()->user->hasRole('user'))
            <h4><a href="{{ url('/user/dashboard') }}">Return to Dashboard</a></h4>
        @else
            <h4><a href="{{ url('/') }}">Return Home</a></h4>
        @endif
    </div>
@endsection