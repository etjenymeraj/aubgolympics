var geocoder;
var map;
var markersArray = [];
var bounds;
var infowindow =  new google.maps.InfoWindow({
    content: ''
});

function initialize() {
    geocoder = new google.maps.Geocoder();
    bounds = new google.maps.LatLngBounds ();

    var mapOptions = {
        zoom: 2, 
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        navigationControlOptions: {
            style: google.maps.NavigationControlStyle.SMALL
        }
    };
    map = new google.maps.Map(document.getElementById("map2"), mapOptions);
    plotMarkers();
}

var locationsArray = [
    ['Baseball Field</br>Blagoevgrad, Bulgaria','42.027649, 23.117161'],
];

function plotMarkers(){
    var i;
    for(i = 0; i < locationsArray.length; i++){
        codeAddresses(locationsArray[i]);
    }
}

function codeAddresses(address){
    geocoder.geocode( { 'address': address[1]}, function(results, status) { 
        if (status == google.maps.GeocoderStatus.OK) {
            marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(address[0]);
                infowindow.open(map, this);
            });

            bounds.extend(results[0].geometry.location);

            markersArray.push(marker); 
        }
        else{
            alert("Geocode was not successful for the following reason: " + status);
        }

        map.fitBounds(bounds);
        map.setZoom(17);
    });
}

google.maps.event.addDomListener(window, 'load', initialize);
