@extends('layouts.frontend.master')
@section('title', 'Map Site Description')
@section('content')
    <div id="map-container">
        <input type="hidden" name="lat" id="lat"/>
        <input type="hidden" name="lng" id="lng"/>
        <input type="hidden" name="map-site-id" id="map-site-id" value="{{ $site->id }}">

        <div id="map">
            <div id="map-spinner">
                <div class="loader-inner ball-scale-multiple"></div>
            </div>
            <div id="map-loading-overlay"></div>
            <div id="map-top-bar" class="map-top-bar container-fluid">
                <div class="map-title text-left">Deployment Name: {{ $site->deployment_name }}</div>
            </div>
        </div>
    </div>
    @include('modals.site-description-dialog')
@endsection
@push('inc-styles')
    <style>
        .map-dialog-ui .ui-dialog-titlebar {display:none}
    </style>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('styles/leaflet/leaflet-measure.css') }}">
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
@endpush
@push('inc-scripts')
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/esri-leaflet@2.1.4/dist/esri-leaflet.js"></script>

    <script type="text/javascript" src="{{ asset('js/leaflet/Leaflet.Control.Custom.js') }}"></script>
    <script src="{{ asset('js/leaflet/leaflet-measure.js') }}"></script>
    <script type="text/javascript" src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>
    <script type="text/javascript" src="{{ asset('js/vendor/jquery.dialogOptions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('data/county-boundaries.js') }}"></script>
    <script type="text/javascript" src="{{ asset('data/public_fed_land_boundaries.js') }}"></script>
    <script type="text/javascript" src="{{ asset('data/fedtrails.js') }}"></script>
    <script type="text/javascript" src="{{ asset('data/nctrails.js') }}"></script>

@endpush
@push('scripts')
    <script type="text/javascript">
        $('.loader-inner').loaders();
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $("#site-info-dialog").dialog({
                autoOpen: false,
                draggable: true,
                dialogClass: 'map-dialog-ui',
                width: 768,
                responsive: true,
                position: {my: "left top", at: "left top", of: "#map"},
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
                //open: function(event, ui) {
                 //   jQuery('.ui-dialog-titlebar-close').removeClass("ui-dialog-titlebar-close").html('<span class="close-dialog"><i class="fa far fa-window-close"></i></span>');
                //},
            });

            var baseLayer3 = L.esri.tiledMapLayer({
                url: "http://services.arcgisonline.com/ArcGIS/rest/services/USA_Topo_Maps/MapServer",
                maxZoom: 12,
            });
            var baseLayer6 = L.esri.basemapLayer('Streets');
            var baseLayer7 = L.esri.basemapLayer('NationalGeographic');
            var baseLayer8 = L.esri.basemapLayer('ImageryClarity');
            var baseLayer9 = L.esri.basemapLayer('ImageryLabels');

            var map = L.map('map', {
                center: [40, -20],
                zoom: 2,
                zoomControl: false
            });

            var measureControl = new L.Control.Measure({
                completedColor: '#00FF22',
                primaryLengthUnit: 'miles',
                secondaryLengthUnit: 'feet'
            });
            var fullscreen = new L.Control.Fullscreen({
                position: 'topright'
            });
            var mapScale = L.control.scale({
                maxWidth: 150,
                position: 'bottomright'
            });
            var mapZoom = L.control.zoom({
                position: 'topright'
            });

            var boundariesStyle = { fillColor: '#bdd7e7', opacity: 0.4, fillOpacity: 0.2, weight: 0.5 };
            var highlightStyle = { fillColor: '#08519c', opacity: 0.7, fillOpacity: 0.4, weight: 1, color: '#08519c' };
            var trailStyle = { fillColor: '#bdd7e7', opacity: 1, fillOpacity: 0.2, weight: 2, color: "#FF0000" };

            var fedBoundariesLayer;
            var ncTrailsLayer;
            var fedTrailsLayer;
            fedBoundariesLayer = L.geoJson(fedboundaries, {
                style: boundariesStyle,
                onEachFeature: function (feature, layer) {
                    var center = layer.getBounds().getCenter();
                    if (feature.properties && feature.properties.MA_NAME) {
                        layer.bindPopup(feature.properties.MA_NAME);
                    }
                    layer.on("mouseover", function (e) {
                        layer.setStyle(highlightStyle);
                    })
                    layer.on("mouseout", function (e) {
                        layer.setStyle(boundariesStyle);
                    })
                    layer.on('click', function () {
                        var bounds = layer.getBounds();
                        map.fitBounds(bounds);
                        layer.openPopup();
                    });
                }
            }).addTo(map);
            ncTrailsLayer = L.geoJson(nctrails, {
                style: trailStyle,
                onEachFeature: function (feature, layer) {
                    if (feature.properties && feature.properties.PK_ABBR) {
                        layer.bindPopup("NC Trail: " + feature.properties.PK_ABBR);
                    }
                    layer.on("mouseover", function (e) {
                        layer.setStyle(highlightStyle);
                    })
                    layer.on("mouseout", function (e) {
                        layer.setStyle(trailStyle);
                    })
                    layer.on('click', function () {
                        var bounds = layer.getBounds();
                        map.fitBounds(bounds);
                        layer.openPopup();
                    });
                }
            }).addTo(map);
            fedTrailsLayer = L.geoJson(fedtrails, {
                style: boundariesStyle,
                onEachFeature: function (feature, layer) {
                    if (feature.properties && feature.properties.COUNTY) {
                        layer.bindPopup("Federal Trail");
                    }
                    layer.on("mouseover", function (e) {
                        layer.setStyle(highlightStyle);
                    })
                    layer.on("mouseout", function (e) {
                        layer.setStyle(boundariesStyle);
                    })
                    layer.on('click', function () {
                        var bounds = layer.getBounds();
                        map.fitBounds(bounds);
                        layer.openPopup();
                    });
                }
            }).addTo(map);

            var markerStyle = {
                stroke: true,
                color: '#643975',
                opacity: 1,
                weight: 2,
                fill: true,
                fillColor: '#9E5CB8',
                fillOpacity: 0.9,
                radius: 8
            };

            var siteLayer;

            siteLayer = L.geoJson(null, {
                onEachFeature: onEachFeature,
                pointToLayer: function (feature, latlng) {
                    return L.circleMarker(latlng, markerStyle);
                }
            });

            var sitesCoordinates = [];
            function onEachFeature(feature, layer) {
                console.log(feature);
                sitesCoordinates.push(feature.geometry.coordinates);
                layer.bindTooltip(layer.feature.properties.deployment_name);
                layer.on('click', function (e) {
                    $('span.deployment-name').html(layer.feature.properties.deployment_name);
                    $('.marker-lat').html(layer.feature.properties.acf_lat);
                    $('.marker-long').html(layer.feature.properties.acf_long);
                    $('li.county span').html(layer.feature.properties.county);
                    $('li.lat span').html(layer.feature.properties.lat);
                    $('li.long span').html(layer.feature.properties.long);

//                    $('li.sd-id span').html(layer.feature.properties.id);
                    $('a.infowin-zoombtn').attr('href','');
                    $('#site-info-dialog').dialog("open");
                });
            }

            var features;
            function createMap(data) {
                siteLayer.addData(data);
                features = data.features;
                map.addLayer(siteLayer);
                var coord = data.features[0].geometry.coordinates;
                lalo = L.GeoJSON.coordsToLatLng(coord);
                map.setView(lalo, 10);
                openInfoWindow(data);
            };
            function openInfoWindow(data)
            {
                $('span.deployment-name').html(data.features[0].properties.deployment_name);
                $('.marker-lat').html(data.features[0].properties.acf_lat);
                $('.marker-long').html(data.features[0].properties.acf_long);
                $('li.county span').html(data.features[0].properties.county);
                $('li.lat span').html(data.features[0].properties.lat);
                $('li.long span').html(data.features[0].properties.long);
                var siteurl = "https://candid.naturalsciences.org/admin/site-descriptions/" + data.features[0].properties.id + "/show";
                $('.admin-link').attr("href",siteurl);
                $('a.infowin-zoombtn').attr('href','');
                $('#site-info-dialog').dialog("open");
            }
            var siteid = $("#map-site-id").val();

            var url = '{{ url("api/v1/geojson/site-description") }}' + "/" + siteid;
            console.log(url);
            function getMapData() {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: url,
                    success: function (data) {
                        console.log(data);
                        $("#map-spinner").hide();
                        $("#map-loading-overlay").hide();
                        createMap(data);
                    },
                    error: function (data) {
                        alert('An Error was Encountered retrieving map data.')
                    }
                })
            };
            getMapData();

            var imageryLayerGroup = L.layerGroup([baseLayer8, baseLayer9]);
            var baseMaps = {
                "Satellite Imagery": imageryLayerGroup,
                "ESRI Streets": baseLayer6,
                "ESRI National Geographic": baseLayer7,
                "Historic Topographic": baseLayer3
            };
            var overlayMaps = {
                "My Deployment Site": siteLayer,
                "Public Federal land Boundaries": fedBoundariesLayer,
                "NC State Trails": ncTrailsLayer,
                "Federal Trails": fedTrailsLayer,
            };
            var layersControl = L.control.layers(baseMaps, overlayMaps);
            imageryLayerGroup.addTo(map);
            map.addControl(layersControl);
            map.addControl(mapZoom);
            map.addControl(fullscreen);
            map.addControl(mapScale);
            map.addControl(measureControl);

        });
    </script>
@endpush
