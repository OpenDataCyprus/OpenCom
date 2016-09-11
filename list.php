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



    <!--    <script src="bower_components/datatables.net/js/jquery.dataTables.js"></script>-->
    <!--    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">-->


    <!--    <link rel="stylesheet" type="text/css" href="AnimatedCheckboxes/css/normalize.css" />-->
    <link rel="stylesheet" type="text/css" href="AnimatedCheckboxes/css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="AnimatedCheckboxes/css/component.css"/>
    <script src="AnimatedCheckboxes/js/modernizr.custom.js"></script>
    <meta name="description"
          content="Animated Checkboxes and Radio Buttons with SVG: Using SVG for adding some fancy 'check' animations to form inputs"/>
    <meta name="keywords"
          content="animated checkbox, svg, radio button, styled checkbox, css, pseudo element, form, animated svg"/>
    <meta name="author" content="Codrops"/>
    <script src="bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <!--
        <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
        <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
        -->

</head>
<body>

<?php echo '<br>'; ?>

<p class="title">OpenΚούσπ</p>

<img id="logo" src="basket.jpg"/>


<div class="searcher">{{name}}
    <form method="get" class="search wrapper">

        <div id="the-basics scrollable-dropdown-menu">
            <input id="searchinput" type="text" autocapitalize="off" autocomplete="off" autocorrect="off" spellcheck="false"
                   class="searchInput _e2 textInput typeahead" id="search" placeholder="Παρακαλώ εισαγάγετε προϊόν...">
        </div>
        <div class="rddight">
            <a role="button" class="_7 _51 _u1 _z1 button" id="1"><span class="caps"><i class="fa fa-shopping-basket"
                                                                                 aria-hidden="true"></i><span
                    class="price"></span></span>
            <a role="button" class="_7 _51 _u1 _z1 button fa fa-remove" id="two"> <svg id="what" width="24" height="24" viewBox="0 0 24 24" class="_8"></a>
                <path d="M6 6l12 12M18 6L6 18"></path>
            </svg>
            </a>
        </div>
    </form>


</div>

<!---->
<!--How do I type the Euro (€-->


<div class="container">
    <section>
        <form class="ac-custom ac-checkbox ac-checkmark" autocomplete="off">
            <!--        <h2>How can you appropriately empower dynamic leadership skills after business portals?</h2>-->
            <ul id="myul">


            </ul>
        </form>

    </section>
    <script src="AnimatedCheckboxes/js/svgcheckbx.js"></script>
    <div>

        <form>

            <table cellspacing="0" id="cardtable">
                <thead>
                <tr>
                    <th>ΟΝΟΜΑ ΠΡΟΙΟΝΤΟΣ
                    </th>
                    <th>ΠΟΣΟΤΗΤΑ</th>


                </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
<!--                <tr>-->
<!--                    <td>ΧΑΡΑΛΑΜΠΙΔΗΣ - ΚΡΙΣΤΗΣ Άπαχο, 1L Φιάλη</td>-->
<!--                    <td>-->
<!--                        <form><input type='number' size='10' id='numberinput' name='mynumber' value='0'/></form>-->
<!--                    </td>-->
<!---->
<!--                </tr>-->
                <tr id="lastrow">
                    <form >
                        <td><input id="cardtextinput" type=text value="" placeholder="Αριθμός Υπεραγορών"></td>
                        <td id="cardbuttons"><input type=submit value="Εμφάνιση Τιμών""><input type=submit
                                                                                               value="Export""><input
                                type=submit value="Import"">
                        </td>

                    </form>

                </tr>

                </tbody>
            </table>
            <input id="cardbutton" type='submit'>d</input>
        </form>




        <script>


            $( "#1").click(function() {




                var counter = Math.floor(Math.random()*1000);
                $(".tt-selectable").toArray().forEach(function(i){

                    var temp =  i.innerText.substring(i.innerText.indexOf('|')+2);

                    $('ul#myul').append("<li><input class='three' id='cb"+counter.toString() + "'" + "name='cb"+counter.toString() + "'" + "type='checkbox'><label for='cb" + counter.toString() + "'>" + temp + "</label> <span class='price'> <span class='number'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</span></li>");

                    var script = document.createElement( 'script' );
                    script.type = "text/javascript";
                    script.src = 'AnimatedCheckboxes/js/svgcheckbx.js';
                    $("html").append( script );

                    counter += 1;

                });


                $(".tt-suggestion.tt-selectable").toArray().forEach(function(i){
                    i.remove();
                });



                $("label").click(function(data) {
                    console.log(data);


                    $("<tr><td>" + $(this).text() +"</td><td><input type='number' size='10' id='numberinput' name='mynumber' value='1'></td></tr>").insertBefore("#lastrow");


                });





            });


            $("#two").click(function() {

                $('ul#myul').empty();
                $("#searchinput").val('');


                $(".tt-suggestion.tt-selectable").toArray().forEach(function(i){
                    i.remove();
                });

            });



            $("label").click(function(data) {
                console.log(data);


                $("<tr><td>ΧΑΡΑΛΑΜΠΙΔΗΣ - ΚΡΙΣΤΗΣ Άπαχο, 1L Φιάλη</td><td><input type='number' size='10' id='numberinput' name='mynumber' value='1'></td></tr>").insertBefore("#lastrow");


            });


            $.ajax({
                type: 'GET',
                url: 'api.php',
                data: "",
                dataType: 'json',
                success: function (data) {
                    // console.log(data);

                    newdata = data;
//            data.forEach(function (i) {
//               // newdata.push(i.toLowerCase());
//
//                $('ul#myul').append("")
//            });


                    var engine = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.whitespace,
                        queryTokenizer: Bloodhound.tokenizers.whitespace,

                        local: newdata
                    });


                    $('.typeahead').typeahead({
                            hint: false,
                            highlight: false,
                            minLength: 1
                        },
                        {
                            name: "newdata",
                            source: engine,
                            templates: {
                                empty: [
                                    'Δεν μπορω να βρω κατι...',
                                    '</div>'
                                ].join('\n')

                            }
                        }
                    );


                },
                error: function (err) {


                    console.log(err);


                }


            });


        </script>


        <footer style="margin-left: auto; margin-right:auto;text-align: center"></footer>
</body>
</html>