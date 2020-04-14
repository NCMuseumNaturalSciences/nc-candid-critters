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
                                    <th>City</th>
                                    <td>{{ $model->city }}</td>
                                </tr>

                                <tr>
                                    <th>Zip Code</th>
                                    <td>{{ $model->zip_code }}</td>
                                </tr>

                                <tr>
                                    <th>Admin Remarks</th>
                                    <td>{{ $model->admin_remarks }}</td>
                                </tr>
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
                                    <th>Number Deployments</th>
                                    <td>{{ $model->number_deployments }}</td>
                                </tr>

                                <tr>
                                    <th>Number Deployments_registered</th>
                                    <td>{{ $model->number_deployments_registered }}</td>
                                </tr>

                                <tr>
                                    <th>Number Deployments_uploaded</th>
                                    <td>{{ $model->number_deployments_uploaded }}</td>
                                </tr>

                                <tr>
                                    <th>Libraries Notes</th>
                                    <td>{{ $model->libraries_notes }}</td>
                                </tr>

                                <tr>
                                    <th>Koozie Yn</th>
                                    <td>{{ $model->koozie_yn }}</td>
                                </tr>
                                <tr>
                                    <th>Training Completed?</th>
                                    <td>{{ $model->training_complete_yn }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $model->created_at }}</td>
                                </tr>

                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $model->updated_at }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $model->status }}</td>
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