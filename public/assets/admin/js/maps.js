// variabel global marker
var marker;

function taruhMarker(peta, posisiTitik){
    if( marker ){
    // pindahkan marker
    marker.setPosition(posisiTitik);
    } else {
    // buat marker baru
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

// event jendela di-load
google.maps.event.addDomListener(window, 'load', initialize);
