<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">

    <title>AutoComplete</title>

    <style>
        html,body{
            height: 100%;
        }

        #map{
            height: 60%;
        }
        #cityInput{
            margin-top: 20px;
        }
    </style>
</head>

<body>
<div id="map"></div>
<input id="cityInput" placeholder="City" type="text">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdnNeOWoBAt9YoJ3DnJFtRsSX7bQ9LuPE&libraries=places"></script>

<script>
    // create position where we use inside mapOptions
    // This location for Wakefield
    var wakefieldPosition = {lat:53.68331, lng:-1.49768};

    // create map options, we use this in map object creation
    var mapOptions = {
        center: wakefieldPosition,
        zoom: 8,
        mapTypeId: 'roadmap',
    };

    // create map object using JavaScript library from google Api
    var map = new google.maps.Map(document.getElementById('map'),mapOptions);

    // create autocomplete object
    var input = document.getElementById('cityInput');
    var options = {
        types: ['(cities)']
    }
    var autoComplete = new google.maps.places.Autocomplete(input,options);
    
    autoComplete.addListener('place_changed',onPlaceChanged);
    
    function onPlaceChanged() {
        var place = autoComplete.getPlace();
        map.panTo(place.geometry.location);
    }
</script>
</body>
</html>