

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">

    <title>Directions Service</title>

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
<button onclick="calcRoute();">Calculate Route</button>
<div id="result"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdnNeOWoBAt9YoJ3DnJFtRsSX7bQ9LuPE"></script>
<script>
    // create position where we use inside mapOptions
    // This location for Wakefield
    var wakefieldPosition = {lat:53.68331, lng:-1.49768};

    // create map options, we use this in map object creation
    var mapOptions = {
        center: wakefieldPosition,
        zoom: 12,
        mapTypeId: 'roadmap'
    };

    // create map object using JavaScript library from google Api
    var map = new google.maps.Map(document.getElementById('map'),mapOptions);

    // create DirectionsService object to use the route method and get result for our request
    var directionsService = new google.maps.DirectionsService();

    // create a DirectionsRenderer object which we will use to display the route
    var directionsDisplay = new google.maps.DirectionsRenderer();

    // bind the DirectionsRenderer to the map
    directionsDisplay.setMap(map);

    //Define calcRoute function
    function calcRoute() {
        var request = {
            origin: "Wakefield",
            destination: "Leeds",
            travelMode: google.maps.TravelMode.DRIVING, //Other modes: WALKING, BICYCLING, TRANSIT
            unitSystem: google.maps.UnitSystem.METRIC // by default is miles, but we want meters
        }

        // PASS the request to the route method
        directionsService.route(request, function (result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                console.log(result);
                // Get Distance and time:
                var distanceResult = "The Travelling distance is " + result.routes[0].legs[0].distance.text + ".</ br> " +
                    "The travelling time is: " + result.routes[0].legs[0].duration.text + ".";
                document.getElementById('result').outerHTML = distanceResult;

                // display route
                directionsDisplay.setDirections(result);
            }
        });
    } // end method calRoute()
</script>
</body>
</html>
