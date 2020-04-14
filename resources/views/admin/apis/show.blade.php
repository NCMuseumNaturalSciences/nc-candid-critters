@extends('layouts.coreui.master')
@section('title', 'API Home')
@section('content')
    @include('layouts.status')
    <div class="animated fadeIn">
        <div class="col-lg-10 col-md-12">
            <div class="card">
            <div class="card-header">
                API Information
            </div>
            <div class="card-body card-show">
                <div class="table-responsive">
                    <h4 class="table-title">NC Candid Critters Data Manager API</h4>
                    <table class="table table-striped table-condensed">
                            <tbody>
                                <tr>
                                    <th>All Available Deployment Sites</th>
                                    <td><a target="_blank" href="{{ url('/api/v1/geojson/sites/all') }}">{{ url('/api/v1/geojson/sites/all') }}</a></td>
                                    <td>All sites available for camera deployments in GeoJSON-format</td>
                                </tr>
                                <tr>
                                    <th>Deployment Site Information</th>
                                    <td>{{ url('/api/v1/geojson/site/') }}/id <a target="_blank" href="{{ url('/api/v1/geojson/site/3') }}">(Test)</a></td>
                                    <td>A single site (by id) available for a camera deployment in GeoJSON-format</td>
                                </tr>
                                <tr>
                                    <th>Cameras</th>
                                    <td><a target="_blank" href="{{ url('/api/v1/cameras') }}">{{ url('/api/v1/cameras') }}</a></td>
                                    <td>All cameras acceptable for camera trap studies in JSON-format</td>
                                </tr>

                                <tr>
                                    <th>Libraries</th>
                                    <td><a target="_blank" href="{{ url('/api/v1/libraries') }}">{{ url('/api/v1/libraries') }}</a></td>
                                    <td>All North Carolina libraries in JSON-format</td>
                                </tr>
                                <tr>
                                    <th>Libraries (Spatial)</th>
                                    <td><a target="_blank" href="{{ url('/api/v1/geojson/libraries') }}">{{ url('/api/v1/geojson/libraries') }}</a></td>
                                    <td>All North Carolina libraries in GeoJSON-format</td>
                                </tr>
                            </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <h4 class="table-title">NCMNS Data Stores API</h4>
                    <table class="table table-striped table-condensed">
                        <tbody>
                            <tr>
                                <th>Countries</th>
                                <td><a target="_blank" href="https://api.naturalsciences.org/api/v1/countries">https://api.naturalsciences.org/api/v1/countries</a></td>
                                <td>All countries with ISO-3166 codes, name variations, and all associated first order divisions</td>
                            </tr>
                            <tr>
                                <th>First Order Divisions</th>
                                <td><a target="_blank" href="https://api.naturalsciences.org/api/v1/first-order-divisions">https://api.naturalsciences.org/api/v1/first-order-divisions</a></td>
                                <td>All first order geopolitical divisions with associated country information</td>
                            </tr>
                            <tr>
                                <th>EXIF Metatags</th>
                                <td><a target="_blank" href="https://api.naturalsciences.org/api/v1/exiftags">https://api.naturalsciences.org/api/v1/exiftags</a></td>
                                <td>All EXIF Metadata tags (version 2.3)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
        </div>
    </div>
@endsection
