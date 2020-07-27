

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">

    <title>Nearby Search</title>

    <style>
        html,body{
            height: 100%;
        }

        #map{
            height: 60%;
        }
        #address{
            margin-top: 20px;
        }
    </style>
</head>

<body>
<div id="map" style="height: 800px; width: 900px"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdnNeOWoBAt9YoJ3DnJFtRsSX7bQ9LuPE&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // create position where we use inside mapOptions
    // This location for Wakefield
    var wakefieldPosition = {lat:53.68331, lng:-1.49768};

    // create map options, we use this in map object creation
    var mapOptions = {
        center: wakefieldPosition,
        zoom: 17,
        mapTypeId: 'satellite',
        tilt: 45
    };

    // create map object using JavaScript library from google Api
    var map = new google.maps.Map(document.getElementById('map'),mapOptions);

    // create infowindow
    var infowindow = new google.maps.InfoWindow();

    // define a request, the location must be defined using google.maps.LatLng
    var wakefield = new google.maps.LatLng(wakefieldPosition);

    var request = {
        location: wakefield,
        radius: '500',
        type: ['store']
    }

    // create a placesService object before using the nearbysearch method
    var service = new google.maps.places.PlacesService(map);
    service.nearbySearch(request, callback);

    // define the callback function showing what we do with the results
    function callback(result, status) {
        if(status == google.maps.places.PlacesServiceStatus.OK ){
                console.log(result);

                for(i = 0; i < result.length;i++){
                    addMarker(result[i]);
                }
        }
    }

    // add a marker for each place in the result array
    function addMarker(place) {
        var marker = new google.maps.Marker({
            map: map,
            position: place.geometry.location,
            animation: google.maps.Animation.DROP
        });

        google.maps.event.addListener(marker,"click",function () {
            infowindow.setContent(place.name);
            infowindow.open(map,this);
        });
    }
</script>
</body>
</html>