

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">

    <title>Geocoding API</title>

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

        .text{
            color: navy;
            font-size: 20px;
        }

        .textResult{
            color: brown;
            font-size: 24px;
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div id="map"></div>
<input type="text" placeholder="Address" id="address">
<button onclick="geocodeAddress();">Geocode Address</button>
<div id="result"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdnNeOWoBAt9YoJ3DnJFtRsSX7bQ9LuPE"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // create position where we use inside mapOptions
    // This location for Wakefield
    var wakefieldPosition = {lat:53.68331, lng:-1.49768};

    // create map options, we use this in map object creation
    var mapOptions = {
        center: wakefieldPosition,
        zoom: 6,
        mapTypeId: 'roadmap'
    };

    // create map object using JavaScript library from google Api
    var map = new google.maps.Map(document.getElementById('map'),mapOptions);

    // define marker variable
    var marker;

    // geocode function
    function geocodeAddress() {
        var key = "AIzaSyCdnNeOWoBAt9YoJ3DnJFtRsSX7bQ9LuPE";
        var url = "https://maps.googleapis.com/maps/api/geocode/json?address="
            + document.getElementById('address').value + ",&key=" + key;

        $.getJSON(url,function (data) {
            if(data.status == "OK"){
                var formattedAddress = data.results[0].formatted_address;
                var latitude = data.results[0].geometry.location.lat;
                var longitude = data.results[0].geometry.location.lng;

                var postcode;

                // go to each address_compnents from json file and look for type
                // postal_code, because all these elements has option long_name, we need find
                // the right one
                $.each(data.results[0].address_components, function (index, element) {
                    if(element.types == "postal_code" ){
                        postcode = element.long_name;
                        return false; // to stop the loop
                    }
                });

                $("#result").html("<p class='text'><strong>Formatted Address : </strong>" +
                    "<span class='textResult'>" + formattedAddress + "</span></p><br />" +
                    "<p class='text'><strong>Coordinates : </strong><span class='textResult'>" +
                    " (lat: " + latitude + ", lng: " + longitude + ")</span></p><br />" +
                    "<p class='text'><strong>Postcode : </strong><span class='textResult'>" + postcode +
                    ".</span></p>");

                // center our location
                map.setCenter(data.results[0].geometry.location);

                // change zoom level
                map.setZoom(17);

                // check if marker is there delete it
                if(marker != undefined){
                    marker.setMap(null);
                }

                // create marker
                marker = new google.maps.Marker({
                    map: map,
                    position : data.results[0].geometry.location,
                    animation: google.maps.Animation.DROP
                });
            }else{
                $("#result").html("<p style='color: #ff0000;font-size: 20px'>Request Unsuccessful!</p>");
            }
        });
    }
</script>
</body>
</html>

