// JS for leaflet map

navigator.geolocation.getCurrentPosition(function(location) {
    var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

    var mymap = L.map('mapid').setView(latlng, 13)
 
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiYW5kcmUwYW5pIiwiYSI6ImNrZHk2N3poajB2bGQyc294ZzR2ejZnczkifQ.rYjlPcBXwZwMDBun11hP3Q'
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
