@extends('layouts.frontend.master')
@section('title', 'Libraries')
@section('content')
    <div id="library-map-container">
        <input type="hidden" name="lat" id="lat"/>
        <input type="hidden" name="lng" id="lng"/>

        <div id="map">
            <div id="map-top-bar" class="map-top-bar container-fluid">
                <div class="map-title text-left">Find Nearest Library</div>
                <div class="top-bar-btn">
                    <button type="button" class="btn btn-sm btn-map" id="findNearest">Find Nearest</button>
                    <button type="button" class="btn btn-sm btn-danger" id="resetMap">Reset</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('inc-styles')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/leaflet/leaflet-measure.css') }}">
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/leaflet/routing-machine/leaflet-routing-machine.css') }}">
@endpush
@push('inc-scripts')
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/esri-leaflet@2.1.4/dist/esri-leaflet.js"></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.js"></script>
    <script type="text/javascript" src="{{ asset('js/leaflet/routing-machine/leaflet-routing-machine.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/leaflet/Leaflet.Control.Custom.js') }}"></script>
    <script src="{{ asset('js/leaflet/leaflet-measure.js') }}"></script>
    <script type="text/javascript" src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>
    <script type="text/javascript" src="{{ asset('js/vendor/jquery.dialogOptions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('data/county-boundaries.js') }}"></script>
@endpush
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        });
    </script>
    <script type="text/javascript">

        /** Leaflet **/
            var librariesLayer;
            var countyLayer;

            var baseLayer1 = L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Tiles courtesy of <a href="http://hot.openstreetmap.org/" target="_blank">Humanitarian OpenStreetMap Team</a>'
            });
            var baseLayer2 = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/Specialty/DeLorme_World_Base_Map/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Copyright: &copy;2012 DeLorme',
                minZoom: 1,
                maxZoom: 11
            });
            var baseLayer3 = L.esri.tiledMapLayer({
                url: "http://services.arcgisonline.com/ArcGIS/rest/services/USA_Topo_Maps/MapServer",
                maxZoom: 12,
            });
            var baseLayer4 = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Esri, DigitalGlobe, GeoEye, i-cubed, USDA, USGS, AEX, Getmapping, Aerogrid, IGN, IGP, swisstopo, GIS User Community'
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
            //baseLayer6.addTo(map);

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

            var searchControl = L.esri.Geocoding.geosearch({
                expanded: true,
                collapseAfterResult: false,
                zoomToResult: false,
                position: 'topleft',
                allowMultipleResults: false
            });

        // Libraries
            var libraryIcon = L.icon({
                iconUrl: '{{ asset('images/book-a-blue.png') }}',
                iconSize: [32, 37],
                shadowSize: [42, 30],
                shadowAnchor: [10, 30],
                iconAnchor: [13, 29],
                popupAnchor: [0, -30]
            });
            var nearestIcon = L.icon({
                iconUrl: '{{ asset('images/book_A_1e8a00.png') }}',
                iconSize: [32, 37],
                shadowSize: [42, 30],
                shadowAnchor: [10, 30],
                iconAnchor: [13, 29],
                popupAnchor: [0, -30]
            });
            var geocodeIcon = L.icon({
                iconUrl: '{{ asset('images/house-A-1e8a00.png') }}',
                iconSize: [32, 37],
                shadowSize: [42, 30],
                shadowAnchor: [10, 30],
                iconAnchor: [13, 29],
                popupAnchor: [0, -30]
            });

            librariesLayer = L.geoJson(null, {
                onEachFeature: onEachFeature_Libraries,
                pointToLayer: function (feature, latlng) {
                    return L.marker(latlng, {icon: libraryIcon});
                }
            });
            var sitesCoordinates = [];
            function onEachFeature_Libraries(feature, layer) {
                layer.bindPopup('<div class="leaflet-popup-window">' + '<div class="popup-title">' + feature.properties.library_name + '</div>' +
                    '<div class="address">' + feature.properties.street_address + '<br>' +
                    feature.properties.city + ' NC, ' + feature.properties.zip + '<div>' +
                    '<a href="https://www.google.com/maps/place/' + feature.properties.street_address + '+' + feature.properties.city + '+NC+' + feature.properties.zip + '" ' +
                    'class="btn btn-xs btn-popup" target="_blank">Open in Google Maps</a>' +
                    '</div>')
                sitesCoordinates.push(feature.geometry.coordinates);
                layer.on('click', function (e) {
                    map.setView(e.latlng, 9);
                    layer.openPopup();
                });
            }

            var features;
            function createMap(data) {
                librariesLayer.addData(data);
                features = data.features;
                map.addLayer(librariesLayer);
                var libraryBounds = librariesLayer.getBounds();
                map.fitBounds(libraryBounds, {padding: [0, 0]});
            };

            var url = '{{ url("api/v1/geojson/libraries") }}';
            function getMapData() {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: url,
                    success: function (data) {
                        createMap(data);
                    },
                    error: function (data) {
                        alert('An Error was Encountered.')
                    }
                })
            };
            getMapData();

            var route;
            function getRoute(lng1, lat1, lng2, lat2) {
                route = L.Routing.control({
                    waypoints: [
                        L.latLng(lat1, lng1),
                        L.latLng(lat2, lng2)
                    ]
                });
                console.log(route);
                route.addTo(map);
                var line = L.Routing.line(route);
            }

            var geocodeMarker;
            var boundFeatureGroup = L.featureGroup().addTo(map);
            var geocodeLayerGroup = L.layerGroup().addTo(map);
            var geocodePoint;
            var geocodelatlng;
            var geocodeLng;
            var geocodeLat;
            var nearestLat;
            var nearestLng;

            searchControl.on('results', function(data){
                geocodeLayerGroup.clearLayers();
                $("#findNearest").show();
                if (data.results.length > 0) {
                    geocodePoint = data.results[0].latlng;
                    geocodeMarker = L.marker(geocodePoint, {icon: geocodeIcon}).bindPopup(data.results[0].text).addTo(map);
                    geocodeMarker.on('click', function () {
                        this.openPopup();
                    });
                    geocodeLayerGroup.addLayer(geocodeMarker);
                    boundFeatureGroup.addLayer(geocodeMarker);
                    map.setView(geocodePoint, 9);
                    geocodelatlng = data.results[0].latlng;
                }
            });


        // Nearest Library
             function onEachFeature_Nearest(feature, layer) {
                layer.bindPopup('<div class="leaflet-popup-window">' + '<div class="popup-name">Nearest Library</div>' +
                    '<div class="popup-title">' + feature.properties.library_name + '</div>' +
                    '<div class="address">' + feature.properties.street_address + '<br>' +
                    feature.properties.city + ' NC, ' + feature.properties.zip + '<div>' +
                    '<a href="https://www.google.com/maps/place/' + feature.properties.street_address + '+' + feature.properties.city + '+NC+' + feature.properties.zip + '" ' +
                    'class="btn btn-xs btn-popup" target="_blank">Open in Google Maps</a>' +
                    '</div>');
                layer.on('add', function () {
                    console.log("Layer Added");
                });
                layer.on('click', function (e) {n
                    map.setView(e.latlng, 9);
                    layer.openPopup();
                });
            }

            var nearestLayer = L.geoJSON(null, {
                pointToLayer: function (feature) {
                    return L.marker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], {icon: nearestIcon});
                },
                onEachFeature: onEachFeature_Nearest,
            });

            function findNearest(latlng) {
                map.removeLayer(nearestLayer);
                map.removeLayer(librariesLayer);

                var tfF = turf.featureCollection(features)
                var tfP = turf.point([latlng.lng, latlng.lat]);
                geocodeLng = latlng.lng;
                geocodeLat = latlng.lat;

                var nearestPoint = turf.nearestPoint(tfP, tfF);
                nearestLat = nearestPoint.geometry.coordinates[1];
                nearestLng = nearestPoint.geometry.coordinates[0];

                nearestLayer.addData(nearestPoint);
                map.addLayer(nearestLayer);
                boundFeatureGroup.addLayer(nearestLayer);
                nearestLayer.on('add', function(event) {
                    event.target.openPopup();
                });
                var featureBounds = boundFeatureGroup.getBounds();
                map.fitBounds(featureBounds, {padding: [125,125]});
                getRoute(geocodeLng, geocodeLat, nearestLng, nearestLat)

                var nearestLatLng = new L.LatLng(nearestLat, nearestLng);
                map.setView(nearestLatLng);
            }
            $("button#findNearest").click(function() {
                if(geocodelatlng) {
                    findNearest(geocodelatlng);
                }
                else {
                    alert("You must enter an address first.")
                }

            });



            $("button#resetMap").click(function() {
                geocodeLayerGroup.clearLayers();
                boundFeatureGroup.clearLayers();
                map.removeControl(route);
                map.removeLayer(nearestLayer);
                map.removeLayer(geocodeMarker);
                map.removeLayer(boundFeatureGroup);
                map.removeLayer(geocodeLayerGroup);
                geocodePoint = '';
                getMapData();
                //map.addLayer(librariesLayer);
                //var bounds = librariesLayer.getBounds();
                //map.fitBounds(bounds);
            });
            var imageryLayerGroup = L.layerGroup([baseLayer8, baseLayer9]);


            var baseMaps = {
                "Satellite Imagery": imageryLayerGroup,
                "ESRI Streets": baseLayer6,
                "ESRI National Geographic": baseLayer7,
                "Historic Topographic": baseLayer3
            };
            var overlayMaps = {
                "Libraries": librariesLayer,
                "Geocode Results": geocodeLayerGroup,
                "Nearest Library": nearestLayer
            };
            var layersControl = L.control.layers(baseMaps, overlayMaps);
            imageryLayerGroup.addTo(map);
            map.addControl(layersControl);
            map.addControl(mapZoom);
            map.addControl(fullscreen);
            map.addControl(mapScale);
            map.addControl(searchControl);

        </script>



    <script type="text/javascript">
        /** jQuery ***/
        $(document).ready(function(){


        });
    </script>
@endpush
