@extends('layouts.coreui.master')
@section('title', 'Deployment')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <span class="col text-left">
                        {{ $model->deployment_name }} | Deployment {{ $model->id }}<br>
                    </span>
                    <span class="col text-right">
                        @if(!$description->map_site_id)
                            @if($model->acf_uploader_yn == 1) Uploader @else Non-Uploader @endif
                            @if($model->acf_borrower_yn == 1) Borrower @else BYO @endif
                        @else
                            Map Selection
                        @endif
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
                                    <th scope="row">First Name</th>
                                    <td>{{ $description->first_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Last Name</th>
                                    <td>{{ $description->last_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $description->email }}</td>
                                </tr>
                                <tr>
                                    <th>Deployment Latitude</th>
                                    <td>{{ $model->deployment_lat }}</td>
                                </tr>
                                <tr>
                                    <th>Deployment Long</th>
                                    <td>{{ $model->deployment_long }}</td>
                                </tr>
                                <tr>
                                    <th>Deployment Name</th>
                                    <td>{{ $model->deployment_name }}</td>
                                </tr>
                                <tr>
                                    <th>Uploader Type</th>
                                    <td>@if($model->acf_uploader_yn == 1) Uploader @else Non-Uploader @endif</td>
                                </tr>
                                <tr>
                                    <th>Sent SD?</th>
                                    <td>
                                        @if($model->sent_sd_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Sent SD Card ID</th>
                                    <td>{{ $model->sent_sd_card_id }}</td>
                                </tr>
                                <tr>
                                    <th>Returned SD Card?</th>
                                    <td>
                                        @if($model->returned_sd_card_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Returned Sd Card ID</th>
                                    <td>{{ $model->returned_sd_card_id }}</td>
                                </tr>
                                <tr>
                                    <th>Google Drive?</th>
                                    <td>
                                        @if($model->google_drive_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Received Data?</th>
                                    <td>
                                        @if($model->received_data_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="change-status-wrapper">
                                    <h5>Change Upload Status</h5>
                                    <p>Current Upload Status: <strong>{{ $model->upload_status }}</strong></p>
                                    @include('admin.utils.change-deployment-status')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-show table-bordered table-striped table-hover">
                                <tbody>
                                <tr>
                                    <th>Remarks</th>
                                    <td>{{ $model->remarks }}</td>
                                </tr>
                                <tr>
                                    <th>Map Selection?</th>
                                    <td>
                                        @if($description->map_site_id)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Site Description ID</th>
                                    <td><a href="{{ url('admin/site-descriptions/'.$model->site_description_id.'/show') }}" class="btn btn-custom-view">View Site Description</a></td>
                                </tr>
                                @if(!empty($model->volunteer_id))
                                <tr>
                                    <th>Volunteer ID</th>
                                    <td><a href="{{ url('admin/volunteers/'.$model->volunteer_id.'/show') }}" class="btn btn-custom-view">View Volunteer</a></td></td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $model->created_at->format('m/d/Y g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $model->updated_at->format('m/d/Y g:i A') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-custom-update" href="{{ url('/admin/deployments/'.$model->id.'/edit') }}">Update</a>
            </div>
        </div>
    </div>
@endsection