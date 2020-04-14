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
    zoom: 2,
    zoomControl: false
});

baseLayer1.addTo(map);

var baseMaps = {
    "World Imagery": baseLayer1,
    "OpenStreet": baseLayer2,
};
L.control.layers(baseMaps).addTo(map);

var url = '{{ url("api/v1/geojson/map/deployments") }}';
console.log(url);


function getMapData() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: url,
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            alert('An Error was Encountered.')
        }
    })
}
getMapData();