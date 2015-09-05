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
        <title>PixupFood - The Original Food Delivery</title>
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
                            <h1 class="text-uppercase">customer register form</h1><hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-3 wow fadeInUp" data-wow-delay="0.6s">
                            <h3 class="text-uppercase">E-mail :</h3>
                            <p> อีเมลล์</p>
                            <h3 class="text-uppercase">Password :</h3>
                            <p>รหัสผ่าน</p>
                            <h3 class="text-uppercase">Confirm Password :</h3>
                            <p>ยืนยันรหัสผ่าน </p>
                            <h3 class="text-uppercase">Name :</h3>
                            <p>ชื่อ - สกุล </p>
                            <h3 class="text-uppercase">Address :</h3>
                            <p>ที่อยู่ปัจจุบัน </p><br>
                            <h3 class="text-uppercase">Phone :</h3>
                            <p>โทรศัพท์ </p>
                        </div>
                        <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                            <div>
                                <form action="../register/customer-save.php" method="post">
                                    <div class="col-md-12 form-group">
                                        <input required type="email" class="form-control" placeholder="Email" id="cusemail" name="cusemail">
                                    </div>
                                    <div class="col-md-12">
                                        <input required type="password" class="form-control" placeholder="Password" id="cuspwd" name="cuspwd">
                                    </div>
                                    <div class="col-md-12">
                                        <input required type="password" class="form-control" placeholder="Confirm Password" id="cuspwdconfirm" name="cuspwdconfirm">
                                    </div>
                                    <div class="col-md-6">
                                        <input required type="text" class="form-control" placeholder="FirstName" id="cusfname" name="cusfname">
                                    </div>
                                    <div class="col-md-6">
                                        <input required type="text" class="form-control" placeholder="LastName" id="cuslname" name="cuslname">
                                    </div>
                                    <div class="col-md-12">
                                        <textarea required class="form-control" placeholder="Address" rows="3" id="cusaddress" name="cusaddress"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <input required type="tel" class="form-control" placeholder="Phone" id="cusphone" name="cusphone">
                                    </div><br>
                                    <div class="col-md-6 pull-right">
                                        <input type="submit" class="form-control text-uppercase" value="Registered">
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

        <!-- start footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <p>Copyright © 2015 PixupFood</p>
                    <p>School of Information Technology</p>
                    <p>King Mongkut’s University of Technology Thonburi</p>
                </div>
            </div>
        </footer>
        <!-- end footer -->
        <!-- script references -->
        <script src="../assets/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script>
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
        <script>
            $(document).ready(function () {
                //Handles menu drop down
                $('.dropdown-menu').find('form').click(function (e) {
                    e.stopPropagation();
                });
            });
        </script>
<!--<script src="../assets/js/jquery.js"></script>-->

        <script src="../assets/js/wow.min.js"></script>   
        <script src="../assets/js/jquery.singlePageNav.min.js"></script>
        <script src="../assets/js/custom.js"></script>
        <script src="../assets/js/jquery.al.js"></script>
    </body>
</html>