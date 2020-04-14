@extends('layouts.coreui.master')
@section('title', 'Profile')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                {{ $user->fname }} {{ $user->lname }} | {{ $user->id }}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-show table-bordered table-striped table-hover">
                        <tbody>
                        <tr>
                            <th>User ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->fname }} {{ $user->lname }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                        </tr>
                        <tr>
                            <th>Roles</th>
                            <td>{{  $user->roles()->pluck('name')->implode(', ') }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>

@endsection