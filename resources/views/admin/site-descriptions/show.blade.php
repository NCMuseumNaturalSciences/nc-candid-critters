@extends('layouts.coreui.master')
@section('title', 'Site Description Form Submission')
@section('content')
    @include('layouts.status')
    <h2>Site Description Form Submission</h2>
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                {{ $description->first_name }} {{ $description->last_name }}
                <span class="float-lg-right">
                    @if($description->acf_uploader_yn == 1) Uploader @else Non-Uploader @endif
                    @if($description->acf_borrower_yn == 1) Borrower @else BYO @endif
            </div>
            <div class="card-body card-show">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-show table-bordered table-striped table-hover table-sm">
                               <thead>
                               <tr>
                                   <th colspan="2">User Submitted Data</th>
                               </tr>
                               </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Site Description ID</th>
                                    <td>{{ $description->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Uploader</th>
                                    <td>
                                        @if($description->acf_uploader_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Borrower</th>
                                    <td>
                                        @if($description->acf_borrower_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
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
                                    <td><a href="mailto:{{ $description->email }}">{{ $description->email }}</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">Emammal User ID</th>
                                    <td>{{ $description->emammal_user_id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Delivery Method</th>
                                    <td>{{ $description->delivery_method }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mailing Address SD Card</th>
                                    <td>{{ $description->mailing_address_sd }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mailing Address Stamps</th>
                                    <td>{{ $description->mailing_address_stamps }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">County</th>
                                    <td>{{ $description->county }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Site Type</th>
                                    <td>{{ $description->site_type }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">School Property?</th>
                                    <td>
                                        @if($description->school_property_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Direction Camera Facing</th>
                                    <td>{{ $description->camera_facing }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Property Type</th>
                                    <td>{{ $description->property_type }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Property Name</th>
                                    <td>{{ $description->property_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fenced Property</th>
                                    <td>
                                        @if($description->fenced_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Hunting?</th>
                                    <td>
                                        @if($description->hunting_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Hunting Details</th>
                                    <td>{{ $description->hunting_details }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Purposeful Feeding?</th>
                                    <td>
                                        @if($description->purposeful_feeding_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Accidental Food?</th>
                                    <td>
                                        @if($description->accidental_food_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Outside Pets?</th>
                                    <td>
                                        @if($description->outside_pets_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">User Latitude</th>
                                    <td>{{ $description->user_latitude }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">User Longitude</th>
                                    <td>{{ $description->user_longitude }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Site Latitude</th>
                                    <td>{{ $description->acf_lat }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Site Longitude</th>
                                    <td>{{ $description->acf_long }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dogs Outside</th>
                                    <td>
                                        @if($description->outside_dogs_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Cats Outside</th>
                                    <td>
                                        @if($description->outside_cats_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Chickens Outside</th>
                                    <td>
                                        @if($description->outside_chickens_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Horses Outside</th>
                                    <td>
                                        @if($description->outside_horses_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">No Animals Outside?</th>
                                    <td>
                                        @if($description->outside_none_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-show table-bordered table-striped table-hover table-sm">
                                <thead>
                                <tr>
                                    <th colspan="2">Administrative Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($camera))
                                    <tr>
                                        <th>Selected Camera</th>
                                        <td><a href="{{ url('/admin/cameras/'.$camera->id.'/show') }}">{{ $camera->make }} {{ $camera->model }}</a></td>
                                    </tr>
                                @endif
                                <tr>
                                    <th scope="row">Deployment Name</th>
                                    <td>{{ $description->deployment_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Site Selected from Map?</th>
                                    <td>@if(empty($description->map_site_id))
                                            No
                                        @else
                                            {{ $description->map_site_id }}
                                            @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Deployment Created?</th>
                                    <td>
                                        @if (!empty($description->deployment))
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Submission Timestamp</th>
                                    <td>{{ $description->created_at->format('m/d/Y g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Last Updated</th>
                                    <td>{{ $description->updated_at->format('m/d/Y g:i A') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                @if($description->deployment_yn == 0)
                                    @if(!$volunteer)
                                        <div class="message caution-message">The email submitted doesn't exist in the volunteer table. No corresponding volunteer profile found. Please correct before creating deployment.</div>
                                    @else
                                        <!--
                                        <div class="message success-message">Volunteer exists</div>
                                        -->
                                    @endif
                                @endif
                                <a href="{{ url('admin/site-descriptions/' . $description->id . '/edit') }}" class="btn btn-custom-update">Update</a>
                                <a href="{{ url('map/site-description/'.$description->id) }}" target="_blank" class="btn btn-custom-view">View Map</a>
                                @if (!empty($description->deployment))
                                        <a href="{{ url('admin/deployments/' . $description->deployment->id . '/show') }}" class="btn btn-success"> View Deployment</a>
                                @else
                                    <a href="{{ action('Admin\SiteDescriptionsController@activateSingleDeployment', $description->id) }}" class="btn btn-custom-success pull-right">Create Deployment</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection