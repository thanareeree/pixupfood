<?php

function iconscript() {
    ?>
    <script>
        $(document).ready(function () {
            $("#navshoplist").click(function () {
                $("#shoplist").fadeIn(500);
                $("#favlist").hide();
                $("#history").hide();
                $("#shipadd").hide();
            })

            $("#navfavlist").click(function () {
                $("#shoplist").hide();
                $("#favlist").fadeIn(500);
                $("#history").hide();
                $("#shipadd").hide();
            })

            $("#navhistory").click(function () {
                $("#shoplist").hide();
                $("#favlist").hide();
                $("#history").fadeIn(500);
                $("#shipadd").hide();
            })

            $("#navshipadd").click(function () {
                $("#shoplist").hide();
                $("#favlist").hide();
                $("#history").hide();
                $("#shipadd").fadeIn(500);
            })
        });
    </script> 

<?php } ?>


<?php

function addlink($title) { ?>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/search.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/simple-sidebar.css" />
    <link rel="stylesheet" href="../assets/Supermarket/stylesheet.css">

<?php } ?>

