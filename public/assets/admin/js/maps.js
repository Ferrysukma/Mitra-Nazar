// variabel global marker
var marker;

function getLocation(id){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
                lat = position.coords.latitude;
                lng = position.coords.longitude;

                initialize(lat, lng, id);
            },
            positionError, {
                maximumAge: 60000,
                timeout: 5000,
                enableHighAccuracy: true
            });
    } else {
        alert("Geolocation API is not supported in your browser.");
    }
}

function positionError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            messageLocation = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            messageLocation = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            messageLocation = "The request to get user location timed out. <a href='javascript:void(0)' onclick='getLocation()'> Try again. </a>"
            break;
        case error.UNKNOWN_ERROR:
            messageLocation = "An unknown error occurred."
            break;
    }

    /*var errorCode = error.code;
    var message = error.message;
    */
    $('#nowLocation').html(messageLocation);
}

function taruhMarker(peta, posisiTitik){
    if( marker ){
        marker.setPosition(posisiTitik);
    } else {
        marker = new google.maps.Marker({
            position: posisiTitik,
            map: peta,
            animation: google.maps.Animation.BOUNCE
        });
    }

    // isi nilai koordinat ke form
    document.getElementById("lat").value = posisiTitik.lat();
    document.getElementById("lng").value = posisiTitik.lng();
}

// Google Maps
function initialize(lat, lang, id) {

    var propertiPeta = {
        center:new google.maps.LatLng(lat, lang),
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var peta = new google.maps.Map(document.getElementById(id), propertiPeta);
    // even listner ketika peta diklik
    google.maps.event.addListener(peta, 'click', function(event) {
        taruhMarker(this, event.latLng);
        // taruhMarker(lat, lang);
    });

    marker  = new google.maps.Marker({
        position: new google.maps.LatLng(lat,lang),
        map: peta,
        animation: google.maps.Animation.BOUNCE
    });
}

// event jendela di-load
google.maps.event.addDomListener(window, 'load', initialize);
