@extends('layouts.coreui.master')
@section('title', 'Signup')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <span class="col text-left">
                        <h3 class="card-title">
                        {{ $signup->first_name }} {{ $signup->last_name }} | Signup {{ $signup->id }}<br>
                        </h3>
                    </span>
                    <span class="col text-right">
                        <h4 class="card-subtitle">
                        @if($signup->acf_uploader_yn == 1) Uploader @else Non-Uploader @endif
                        @if($signup->acf_borrower_yn == 1) Borrower @else BYO @endif
                        </h4>
                    </span>
                </div>
            </div>
            <div class="card-body card-show">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-show table-bordered table-striped table-hover">
                                <tbody>
                                <tr>
                                    <th>Signup ID</th>
                                    <td>{{ $signup->id }}</td>
                                </tr>
                                <tr>
                                    <th>Uploader?</th>
                                    <td>
                                        @if($signup->acf_uploader_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Borrower?</th>
                                    <td>
                                        @if($signup->acf_borrower_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                    <!-- General Information -->
                                <tr class="title-row">
                                    <th colspan="2">Section: General Information</th>
                                </tr>
                                <tr>
                                    <th>First Name</th>
                                    <td>{{ $signup->first_name }}</td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td>{{ $signup->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $signup->email }}</td>
                                </tr>
                                <tr>
                                    <th>Telephone</th>
                                    <td>{{ $signup->telephone }}</td>
                                </tr>
                                <tr>
                                    <th>Organization</th>
                                    <td>{{ $signup->organization }}</td>
                                </tr>
                                <tr>
                                    <th>Are you a teacher that plans to use a camera with students?</th>
                                    <td>
                                        @if($signup->teacher_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Are you a hunter?</th>
                                    <td>
                                        @if($signup->hunter_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                    <!-- Location -->
                                <tr class="title-row">
                                    <th colspan="2">Section: Location</th>
                                </tr>
                                <tr>
                                    <th>County</th>
                                    <td>{{ $signup->county }}</td>
                                </tr>
                                <tr>
                                    <th>Confirm camera will be deployed in North Carolina?</th>
                                    <td>
                                        @if($signup->confirm_nc_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                    <!-- Uploads -->
                                @if($signup->acf_uploader_yn == 1)
                                <tr class="title-row">
                                    <th colspan="2">Section: Uploads (Uploaders Only)</th>
                                </tr>
                                <tr>
                                    <th>Commit to Upload?</th>
                                    <td>
                                        @if($signup->commit_upload_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                </tr>
                                <tr>
                                    <th>PC Verification?</th>
                                    <td>
                                        @if($signup->pc_verify_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Time Commitment?</th>
                                    <td>
                                        @if($signup->time_commit_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                @endif
                    <!-- Data Delivery -->
                                @if($signup->acf_uploader_yn == 0)
                                <tr class="title-row">
                                    <th colspan="2">Section: Data Delivery (Non-uploaders Only)</th>
                                </tr>
                                <tr>
                                    <th>Delivery Method</th>
                                    <td>{{ $signup->delivery_method }}</td>
                                </tr>
                                <tr>
                                    <th>Commit to provide NC Candid Critters with Data?</th>
                                    <td>
                                        @if($signup->commit_provide_nccc_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                @endif
                    <!-- Camera Pickup and Drop-off -->
                                @if(!empty($library))

                                <tr class="title-row">
                                    <th colspan="2">Section: Camera Pickup and Drop-off</th>
                                </tr>
                                <tr>
                                    <th>Selected Library</th>
                                    <td>{{ $library->library_name }}</td>
                                </tr>
                                <tr>
                                    <th>Selected Library Address</th>
                                    <td>{{ $library->street_address }} {{ $library->city }} NC, {{ $library->zip }}</td>
                                </tr>
                                <tr>
                                    <th>Library?</th>
                                    <td>
                                        @if($signup->library_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Commit Return?</th>
                                    <td>
                                        @if($signup->commit_return_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                @endif
                    <!-- Additional Questions -->
                                <tr class="title-row">
                                        <th colspan="2">Section: Additional Questions</th>
                                    </tr>
                                    <tr>
                                        <th>Interests</th>
                                        <td>{{ $signup->interests }}</td>
                                    </tr>
                                    <tr>
                                        <th>Comments</th>
                                        <td>{{ $signup->comments }}</td>
                                    </tr>
                     <!-- Waivers -->
                                    <tr class="title-row">
                                        <th colspan="2">Section: Waivers</th>
                                    </tr>
                                    <tr>
                                        <th>Photography Waiver</th>
                                        <td>
                                            @if($signup->permission_yn == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Participation Waiver</th>
                                        <td>
                                            @if($signup->responsible_yn == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

           <!-- Import Data Only Table -->
                            @if($signup->import_yn == 1)
                            <table class="table table-show table-bordered table-striped table-hover">
                                <tbody>
                                <tr class="title-row">
                                    <th colspan="2">Imported Legacy Data</th>
                                </tr>

                                    <tr>
                                        <th>Camera Location</th>
                                        <td>{{ $signup->camera_location }}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{ $signup->city }}</td>
                                    </tr>
                                    <tr>
                                        <th>Zip Code</th>
                                        <td>{{ $signup->zip_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Desired Start Date</th>
                                        <td>{{ $signup->desired_start_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>How Learn</th>
                                        <td>{{ $signup->how_learn }}</td>
                                    </tr>
                                    <tr>
                                        <th>Project Reference</th>
                                        <td>{{ $signup->project_ref }}</td>
                                    </tr>

                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="table-responsive">
            <!-- Administrative Table -->
                            <table class="table table-show table-bordered table-striped table-hover">
                                <tbody>
                                    <tr class="title-row">
                                        <th colspan="2">Administrative</th>
                                    </tr>
                                    <tr>
                                        <th>Training Status</th>
                                        <td>
                                            @if($signup->training_status_id == 1)
                                                Unassigned
                                            @elseif($signup->training_status_id == 2)
                                                Assigned
                                            @elseif($signup->training_status_id == 3)
                                                Completed
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Admin Remarks</th>
                                        <td>{{ $signup->admin_remarks }}</td>
                                    </tr>
                                    <tr>
                                        <th>Submission Timestamp</th>
                                        <td>{{ $signup->created_at->format('m/d/Y g:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Volunteer Activated?</th>
                                        <td>
                                            @if($signup->volunteer_yn == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                    </tr>
                                    @if($signup->import_yn == 1)
                                        <tr>
                                            <th>Imported Record?</th>
                                            <td>
                                                @if($signup->imported_yn == 1)
                                                    Yes
                                                    @else
                                                    No
                                                    @endif
                                            </td>
                                        </tr>
                                    <tr>
                                        <th>Google Sheet Source</th>
                                        <td>{{ $signup->gsheet_src }}</td>
                                    </tr>
                                        @endif
                                    @if(!empty($camera))
                                    <tr>
                                        <th>Selected Camera</th>
                                        <td><a href="{{ url('/admin/cameras/'.$camera->id.'/show') }}">{{ $camera->make }} {{ $camera->model }}</a></td>
                                    </tr>
                                    @endif
                                    @if(!empty($camera))
                                        @if ($library)
                                        <tr>
                                            <th>Selected Library Name</th>
                                            <td><a href="{{ url('/admin/libraries/'.$library->id.'/show') }}">{{ $library->library_name }}</a></td>
                                        </tr>
                                            @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
                <!--
            <button type="button" class="btn btn-custom-update" data-toggle="modal" data-target="#editSignupModal">
                Edit Signup
            </button>
            -->
                <a href="{{ url('/admin/signups/'. $signup->id .'/edit') }}" class="btn btn-custom-update">Edit Signup</a>
            @if (!empty($signup->volunteer))
                <a href="{{ url('/admin/volunteers/'. $signup->volunteer->id .'/show') }}" class="btn btn-custom-view">View Volunteer Profile</a>
            @else
                    <a href="{{ action('Admin\SignupsController@activateSingleVolunteer', $signup->id) }}" class="btn btn-custom-success">Activate Volunteer</a>
                @endif

            </div>

        </div>
    </div>
    @include('admin.modals.edit-signup')
@endsection
