@extends('layouts.frontend.master')
@section('title', 'Map Sites')
@section('content')
    <div id="map-container">
        <input type="hidden" name="lat" id="lat"/>
        <input type="hidden" name="lng" id="lng"/>
        <input type="hidden" name="sitename" id="sitename">

        <div id="map">        	
            <div id="map-spinner">
                <div class="loader-inner ball-scale-multiple"></div>
            </div>
            <div id="map-loading-overlay"></div>
            <div id="map-top-bar" class="map-top-bar container-fluid">
                <div class="map-title text-left">Site Selection</div>
                <div class="top-bar-btn">
                    <button type="button" class="btn btn-sm btn-danger" id="resetMap">Reset</button>
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#selectionHelpModal">Help</button>
                </div>
            </div>
        </div>
        <div id="progress"><div id="progress-bar"></div></div>
    </div>
    @include('modals.flash')
    @include('modals.site-selection-help')
    @include('modals.site-selection-intro')
    @include('modals.map-selection-dialog')
@endsection
@push('inc-styles')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/leaflet/markercluster/MarkerCluster.Default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/leaflet/markercluster/MarkerCluster.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.css">
@endpush
@push('inc-scripts')
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/esri-leaflet@2.1.4/dist/esri-leaflet.js"></script>
    <script type="text/javascript" src="{{ asset('js/leaflet/markercluster/1.4.1/leaflet.markercluster.js') }}"></script>
    <!--
     <script type="text/javascript" src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    -->
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.js"></script>
    <script type="text/javascript" src="{{ asset('js/leaflet/Leaflet.Control.Custom.js') }}"></script>
    <script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>
    <script type="text/javascript" src="{{ asset('js/vendor/jquery.dialogOptions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('data/county-boundaries.js') }}"></script>
    <script type="text/javascript" src="{{ asset('data/public_fed_land_boundaries.js') }}"></script>
    <script type="text/javascript" src="{{ asset('data/fedtrails.js') }}"></script>
    <script type="text/javascript" src="{{ asset('data/nctrails.js') }}"></script>
@endpush
@push('scripts')
    @if( Session::has('flash_message'))
        <script type="text/javascript">
            $('#flashModal').modal('show');
        </script>
    @endif
    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $("#map-footer").hide();
        $('.loader-inner').loaders();
        $(function(){
            $('#selectionIntroModal').on('show.bs.modal', function(){
                var theModal = $(this);
                clearTimeout(theModal.data('hideInterval'));
                //theModal.data('hideInterval', setTimeout(function(){
                //    theModal.modal('hide');
                //}, 8000));
            });
        });
        $(document).ready(function() {
            $('#selectionIntroModal').modal({
                show: true,
            })
            $('#flashModal').modal({
                show: false
            });
            $("#map-selection-dialog").dialog({
                    autoOpen: false,
                    draggable: true,
                    dialogClass: 'map-dialog-ui',
                    width: 768,
                    responsive: true,
                    position: {my: "left top", at: "left top", of: "#map"},
                    /*buttons: [
                        {
                            text: "Close",
                            click: function () {
                                $(this).dialog("close");
                            }
                        }
                    ],
                    */
                    show: {
                        effect: "fade",
                        duration: 500
                    },
                    open: function(event, ui) {
                        jQuery('.ui-dialog-titlebar-close').removeClass("ui-dialog-titlebar-close").html('<span class="close-dialog"><i class="fa far fa-window-close"></i></span>');
                    },
            });
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
//            baseLayer6.addTo(map);

            var mapScale = L.control.scale({
                maxWidth: 150,
                position: 'bottomleft'
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

	// Federal Boundaries Layer
            var boundariesStyle = { fillColor: '#FF7400', opacity: 1, fillOpacity: 0.4, weight: 1.5, color: '#FF7400' };
	// Trail Layer
            var trailStyle = { fillColor: '#FFE200', opacity: 0.8, fillOpacity: 0.2, weight: 2, color: "#FFE200" };
	// Highlight Style for Hovers
            var highlightStyle = { fillColor: '#FFE464', opacity: 1, fillOpacity: 0.4, weight: 1, color: '#FFE464' };
	// NC Counties Layer
            var countyStyle = { fillColor: '#08519c', opacity: 1, fillOpacity: 0.1, weight: 1.5, color: '#FFFFFF' };
            var highlightCountyStyle = { fillColor: '#08519c', opacity: 0.7, fillOpacity: 0.4, weight: 1, color: '#08519c' };


			var countyLayer;
            var fedBoundariesLayer;
            var ncTrailsLayer;
            var fedTrailsLayer;
			var trailsLayer;
            var sitesLayer;
            var sitesGeoJson;
            var clickedMarker;
/*
            var markers = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });
*/
            // North Carolina Counties

            countyLayer = L.geoJson(boundaries, {
            	style: countyStyle,
                onEachFeature: function (feature, layer) {
                    layer.setStyle(countyStyle);
                    var center = layer.getBounds().getCenter();
                    if (feature.properties && feature.properties.name) {
                        layer.bindPopup(feature.properties.name);
                    }
                    layer.on({
                        mouseover: highlightCounty,
                        mouseout: resetCounty,
                        click: clickCounty
                    });
                }
            });
            function clickCounty(e) {
            	if (map.getZoom() < 9) {
	                var layer = e.target;
	                layer.setStyle(highlightCountyStyle);
	                var bounds = layer.getBounds();
	                map.fitBounds(bounds);
	                layer.openPopup();
            	}
            }
            function highlightCounty(e) {
            	if (map.getZoom() < 9) {
	                var layer = e.target;
	                layer.setStyle(highlightCountyStyle);
	                if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
	                    layer.bringToFront();
	                }
	            }
            };
            function resetCounty(e) {
                var layer = e.target;
                layer.setStyle(countyStyle);
            };

            fedBoundariesLayer = L.geoJson(fedboundaries, {
                style: boundariesStyle,
                /*
                onEachFeature: function (feature, layer) {
//                    var center = layer.getBounds().getCenter();
/*                    if (feature.properties && feature.properties.MA_NAME) {
                        layer.bindPopup(feature.properties.MA_NAME);
                    }

                    layer.on("click", function(e) {
                        // Do Nothing
                    })

                    layer.on("mouseover", function (e) {
                        layer.setStyle(highlightStyle);
                    })
                    layer.on("mouseout", function (e) {
                        layer.setStyle(boundariesStyle);
                    })

                }
                */
            }).addTo(map);

            ncTrailsLayer = L.geoJson(nctrails, {
                style: trailStyle,
                /*
                onEachFeature: function (feature, layer) {
                    if (feature.properties && feature.properties.PK_ABBR) {
                        layer.bindPopup("NC Trail: " + feature.properties.PK_ABBR);
                    }
                    
                    layer.on("click", function(e) {
                        // Do Nothing
                    })

                    layer.on("mouseover", function (e) {
                        layer.setStyle(highlightStyle);
                    })
                    layer.on("mouseout", function (e) {
                        layer.setStyle(trailStyle);
                    })
                }
                */
            });
            fedTrailsLayer = L.geoJson(fedtrails, {
                style: trailStyle,
                /*
                onEachFeature: function (feature, layer) {
                    if (feature.properties && feature.properties.COUNTY) {
                        layer.bindPopup("Federal Trail");
                    }
                    layer.on("click", function(e) {
                        // Do Nothing
                    })
                    layer.on("mouseover", function (e) {
                        layer.setStyle(highlightStyle);
                    })
                    layer.on("mouseout", function (e) {
                        layer.setStyle(trailStyle);
                    })
                }
                */
            });
			var trailLayerGroup = new L.FeatureGroup();
			trailLayerGroup.addLayer(ncTrailsLayer);
			trailLayerGroup.addLayer(fedTrailsLayer);
			map.addLayer(trailLayerGroup);

            var markerStyle = {
                stroke: true,
                color: '#9B0000',// '#643975',
                opacity: 1,
                weight: 2,
                fill: true,
                fillColor: '#9B0000', //'#9E5CB8',
                fillOpacity: 1,
                radius: 8
            };
            var highlightSiteStyle = {
                stroke: false,
                color: '#FF0000',
                opacity: 1,
                weight: 2,
                fill: true,
                fillColor: '#FF0000',
                fillOpacity: 0.9
            };
            var geocodeIcon = L.icon({
                iconUrl: '{{ asset('images/house-A-1e8a00.png') }}',
                iconSize: [32, 37],
                shadowSize: [42, 30],
                shadowAnchor: [10, 30],
                iconAnchor: [13, 29],
                popupAnchor: [0, -30]
            });

            /* Get Lat/Lon on Click*/
            var latlngMarker = L.marker();
            var updateMarker = function(lat, lng) {
                var latr = lat.toFixed(4);
                var lngr = lng.toFixed(4);
                latlngMarker
                    .setLatLng([lat, lng]);
                return false;
            };
            map.on('click', function(e) {
                $('#latInput').empty();
                $('#lngInput').empty();
                var latRound = e.latlng.lat.toFixed(4);
                var longRound = e.latlng.lng.toFixed(4);
                $('#latInput').html(latRound);
                $('#lngInput').html(longRound);
                updateMarker(e.latlng.lat, e.latlng.lng);
            });

	
		
            sitesLayer = L.markerClusterGroup({
            	chunkedLoading: true,
                removeOutsideVisibleBounds: true,
                spiderfyOnMaxZoom: false,
                zoomToBoundsOnClick: true,
                showCoverageOnHover: false,
                //disableClusteringAtZoom: 15,
                disableClusteringAtZoom: 14,
                iconCreateFunction: function(cluster) {
                    var count = cluster.getChildCount(); // get the number of items in the cluster
                    var digits = (count+'').length; // figure out how many digits long the number is
                    return new L.divIcon({
                        html: count,
                        className:'cluster digits-'+digits,
                        iconSize: null
                    });
                },
				pointToLayer: function (geojson, latlng) {
                    var direction = (geojson.properties.direction) ? geojson.properties.direction.toLowerCase() : 'none';
                    return L.marker(latlng, {
                        icon: icons[direction]
                    });
                }
            });
            map.on('zoomend', function(e) {
                //sitesLayer.refreshClusters();
                console.log("ZOOMEND", e);
            });
            map.on("zoomstart", function (e) { console.log("ZOOMSTART", e); });

            function clickFeature(e) {
                if(clickedMarker) {
                    clickedMarker.setStyle(markerStyle);
                }
                var layer = e.target;
                layer.setStyle(highlightSiteStyle);
                clickedMarker = layer;
            }
            sitesGeoJson = L.geoJson(null, {
                onEachFeature: onEachFeature_Sites,
                pointToLayer: function (feature, latlng) {
                    return L.circleMarker(latlng, markerStyle);
                }
            });

            var sitesCoordinates = [];
            function onEachFeature_Sites(feature, layer) {
                sitesCoordinates.push(feature.geometry.coordinates);
                layer.bindTooltip(layer.feature.properties.site_name);
                if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                    layer.bringToFront();
                };
                layer.on('mouseover', function (e) {
                    map.openTooltip();
                    //highlightSite(e);
                });
                layer.on('mouseout', function (e) {
                    map.closeTooltip();
                    //resetHighlight(e);
                });
                layer.on('click', function (e) {
                    $('#selected-site-id').val();
                    console.log(layer.feature.properties);
                    clickFeature(e);
                    //highlightSite(e);
                    $('.marker-lat').html(layer.feature.properties.lat);
                    $('.marker-long').html(layer.feature.properties.lon);
                    $('#site-name-selection').attr("data-sitename",layer.feature.properties.site_name);
                    $('#site-name-selection').val(layer.feature.properties.site_name);
                    $('#btn-reserve-site').attr("data-siteid",layer.feature.properties.site_id);

                    $('a.infowin-claimsitebtn').attr('href','');
                    $('.infowin-content').html(layer.feature.properties.infowindow_content);
                    $('.infowin-lat').html(layer.feature.properties.lat);
                    $('.infowin-long').html(layer.feature.properties.lon);
                    $('a.infowin-zoombtn').attr('href','');
                    $('#map-selection-dialog').dialog('option', 'title', 'Site: ' + layer.feature.properties.site_name);
                    $('#map-selection-dialog').dialog("open");
                    $('#selected-site-id').val(layer.feature.properties.id);
                    console.log(layer.feature.properties.id);
                });
            }

            var features;
            var mapSites;
            function createMap(data) {
            	mapSites = data;
                sitesGeoJson.addData(data);
                features = data.features;
                sitesLayer.addLayer(sitesGeoJson);
                map.addLayer(sitesLayer);
                map.fitBounds(sitesLayer.getBounds());
            };

            var url = '{{ url("api/v1/geojson/sites/available") }}';
            function getMapData() {
                console.log("getMapData");
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

            var boundFeatureGroup = L.featureGroup().addTo(map);
            var geocodeLayerGroup = L.layerGroup().addTo(map);
            var geocodePoint;
            var geocodeMarker;

    // Find Address
            searchControl.on('results', function(data){
                geocodeLayerGroup.clearLayers();
                if (data.results.length > 0) {
                    geocodePoint = data.results[0].latlng;
                    geocodeMarker = L.marker(geocodePoint, {icon: geocodeIcon}).bindPopup(data.results[0].text).addTo(map);
                    geocodeMarker.on('click', function () {
                        this.openPopup();
                    });
                    geocodeLayerGroup.addLayer(geocodeMarker);
                    boundFeatureGroup.addLayer(geocodeMarker);
                    map.setView(geocodePoint, 9);
                }
            });
   // Reset
            $("button#resetMap").click(function() {
                resetMap();
            });
            function resetMap() {
                $('#sitename').val();
                sitesLayer.addTo(map);
                var bounds = sitesLayer.getBounds();
                map.fitBounds(bounds);
            }
	// Legend
            function getLegendColor(d) {
                switch(d) {
                    case 1: return "#9B0000";
                    case 2: return "#FF7400";
                    case 3: return "#FFE200";
                    case 4: return "#08519c";
                    default: return "#9B0000";
                }
            };
            var legend = L.control({position: 'bottomleft'});
            var houseIcon = '{{ asset('images/house-A-1e8a00.png') }}';
            legend.onAdd = function (map) {
                var legdiv = L.DomUtil.create('div', 'info legend'),
                    status = [1, 2, 3, 4],
                    labels = ['Available Deployment Sites', 'Public Land Boundaries', 'Federal & State Trails', 'NC County Boundaries'];
                // loop through our status intervals and generate a label with a coloured square for each interval
                for (var i = 0; i < status.length; i++) {
                    legdiv.innerHTML +=
                        '<span class="legend-row"><i style="background:' + getLegendColor(status[i]) + '"></i> ' +	(status[i] ? labels[i] + '</span><br>' : '+');
                }
                legdiv.innerHTML += '<span class="legend-row"><img src="' + houseIcon + '">Geocode Result</span>';
                return legdiv;
            };
            legend.addTo(map);

            var imageryLayerGroup = L.layerGroup([baseLayer8, baseLayer9]);
            var baseMaps = {
                "Satellite Imagery": imageryLayerGroup,
                "ESRI Streets": baseLayer6,
                "ESRI National Geographic": baseLayer7,
                "Historic Topographic": baseLayer3
            };
            var overlayMaps = {
                "Available Sites": sitesLayer,
                "Public Federal land Boundaries": fedBoundariesLayer,
                "Trails": trailLayerGroup,
                "NC Counties": countyLayer,
                "Geocode Results": geocodeLayerGroup,
            };
            var layersControl = L.control.layers(baseMaps, overlayMaps);
            imageryLayerGroup.addTo(map);
            map.addControl(layersControl);
            map.addControl(mapZoom);
            map.addControl(mapScale);
            map.addControl(searchControl);
        
    </script>
@endpush
