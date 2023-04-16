<?php require('vendor/autoload.php');

use proj4php\Proj4php;
use proj4php\Proj;
use proj4php\Point;

// Initialise Proj4
$proj4 = new Proj4php();

// Create two different projections.
$projL93    = new Proj('EPSG:3042', $proj4);
$projWGS84  = new Proj('EPSG:4326', $proj4);

// Create a point.
$pointSrc = new Point(524506, 4761091, $projL93);
echo "Source: " . $pointSrc->toShortString() . " in EPSG:3042 - ETRS89-UTM zone 30N (N-E) <br>";

// Transform the point between datums.
$pointDest = $proj4->transform($projWGS84, $pointSrc);
echo "Conversion: " . $pointDest->toShortString() . " in WGS84<br><br>";

?>;


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
      integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
      crossorigin=""
    />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script
      src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
      integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
      crossorigin=""
    ></script>

    <script src="https://cdn.jsdelivr.net/gh/maneoverland/leaflet.WorldMiniMap@1.0.0/dist/Control.WorldMiniMap.js" integrity="sha512-PFw8St3qenU1/dmwCfiYYN/bRcqY1p3+sBATR+rZ6622eyXOk/8izVtlmm/k8qW7KbRIJsku838WCV5LMs6FCg==" crossorigin=""></script>
    <link rel="stylesheet" href="style.css" />
    <script src="proj4-compressed.js"></script>
    <script src="proj4leaflet.js"></script>
  </head>
  <body>
    <div id="map"></div>
    <script>

        
      var map = L.map("map", {worldMiniMapControl: true}).setView([51.505, -0.09], 13);
      L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution:
          '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
      }).addTo(map);

      var marker = L.marker([51.5, -0.09]).addTo(map);
      marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

      var popup = L.popup()
        .setLatLng([43.00209233, -2.69933359])
        .setContent("Camino tradicional al Norte de Garrastadi.")
        .openOn(map);

        var worldMiniMap = L.control.worldMiniMap({position: 'topright', style: {opacity: 0.9, borderRadius: '0px', backgroundColor: 'lightblue'}}).addTo(map);
    </script>
  </body>
</html>
