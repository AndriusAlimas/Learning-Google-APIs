<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">

    <title>Markers & Info Windows</title>

    <style>
        html,body{
            height: 100%;
        }

        #map{
            height: 60%;
        }
    </style>
</head>

<body>
<div id="map"></div>
<?php
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdnNeOWoBAt9YoJ3DnJFtRsSX7bQ9LuPE"></script>
<script>
   // this is location for Wakefield
    var myLatLng = {lat:53.68331, lng:-1.49768};

    // this is location for Oxford
   var destination = { lat:51.752022,lng:-1.257677}

    // define map option, we will use this option when constructing a map object
    var mapOptions = {
        center: myLatLng,
        zoom: 6,
        mapTypeId: google.maps.MapTypeId.SATELLITE
    };

    // create map object using javascript google api
    var map = new google.maps.Map(document.getElementById('map'),mapOptions);

    // setting the mapTypeId upon construction
    map.setMapTypeId(google.maps.MapTypeId.TERRAIN);

    // create marker 1 option, we will use in Marker constructor
    var optionMarker1 =
        {
            position: myLatLng,
            map:map,
            title:"This is my Home Wakefield",
            draggable: true,
            animation: google.maps.Animation.DROP
        }

    // create marker 2 option, we will use in second Marker constructor
    var optionMarker2 = {
        position: destination,
        title:"This where i want to live Oxford",
        draggable: false,
    }

    // create marker 1
    var marker1 = new google.maps.Marker(optionMarker1);

    // create info Window
    var contentString = "<div>This is an infoWindow</div>";
    var infowindow = new google.maps.InfoWindow({
        content: contentString,
        maxWidth: 100
    });

    // add listener to the marker to show infoWindow
    marker1.addListener("click",function () {
        infowindow.open(map,marker1);
    });

    // create marker 2
    var marker2 = new google.maps.Marker(optionMarker2);

    // we can set animation or map manually or we change to new value using these methods
    marker2.setAnimation(google.maps.Animation.BOUNCE);
    marker2.setMap(map);

</script>
</body>
</html>