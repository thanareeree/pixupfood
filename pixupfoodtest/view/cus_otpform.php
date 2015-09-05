<?php
session_start();
include '../dbconn.php';
include './navbar.php';

?>




<html >
    <head>
        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
        <meta  charset="utf-8" />
        <title>Customer OTP Form</title>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">

        <!-- animate css -->
        <link rel="stylesheet" href="../assets/css/animate.min.css">
        <!-- bootstrap css -->
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">


        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/register.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/search.css">
        <link rel="stylesheet" href="../assets/css/slide2.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/simple-sidebar.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    </head>
    <body>
        <?php show_navbar(); ?>
        <!-- start register -->
        <section id="cus_register">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                            <h1 class="text-uppercase">Vertify Account</h1>
                            <p style="font-size: 16px">
                                กรูณากรอกรหัส 4 หลักที่ท่านได้รับผ่านทาง sms เพื่อยืนยันตัวตน 
                            </p>
                            <hr>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 80px">
                        <div class="col-md-2"></div>
                        <div class="col-md-3 wow fadeInUp" data-wow-delay="0.6s">
                            <h3 class="text-uppercase">Your OTP Password :</h3>
                            <p> รหัส OTP 4 หลัก</p>
                        </div>
                        <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                            <div>
                                <form action="../register/customer-save.php" method="post" id="otpform">
                                    <div class="col-md-12 form-group">
                                        <input type="hidden" id="cusid" name="cusid" value="<?= $_SESSION["userdata"]["id"]?>">
                                        <input required type="text" class="form-control" placeholder="OTP password" id="otpinput" name="otpinput">
                                        <p style="color: red" id="errortext"></p>
                                    </div>
                                    <div class="col-md-4 pull-right">
                                        <input type="submit" class="form-control text-uppercase" value="Send">
                                    </div>
                                    <div class="col-md-4 pull-right">
                                        <a href="../api/logout.php"><input type="button" class="form-control text-uppercase btn-danger" id="cancelbtn" value="Cancel"></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end register -->
        <?php show_footer(); ?>
        <script>
            $(document).ready(function () {
                //Handles menu drop down
                $('.dropdown-menu').find('form').click(function (e) {
                    e.stopPropagation();
                });
                
                

                $("#otpform").on("submit", function (e) {
                    $.ajax({
                        type: "POST",
                        url: "../customer/checkotppassword.php",
                        data: $("#otpform").serializeArray(),
                        dataType: "json",
                        success: function (data) {
                            if (data.result == "1") {
                                 document.location = "../view/cus_customer_profile.php?id="+data.id;
                            } else {
                                alert("ไม่สามารถบันทึกข้อมูลได้\nError : " + data.error);
                                $("#loader").fadeOut(300);
                            }
                        }
                    });
                    e.preventDefault();
                    return false;
                });
            });
        </script>

    </body>
</html>