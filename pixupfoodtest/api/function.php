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






