@extends('layouts.coreui.master')
@section('title', '| Users')
@section('content')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-users"></i> User Administration
                <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
                <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date/Time Added</th>
                                <th>User Roles</th>
                                <th>Operations</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                            <tr>

                                <td>{{ $user->fname }} {{$user->lname}}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                                <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}

                                <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-custom-update pull-left" style="margin-right: 3px;">Edit</a>
                                    @include('utils.destroy',array('url' => '/admin/users', 'id' => $user->id))
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-success">Add User</a>
            </div>
        </div>
    </div>

@endsection