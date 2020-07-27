

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">

    <title>Geocoding Using Google Maps JavaScript API</title>

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
<div id="map"></div>
<input type="text" placeholder="Address" id="address">
<button onclick="geocodeAddress();">Geocode Address</button>
<div><p id="result"></p></div>
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

    // create geocoder object to use the geocode method
    var geocoder = new google.maps.Geocoder();

    // FUNCTIONS
    function geocodeAddress(){
        var request = {
            address : document.getElementById("address").value
        }
        geocoder.geocode(request,function (results,status) {
                if(status == google.maps.GeocoderStatus.OK){
                    console.log(results);

                    var myResult = "Address coordinates: " + results[0].geometry.location;
                    document.getElementById("result").textContent = myResult;

                    map.setCenter(results[0].geometry.location);

                    var marker = new google.maps.Marker({
                        map:map,
                        position: results[0].geometry.location
                    });
                }else{
                    window.alert("Geocode not successful: " + status);
                }
        });
    }
</script>
</body>
</html>
