// JS for leaflet map

navigator.geolocation.getCurrentPosition(function(location) {
    var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

    var mymap = L.map('mapid').setView(latlng, 13)
    L.tileLayer(
        'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery Â© <a href="https://mapbox.com">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1IjoiYW5kcmUwYW5pIiwiYSI6ImNqam5zZ2tjbDFmdHIzcXF2Mmp1ZmR2M2cifQ.Leo55txTsN0i05KAB2vRew'
        }).addTo(mymap);

    var popup = L.popup();

    // popup on clic
    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("Position : " + "<br>" + e.latlng.toString())
            .openOn(mymap);
    }
    mymap.on('click', onMapClick);

    var marker = L.marker(latlng);
    marker.bindPopup('Position actuelle').openPopup();
    marker.addTo(mymap);



});