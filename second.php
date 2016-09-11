<!DOCTYPE html>


<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Test</title>

    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/typeahead.js/dist/typeahead.bundle.js"></script>
    <link rel="stylesheet" type="text/css" href="bar.css">
    <link rel="stylesheet" type="text/css" href="base.css">
    <link rel="stylesheet" type="text/css" href="typeahead.css">
    <link rel="stylesheet" type="text/css" href="list.css">
    <link rel="stylesheet" type="text/css" href="bower_components/jquery-labelauty/source/jquery-labelauty.css">
    <link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.css">
    <script src="AnimatedCheckboxes/js/svgcheckbx.js"></script>
    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <script src="bower_components/chart.js"></script>
    <script>
        var myChart = new Chart({...})
    </script>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.23.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.23.0/mapbox-gl.css' rel='stylesheet' />
    <style>
        body { margin:0; padding:0; }
        #map { position:absolute; top:0; bottom:0; width:100%; }
    </style>



    <!--    <script src="bower_components/datatables.net/js/jquery.dataTables.js"></script>-->
    <!--    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">-->


    <!--    <link rel="stylesheet" type="text/css" href="AnimatedCheckboxes/css/normalize.css" />-->
    <link rel="stylesheet" type="text/css" href="AnimatedCheckboxes/css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="AnimatedCheckboxes/css/component.css"/>
    <script src="AnimatedCheckboxes/js/modernizr.custom.js"></script>
    <meta name="description"
          content="Animated Checkboxes and Radio Buttons with SVGnpm install chart.js --save: Using SVG for adding some fancy 'check' animations to form inputs"/>
    <meta name="keywords"
          content="animated checkbox, svg, radio button, styled checkbox, css, pseudo element, form, animated svg"/>
    <meta name="author" content="Codrops"/>
    <script src="bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <!--
        <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
        <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>

        -->
    <link rel="stylesheet" type="text/css" href="second.css">

</head>
<body>



<div id='map'></div>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiY2hhbm5lbDQwNDAiLCJhIjoiY2lzeWZoMmJtMDAzdjJ0cGR3NmxjZ3R3eiJ9._S6zKSXbpIL0-GyFyrDJVA';
    var map = new mapboxgl.Map({
        container: 'map', // container id
        style: 'mapbox://styles/mapbox/streets-v9', //stylesheet location
        center: [-74.50, 40], // starting position
        zoom: 9 // starting zoom
    });
</script>

<?php echo '<br>'; ?>

</body>
</html>