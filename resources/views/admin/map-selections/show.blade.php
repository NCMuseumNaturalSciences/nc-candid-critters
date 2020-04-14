@extends('layouts.coreui.master')
@section('title', 'Selected Sites')
@section('content')
    @include('layouts.status')
    <h2>Selected Sites</h2>
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                {{ $site->first_name }} {{ $site->last_name }}
            </div>
            <div class="card-body card-show">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-show table-bordered table-striped table-hover table-sm">
                                <tbody>
                                <tr>
                                    <th scope="row">Map Site ID</th>
                                    <td>{{ $site->id }}</td>
                                </tr>
                                <tr>
                                    <th>Site Name</th>
                                    <td>{{ $site->mapSite->site_name }}</td>
                                </tr>
                                <tr>
                                    <th>Site Number</th>
                                    <td>{{ $site->mapSite->site_number }}</td>
                                </tr>
                                <tr>
                                    <th>Map Site Latitude</th>
                                    <td>{{ $site->mapSite->lat }}</td>
                                </tr>
                                <tr>
                                    <th>Map Site Longitude</th>
                                    <td>{{ $site->mapSite->long }}</td>
                                </tr>
                                <tr>
                                    <th>County</th>
                                    <td>{{ $site->mapSite->county }}</td>
                                </tr>
                                <tr>
                                    <th>Land Cover</th>
                                    <td>{{ $site->mapSite->land_cover }}</td>
                                </tr>
                                <tr>
                                    <th>Property Name</th>
                                    <td>{{ $site->mapSite->property_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">First Name</th>
                                    <td>{{ $site->first_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Last Name</th>
                                    <td>{{ $site->last_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $site->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Emammal User ID</th>
                                    <td>{{ $site->emammal_user_id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Delivery Method</th>
                                    <td>{{ $site->delivery_method }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Submission Latitude</th>
                                    <td>{{ $site->acf_lat }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Submission Longitude</th>
                                    <td>{{ $site->acf_long }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Deployment Created?</th>
                                    <td>
                                        @if (!empty($site->deployment))
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
                                <tr>
                                    <th scope="row">Deployment Name</th>
                                    <td>{{ $site->deployment_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Site Selected from Map?</th>
                                    <td>Yes</td>
                                </tr>
                                <tr>
                                    <th scope="row">Deployment Created?</th>
                                    <td>
                                        @if (!empty($site->deployment))
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Submission Timestamp</th>
                                    <td>{{ $site->created_at->format('m/d/Y g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Last Updated</th>
                                    <td>{{ $site->updated_at->format('m/d/Y g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Delivery Method</th>
                                    @if($signup)
                                        <td>{{ $signup->delivery_method }}</td>
                                    @else
                                        <td>Email address not found in Signups</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        @if($site->deployment_yn == 0)
                            @if(!$volunteer)
                                <div class="message caution-message">The email submitted doesn't exist in the volunteer table. No corresponding volunteer profile found. Please correct before creating deployment.</div>
                            @endif
                        @endif
                        <a href="{{ url('/admin/map-selections/'.$site->id.'/edit') }}" class="btn btn-custom-update"><i class="fa fa-refresh"></i> Update</a>

                        <a href="{{ url('map/site-description/'.$site->id) }}" target="_blank" class="btn btn-custom-view pull-left">View Map</a>

                        @if (!empty($site->deployment))
                            <h4 class="pull-right">Deployment Created</h4>
                        @else
                            <a href="{{ action('Admin\SiteDescriptionsController@activateSingleDeployment', $site->id) }}" class="btn btn-custom-success pull-right">Create Deployment</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection