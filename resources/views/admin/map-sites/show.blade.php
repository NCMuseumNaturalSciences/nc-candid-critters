@extends('layouts.coreui.master')
@section('title', 'Map Sites')
@section('content')
    @include('layouts.status')
    <input type="hidden" name="siteid" id="siteid" value="{{ $site->id }}">
        <div class="card card-map-site">
            <div class="card-header">
                Map Sites
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-show table-bordered table-striped table-hover">
                                <tbody>
                                <tr>
                                    <th class="col-md-4">Site Name</th>
                                    <td class="col-md-8">{{ $site->site_name }}</td>
                                </tr>
                                <tr>
                                    <th>Site Number</th>
                                    <td>{{ $site->site_number }}</td>
                                </tr>
                                <tr>
                                    <th>Latitude</th>
                                    <td>{{ $site->lat }}</td>
                                </tr>
                                <tr>
                                    <th>Longitude</th>
                                    <td>{{ $site->long }}</td>
                                </tr>
                                <tr>
                                    <th>County</th>
                                    <td>{{ $site->county }}</td>
                                </tr>
                                <tr>
                                    <th>Land Cover</th>
                                    <td>{{ $site->land_cover }}</td>
                                </tr>
                                <tr>
                                    <th>Property Name</th>
                                    <td>{{ $site->property_name }}</td>
                                </tr>
                                <tr>
                                    <th>Approved?</th>
                                    <td>@if($site->approved_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Display on Map?</th>
                                    <td>@if($site->display_on_map_yn == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date Added to Map</th>
                                    <td>{{ $site->date_added_map }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $site->status }}</td>
                                </tr>
                                <tr>
                                    <th>Google Sheet Source</th>
                                    <td>{{ $site->source_gsheet_name }}</td>
                                </tr>
                                <tr>
                                    <th>Burn Season</th>
                                    <td>{{ $site->burn_season }}</td>
                                </tr>
                                <tr>
                                    <th>Logging Season</th>
                                    <td>{{ $site->logging_season }}</td>
                                </tr>
                                <tr>
                                    <th>Remarks</th>
                                    <td>{{ $site->remarks }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="map-wrapper">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-custom-update" href="{{ url('/admin/map-sites/'.$site->id.'/edit') }}"><i class="fa fa-refresh"></i> Update</a>
                <a class="btn btn-primary" href="{{ url('/admin/map-sites') }}">Back to List</a>
            </div>
        </div>
@include('admin.modals.map-dialog')

@endsection
@push('inc-styles')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css">
    <link rel="stylesheet" type="text/css" href="{!! asset('styles/leaflet/leaflet.awesome-markers.css') !!}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/admin-map.css') }}">
@endpush
@push('inc-scripts')
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
            integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
            crossorigin=""></script>
    <script src="https://unpkg.com/esri-leaflet@2.1.4/dist/esri-leaflet.js"
            integrity="sha512-m+BZ3OSlzGdYLqUBZt3u6eA0sH+Txdmq7cqA1u8/B2aTXviGMMLOfrKyiIW7181jbzZAY0u+3jWoiL61iLcTKQ=="
            crossorigin=""></script>
    <script type="text/javascript" src="{!! asset('js/leaflet/leaflet.awesome-markers.min.js') !!}"></script>
    <script type="text/javascript" src="{{ asset('js/leaflet/L.Control.Sidebar.js') }}"></script>
@endpush
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var baseLayer1 = L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Tiles courtesy of <a href="http://hot.openstreetmap.org/" target="_blank">Humanitarian OpenStreetMap Team</a>'
            });
            var baseLayer2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Specialty/DeLorme_World_Base_Map/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Copyright: &copy;2012 DeLorme',
                minZoom: 1,
                maxZoom: 11
            });
            var map = L.map('map', {
                center: [40, -20],
                zoom: 4,
                zoomControl: true
            });

            baseLayer1.addTo(map);

            var baseMaps = {
                "World Imagery": baseLayer1,
                "OpenStreet": baseLayer2,
            };
            L.control.layers(baseMaps).addTo(map);

            var siteid = $("#siteid").val();
            var url = '{{ url("api/v1/geojson/site") }}' + '/' + siteid;

            var geojsonLayer = L.geoJson(null, {
                onEachFeature: onEachFeature,
                pointToLayer: function (feature, latlng) {
                    return L.circleMarker(latlng, geojsonMarkerOptions);
                }
            })

            var geojsonMarkerOptions = {
                radius: 8,
                fillColor: "#ff7800",
                color: "#000",
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8
            };


            $( "#map-dialog" ).dialog({
                autoOpen: false,
                draggable: true,
                dialogClass: 'map-dialog-ui',
                width: 500,
                buttons: [
                    {
                        text: "Close",
                        click: function () {
                            $(this).dialog("close");
                        }
                    }
                ],
                show: {
                    effect: "fade",
                    duration: 500
                },
            });


            function onEachFeature(feature, layer) {
                layer.on('click', function(e){
                    console.log("Clicked");
                    $('a.infowin-claimsitebtn').attr('href','');
                    $('.infowin-lat').html(layer.feature.properties.lat);
                    $('.infowin-long').html(layer.feature.properties.long);
                    $('a.infowin-zoombtn').attr('href','');
                    $('#map-dialog').dialog('option', 'title', 'Deployment Site: ' + layer.feature.properties.site_name);
                    $('#map-dialog').dialog("open");
                });
            }

            function createMap(data) {
                geojsonLayer.addData(data);
                geojsonLayer.addTo(map);
                var bounds = geojsonLayer.getBounds();
                map.fitBounds(bounds);
                console.log(bounds);
                console.log(data.lat);
                var layercnt = geojsonLayer.getLayers().length;
            };

            function getMapData() {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: url,
                    success: function (data) {
                        console.log(data);
                        createMap(data);
                    },
                    error: function (data) {
                        alert('An Error was Encountered.')
                    }
                })
            }
            getMapData();
        });
        </script>
    @endpush