<!DOCTYPE html>
<html lang="en" class="no-js">
<head><meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <meta HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">

    <title>PHP Test</title>

    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/typeahead.js/dist/typeahead.bundle.js"></script>
    <link rel="stylesheet" type="text/css" href="bar.css"><link rel="stylesheet" type="text/css" href="base.css">
    <link rel="stylesheet" type="text/css" href="../../../../Users/xristosxristofidis/Desktop/datathon/img/bar2.css">
    <link rel="stylesheet" type="text/css" href="typeahead.css"><link rel="stylesheet" type="text/css" href="list.css">
    <link rel="stylesheet" type="text/css" href="bower_components/jquery-labelauty/source/jquery-labelauty.css">
    <link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.css">
    <script src="AnimatedCheckboxes/js/svgcheckbx.js"></script>
    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <script src="chart.bundle.js"></script>

<!--    <script src="bower_components/datatables.net/js/jquery.dataTables.js"></script>-->
<!--    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">-->


<!--    <link rel="stylesheet" type="text/css" href="AnimatedCheckboxes/css/normalize.css" />-->
    <link rel="stylesheet" type="text/css" href="AnimatedCheckboxes/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="AnimatedCheckboxes/css/component.css" />
    <script src="AnimatedCheckboxes/js/modernizr.custom.js"></script>
    <meta name="description" content="Animated Checkboxes and Radio Buttons with SVG: Using SVG for adding some fancy 'check' animations to form inputs" />
    <meta name="keywords" content="animated checkbox, svg, radio button, styled checkbox, css, pseudo element, form, animated svg" />
    <meta name="author" content="Codrops" />
    <!--
        <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
        <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
        -->
</head>
<body>
<div id="cart"></div>
<div id="cartinfo">
   <!-- ?php require 'getinfographics.php' ? -->
</div>

<div id="canvas_div">
    <canvas id="myChart" width="100" height="100"></canvas>
</div>
<script>
$(document).ready(function() {
    var cityid = 1;
    var userid = 1;
    $.ajax({
        type: 'GET',
        url: 'getcart.php',
        data: {userid: userid, city: cityid},
        dataType: 'html',
        success: function (data) {
            $("#cart").append(data);
            
            $(".prorow").each(function() {
                var currenttdcheapest = '';
                var counter = 1;
                $("td", this).each(function( j ) {
                    if(counter != 1) {
                        if(currenttdcheapest == '') {
                            currenttdcheapest = $(this);
                        } else {
                            var1 = parseFloat(currenttdcheapest.text());
                            var2 = parseFloat($(this).text());
                            if(var2 < var1) {
                                currenttdcheapest = $(this);
                            }
                        }
                    }
                    counter++;
                });
                currenttdcheapest.addClass('cheapest');
            });

            var counter = 1;
            $(".proth").each(function() {
                $(this).prepend('<span class="print">Print List <i class="fa fa-print" aria-hidden="true"></i></span>');
            });
        },
        error: function (err) {
            console.log(err);
        }
    });


    $(document).on('click', '.pname', function() {
        var productid = $(this).data('id');
        console.log(productid);
        $.ajax({
            type: 'GET',
            url: 'getinfographics.php?productid='+productid,
            data: "",
            dataType: 'html',
            success: function (data) {
                console.log(data);
                $("#cartinfo").html(data);
            },
            error: function (err) {
                console.log(err);
            }
        });
        $.ajax({
            type: 'GET',
            url: 'getcharts.php?productid='+productid,
            data: "",
            dataType: 'html',
            success: function (responsedata) {
                responsedata = responsedata.split("|");
                var ppoints = responsedata[0].split(".");
                var pdates = responsedata[1].split(",");
                var data = {
                    //labels: ["2014", "2015", "2016", "April", "May", "June", "July"],
                    labels: [pdates],
                    datasets: [
                        {
                            label: "Smart  Basket",
                            fill: false,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            //data: [65, 59, 80, 81, 56, 55, 40],
                            data: [ppoints],
                            spanGaps: false,
                        }
                    ]
                };


                var img = new Image();
                img.src = 'img/icon.svg';
                img.onload = function() {
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var fillPattern = ctx.createPattern(img, 'repeat');

                    var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: data
                    });
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
});
</script>


</body>
</html>