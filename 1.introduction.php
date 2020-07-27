<!DOCTYPE html>
<html>
    <head>
       <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="UTF-8">

       <title>Introduction to Google Maps Javascript API</title>

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
        // define map option, we will use this option when constructing a map object
        var myLatLng = {lat:53.68, lng:-1.49};

        var mapOptions = {
            center: myLatLng,
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.SATELLITE
        };

        // create map object using javascript google api
        var map = new google.maps.Map(document.getElementById('map'),mapOptions);

        // setting the mapTypeId upon construction
        map.setMapTypeId(google.maps.MapTypeId.TERRAIN);
    </script>
    </body>
</html>


