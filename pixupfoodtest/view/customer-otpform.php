<?php
include '../api/islogin.php';
include '../view/navbar.php';
include '../api/function.php';
include '../dbconn.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
        addlink();
        ?>
    </head>
    <body>
        <?php
        cusnavbar();
        ?>
        <div class="container">
            <div class="col-lg-6" style="margin: 150px" >
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="OTP Password">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="cofirmbtn">Confirm</button>
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->

    </div>
    <?php
    show_footer();
    ?>
    <script>
        $("cofirmbtn").on("click", function (e){
            document.location = "cus_customer_profile.php";
        });
    </script>
</body>
</html>
