@extends('layouts.coreui.master')
@section('title', 'Profile')
@section('content')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                {{ $user->fname }} {{ $user->lname }}
                <a class="btn btn-custom-update pull-right" href="{{ url('/librarian/profile/edit') }}"><i class="fa fa-refresh"></i> Edit Profile</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-show table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $user->fname }} {{ $user->lname }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                    </tr>
                                    <tr>
                                        <th>Assigned Library</th>
                                        <td><a href="{{ url('/librarian/library') }}">{{ $library->library_name }}</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
