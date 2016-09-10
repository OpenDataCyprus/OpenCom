<!DOCTYPE html>
<?php use Handlebars\Handlebars;

$engine = new Handlebars;

echo $engine->render(
    'Planets:<br />{{#each planets}}<h6>{{this}}</h6>{{/each}}',
    array(
        'planets' => array(
            "Mercury",
            "Venus",
            "Earth",
            "Mars"
        )
    )
);
?>
<html lang="en" class="no-js">
<head><meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Test</title>

    <script src="bower_components/jquery/dist/jquery.js"></script><script src="bower_components/typeahead.js/dist/typeahead.bundle.js"></script><link rel="stylesheet" type="text/css" href="bar.css"><link rel="stylesheet" type="text/css" href="base.css"><link rel="stylesheet" type="text/css" href="typeahead.css"><link rel="stylesheet" type="text/css" href="list.css"><link rel="stylesheet" type="text/css" href="bower_components/jquery-labelauty/source/jquery-labelauty.css"><link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.css"><script src="AnimatedCheckboxes/js/svgcheckbx.js"></script><link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css"><script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>

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

<?php echo '<br>'; ?>

<p class="title">OpenΚούσπ</p>

<img id="logo" src="basket.jpg"/>


<div class="searcher">
    <form method="get" class="search wrapper">

        <div id="the-basics scrollable-dropdown-menu">
            <input type="text" autocapitalize="off" autocomplete="off" autocorrect="off" spellcheck="false"
                   class="searchInput _e2 textInput typeahead" id="search" placeholder="Παρακαλώ εισαγάγετε προϊόν...">
        </div>
        <div class="rddight">
            <a role="button" class="_7 _51 _u1 _z1 button" <span class="caps"><i class="fa fa-shopping-basket" aria-hidden="true"></i><span class="price"></span></span>
            <svg width="24" height="24" viewBox="0 0 24 24" class="_8">
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
<!--            <li><input id="cb10" name="cb10" type="checkbox"><label for="cb10">ΧΑΡΑΛΑΜΠΙΔΗΣ - ΚΡΙΣΤΗΣ Άπαχο,  1L Φιάλη</label> <span class="price">από <span class="number">&nbsp;&nbsp;&nbsp;1,3€&nbsp;&nbsp;&nbsp;</span></li>-->
<!--            <li><input id="cb11" name="cb11" type="checkbox"><label for="cb11">ΚΚΕΣΕΣ Αναρή ξερή 1kg</label><span class="price">από <span class="number">&nbsp;&nbsp;&nbsp;1,3€&nbsp;&nbsp;&nbsp;</span></li>-->
<!--            <li><input id="cb12" name="cb12" type="checkbox"><label for="cb12">ΔΩΔΩΝΗ φέττα 200g </label><span class="price">από <span class="number">&nbsp;&nbsp;&nbsp;1,3€&nbsp;&nbsp;&nbsp;</span></li>-->
<!--            <li><input id="cb13" name="cb13" type="checkbox"><label for="cb13">Κοινό ψωμί μικρό 500g - 600g</label><span class="price">από <span class="number">&nbsp;&nbsp;&nbsp;1,3€&nbsp;&nbsp;&nbsp;</span> - <span class="number">&nbsp;&nbsp;&nbsp;2,5€&nbsp;&nbsp;&nbsp;</span></span></li>-->


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
            <tr>
                <td>ΧΑΡΑΛΑΜΠΙΔΗΣ - ΚΡΙΣΤΗΣ Άπαχο,  1L Φιάλη</td>
                <td><form><input type='number' size='10' id='numberinput' name='mynumber' value='0'/></form></td>

            </tr>
            <tr>
                <form>
                <td><input id="cardtextinput" type=text value="" placeholder="Αριθμός Υπεραγορών"></td>
                <td id="cardbuttons"><input type=submit value="Εμφάνιση Τιμών""><input type=submit value="Export""><input type=submit value="Import""></td>

                </form>

            </tr>

            </tbody>
        </table>
<input id="cardbutton"type='submit'>d</input>
</form>



<!--        <script>$(document).ready(function() {-->
<!--                $('#example').DataTable( {-->
<!--                    "scrollY":        "200px",-->
<!--                    "scrollCollapse": true,-->
<!--                    "paging":         false,-->
<!---->
<!--                } );-->
<!--            } );</script>-->

<script>
//    $.fn.capitalize = function () {
//        $.each(this, function () {
//            var split = this.value.split(' ');
//            for (var i = 0, len = split.length; i < len; i++) {
//                split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1);
//            }
//            this.value = split.join(' ');
//        });
//        return this;
//    };

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
//                $('ul#myul').append("<li><input style='display:none!important;' id='cb13' name='cb13' type='checkbox'><label for='cb13'>Κοινό ψωμί μικρό 500g - 600g</label><span class='price'>από <span class='number'>&nbsp;&nbsp;&nbsp;1,3€&nbsp;&nbsp;&nbsp;</span> - <span class='number'>&nbsp;&nbsp;&nbsp;2,5€&nbsp;&nbsp;&nbsp;</span></span></li>")
//            });


            var engine = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,

                local: newdata
            });


            $('.typeahead').typeahead({
                    hint: false,
                    highlight: true,
                    minLength: 1
                },
                {
                    name: "newdata",
                    source: engine,
                    templates: {
                        empty: [
                            'Δεν μπορω να βρω κατι...',
                            '</div>'
                        ].join('\n'),

                        suggestion: "<li><input style='display:none!important;' id='cb13' name='cb13' type='checkbox'><label for='cb13'>Κοινό ψωμί μικρό 500g - 600g</label><span class='price'>από <span class='number'>&nbsp;&nbsp;&nbsp;1,3€&nbsp;&nbsp;&nbsp;</span> - <span class='number'>&nbsp;&nbsp;&nbsp;2,5€&nbsp;&nbsp;&nbsp;</span></span></li>"

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