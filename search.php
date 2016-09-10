<html>
<head>
    <title>PHP Test</title>

    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/typeahead.js/dist/typeahead.bundle.js"></script>
    <link rel="stylesheet" type="text/css" href="bar.css">
    <link rel="stylesheet" type="text/css" href="base.css">
    <link rel="stylesheet" type="text/css" href="typeahead.css">
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
            <a role="button" class="_7 _51 _u1 _z1 button" <span class="caps">Εύρεση<span class="price"></span></span>
            <svg width="24" height="24" viewBox="0 0 24 24" class="_8">
                <path d="M6 6l12 12M18 6L6 18"></path>
            </svg>
            </a>
        </div>
    </form>


</div>


</body>




<script>


    $.ajax({
        type: 'GET',
        url: 'api.php',
        data: "",
        dataType: 'json',
        success: function (data) {


            newdata = [];
            data.forEach(function (i) {
                newdata.push(i[0])
            });



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
                            '<div class="empty-message tt-suggestion">',
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


</html>