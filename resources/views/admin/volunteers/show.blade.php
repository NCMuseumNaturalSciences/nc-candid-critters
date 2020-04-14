@extends('layouts.coreui.master')
@section('title', 'Volunteer')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <span class="col text-left">
                        {{ $model->first_name }} {{ $model->last_name }} | Volunteer {{ $model->id }}<br>
                    </span>
                    <span class="col text-right">
                        @if($model->acf_uploader_yn == 1) Uploader @else Non-Uploader @endif
                        @if($model->acf_borrower_yn == 1) Borrower @else BYO @endif
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-show table-bordered table-striped table-hover">
                                <tbody>
                                <tr>
                                    <th>First Name</th>
                                    <td>{{ $model->first_name }}</td>
                                </tr>

                                <tr>
                                    <th>Last Name</th>
                                    <td>{{ $model->last_name }}</td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td>{{ $model->email }}</td>
                                </tr>

                                <tr>
                                    <th>Telephone</th>
                                    <td>{{ $model->telephone }}</td>
                                </tr>

                                <tr>
                                    <th>Organization</th>
                                    <td>{{ $model->organization }}</td>
                                </tr>

                                <tr>
                                    <th>County</th>
                                    <td>{{ $model->county }}</td>
                                </tr>
                                <tr>
                                    <th>Admin Remarks</th>
                                    <td>{{ $model->admin_remarks }}</td>
                                </tr>

                                @if($library)
                                    <tr>
                                        <th>Chosen Library</th>
                                        <td>{{ $library->library_name }}</td>
                                    </tr>
                                @endif
                                @if($assignedLibraries)
                                    <tr>
                                        <th>Assigned Library(s)</th>
                                        <td>@foreach($assignedLibraries as $l){{ $l->library_name }}<br> @endforeach</td>
                                    </tr>
                                    @endif
                                <tr>
                                    <th>User ID</th>
                                    <td><a href="{{ url('admin/users/'.$model->user_id.'/show') }}">View User Profile ({{ $model->user_id }})</a></td>
                                </tr>
                                <tr>
                                    <th>Signup Id</th>
                                    <td><a href="{{ url('admin/signups/'.$model->signup_id.'/show') }}">View Signup</a></td>
                                </tr>
                                <tr>
                                    <th>Imported Signup?</th>
                                    <td>
                                        @if($model->signup->imported_yn == 1)
                                            Yes
                                        @else
                                        No
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <h4>Library Assignments</h4>
                        <div class="table-responsive">
                            <table class="table table-show table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Library</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assignedLibraries as $l)
                                    <tr>
                                        <td>{{ $l->library_name }}</td>
                                        <td>
                                            <a href="{{ url('admin/libraries/'.$l->library_id.'/show') }}" class="btn btn-custom-view"><i class="fa fa-eye" aria-hidden="true"/></i></a>
                                            {!! Form::open(['method'=>'DELETE','route' => ['admin.volunteers.assignment.destroy', $model->id, $l->assignment_id], 'style' => 'display:inline']) !!}
                                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"/></i>', array('type' => 'submit','class' => 'btn btn-custom-destroy')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-show table-bordered table-striped table-hover">
                                <tbody>
                        <tr>
                            <th>Activation Date</th>
                            <td>{{ $model->activation_date }}</td>
                        </tr>


                        <tr>
                            <th>Libraries Notes</th>
                            <td>{{ $model->libraries_notes }}</td>
                        </tr>

                        <tr>
                            <th>Koozie Form Sent?</th>
                            <td>
                                @if($model->koozie_form_sent_yn == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Koozie Sent?</th>
                            <td>
                                @if($model->koozie_yn == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>T-Shirt Form Sent?</th>
                            <td>
                                @if($model->tshirt_form_sent_yn == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>T-Shirt Sent?</th>
                            <td>
                                @if($model->tshirt_sent_yn == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                        </tr>


                        <tr>
                            <th>Created At</th>
                            <td>{{ $model->created_at }}</td>
                        </tr>

                        <tr>
                            <th>Updated At</th>
                            <td>{{ $model->updated_at }}</td>
                        </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-custom-update" href="{{ url('/admin/volunteers/'.$model->id.'/edit') }}"><i class="fa fa-refresh"></i> Update</a>
                <a class="btn btn-custom-success" href="{{ url('/admin/libraries/assign/volunteer/'.$model->id) }}"><i class="fa fa-hand-paper-o"></i> Assign Library</a>
            </div>
        </div>
    </div>
@endsection