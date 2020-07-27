

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">

    <title>Show Hide Delete Markers</title>

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
<button onclick="showMarkers();">Show Existing Markers</button>
<button onclick="hideMarkers();">Hide Markers From The Map</button>
<button onclick="removeMarkers();">Remove Markers Completely From The Map</button>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdnNeOWoBAt9YoJ3DnJFtRsSX7bQ9LuPE"></script>
<script>
    // create position where we use inside mapOptions
    // This location for Wakefield
    var wakefieldPosition = {lat:53.68331, lng:-1.49768};

    // this location for Leeds
    var leedsPosition = { lat: 53.801277, lng:-1.548567};

    // create map options, we use this in map object creation
    var mapOptions = {
        center: wakefieldPosition,
        zoom: 9,
        mapTypeId: 'hybrid'
    };

   // create map object using JavaScript library from google Api
   var map = new google.maps.Map(document.getElementById('map'),mapOptions);


   // create marker 1 option , we will use in Marker constructor
    var optionMarker1 = {
        position: wakefieldPosition,
        map: map,
        title: "This is my Home Wakefield",
        animation: google.maps.Animation.DROP
    }

    // this is option for marker 2
    var optionMarker2 = {
        position: leedsPosition,
        title: "This is Leeds"
    }

   // create marker 1
   var marker1 = new google.maps.Marker(optionMarker1);

    // create info Window
    var contentString = "<div>This is an infoWindow</div>";
    var infowindow = new google.maps.InfoWindow({
        content: contentString,
        maxWidth: 100
    });

    // add listener to the marker to show infoWindow, when event click is in action
    marker1.addListener('click',function() {
        infowindow.open(map,marker1);
    });

    // create marker 2
    var marker2 = new google.maps.Marker(optionMarker2);
    marker2.setAnimation(google.maps.Animation.BOUNCE);
    marker2.setMap(map);

    // remove markers
    marker1.setMap(null);
    marker2.setMap(null);

    // create an array where we store markers
    var markers = [];

    // create marker once we click on a point on the map
    // so we need to create on that object eventListener, we waiting for event to click,
    // and executing function
     map.addListener('click',function (event) {
            // for newly created marker options
            var options = {
                position: event.latLng, // event object has propertie that is current location
                // map:map
            }

            // then we create a new marker
            var marker = new google.maps.Marker(options);

            // store marker in array
            markers.push(marker);
     });

     // show markers stored in the array
   function showMarkers(){
       for(var i = 0; i < markers.length;i++){
           markers[i].setMap(map);
       }
   }
    // hide markers from the map (they are still in the array
    function hideMarkers() {
        for(var i = 0; i < markers.length;i++){
            markers[i].setMap(null);
        }
    }

    // completely remove markers from array
    function removeMarkers() {
       hideMarkers(); // first delete from the map
       markers = []; // and now you can set empty array
    }

</script>
</body>
</html>