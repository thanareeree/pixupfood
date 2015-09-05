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

        <!-- Script fade after next -->
        <script>
            $(document).ready(function () {
                $("#backstep").click(function () {
                    $("#firststep").fadeIn(5000);
                    $("#secondstep").hide();
                })

                $("#nextstep").click(function () {
                    $("#firststep").hide();
                    $("#secondstep").fadeIn(5000);
                })
            })
        </script> 
    </head>
    <body>
        <!-- start preloader -->
        <div class="preloader">
            <div class="loader"></div>
        </div>
        <!-- end preloader -->
        <!-- start navigation -->
        <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
            <div class="navbar-header" style="padding-left:10px;">
                <a href="#menu-toggle" id="menu-toggle" >
                    <img src="../assets/images/bar/menu.png" width="50" height="50" style="margin-top:8px;"/>
                </a>
            </div>
            <div id="wrapper" class="toggled menubox">
                <div id="sidebar-wrapper">
                    <ul style="padding-left:0;font-weight:bold;">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#feature">Features</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#download">Download</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="container" style="margin:0 40px 0 100px;height:70px;width:auto;">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                    </button>
                    <a href="index.php" style="color:rgba(255,127,0,1)" class="navbar-brand">Pixup</a>
                    <a href="index.php" class="navbar-brand" style="color:black;padding-left: 0px;">Food</a>
                    <div class="col-md-4" style="margin:7px 0 0 15%;">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control input-lg" placeholder="Search.." />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="button">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <ul class="nav navbar-nav navbar-right text-uppercase">
                        <li><a href="#contact"><?= (!isset($_SESSION["islogin"])) ? 'No Session' : $_SESSION["userdata"]["firstName"] ?></a></li>
                        <li class="dropdown">
                            <a href="login.php" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="../assets/images/bar/user.png" style="width:40px;height:40px;"/>
                            </a>
                            <ul class="dropdown-menu" style="padding: 0px">
                                <li>
                                    <div class="middlePage" style="width:550px; height:200px">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Already Account? >> Sign In or Sign Up here</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-5" >
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p class="text-uppercase" style="text-align: center;font-size: 20pt;">sign up here</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5" style="margin-left: 20px">
                                                                <a href="cus_register.php">
                                                                    <img src="../assets/images/bar/userl.png" style="width:60px; height:60px;margin-top: 10px;">
                                                                </a>
                                                                <a href="cus_register.php">
                                                                    <p style="font-weight:bold"> CUSTOMERS </p>
                                                                </a>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <a href="res_register.php">
                                                                    <img src="../assets/images/bar/restaurant.png" style="width:60px; height:60px;margin-top: 10px;">
                                                                </a>
                                                                <a href="res_register.php">
                                                                    <p style="font-weight:bold"> RESTAURANTS </p>
                                                                </a>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-7" style="border-left:1px solid #ccc;height:160px">
                                                        <form class="form-horizontal">
                                                            <fieldset>
                                                                <input id="textinput" name="textinput" type="text" placeholder="Enter User Name" class="form-control input-md">                                                                
                                                                <input id="textinput" name="textinput" type="text" placeholder="Enter Password" class="form-control input-md" style="margin: 10px 0 5px 0">
                                                                <div class="spacing"><input type="checkbox" name="checkboxes" id="checkboxes-0" value="1"><small> Remember me</small></div>
                                                                <div class="spacing spacing-height"><a href="#"><p style="font-size: 16px">Forgot Password?</p></a><br/></div>
                                                                <button id="signinbutton" name="siginbutton" class="btn btn-info btn-sm pull-right">Sign In</button>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end navigation -->
        <!-- start register -->
        <section id="res_register">
            <div class="overlay">
                <div class="container" style="padding-bottom: 10px;">
                    <div class="row">
                        <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                            <h1 class="text-uppercase">restaurant register form</h1><hr>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="container active tab-pane fade in" id="firststep">
                        <div class="row">
                            <div class="col-md-2 wow fadeInUp" data-wow-delay="0.6s">
                                <h2 class="text-uppercase">เจ้าของร้าน</h2>
                            </div>
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
                                <h3 class="text-uppercase">Zip Code :</h3>
                                <p>รหัสไปรษณีย์ </p>
                                <h3 class="text-uppercase">Province :</h3>
                                <p>จังหวัด </p>
                                <h3 class="text-uppercase">Phone :</h3>
                                <p>โทรศัพท์ </p>
                            </div>
                            <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                                <div>
                                    <form action="#" method="post">
                                        <div class="col-md-12">
                                            <input type="email" class="form-control" placeholder="Email" required id="roremail">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control" placeholder="Password" required id="rorpass">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control" placeholder="Confirm Password" required id="rorcpass">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="FirstName" required id="rorfname">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="LastName" required id="rorlname">
                                        </div>
                                        <div class="col-md-12">
                                            <textarea class="form-control" placeholder="Address" rows="3" required id="roradd"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="Zip Code" required id="rorzip">
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control prolist" id="sel1">
                                                <?php
                                                $res = $con->query("SELECT `id`, `name` FROM `province`");
                                                while ($data = $res->fetch_assoc()) {
                                                    ?>

                                                    <option value="<?= $data['id'] ?>"> <?= $data['name'] ?> </option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="tel" class="form-control" placeholder="Phone" required id="rorphone">
                                        </div><br>
                                        <div class="col-md-6 pull-right">
                                            <a href="#secondstep" data-toggle="tab" id="nextstep">
                                                <input type="submit" class="form-control text-uppercase" value="Next">
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>

                    <!-- second step -->
                    <div class="container tab-pane fade in" id="secondstep">
                        <div class="row">
                            <div class="col-md-2 wow fadeInUp" data-wow-delay="0.6s">
                                <h2 class="text-uppercase">ร้านอาหาร</h2>
                            </div>
                            <div class="col-md-3 wow fadeInUp" data-wow-delay="0.6s">
                                <h3 class="text-uppercase">Restaurant Name :</h3>
                                <p>ชื่อร้านอาหาร </p>
                                <h3 class="text-uppercase">Address :</h3>
                                <p>ที่อยู่ร้านอาหาร </p><br>
                                <h3 class="text-uppercase">Zip Code :</h3>
                                <p>รหัสไปรษณีย์ </p>
                                <h3 class="text-uppercase">Province :</h3>
                                <p>จังหวัด </p>
                                <h3 class="text-uppercase">Phone :</h3>
                                <p>โทรศัพท์ </p>
                                <h3 class="text-uppercase">Plan :</h3>
                                <p>แผนการใช้งาน</p>
                            </div>
                            <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                                <div>
                                    <form action="#" method="post">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="RestaurantName" required id="rrname">
                                        </div>
                                        <div class="col-md-12">
                                            <textarea class="form-control" placeholder="Address" rows="3" required id="rradd"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="Zip Code" required id="rrzip">
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control prolist" id="sel1">
                                                <?php
                                                $res = $con->query("SELECT `id`, `name` FROM `province`");
                                                while ($data = $res->fetch_assoc()) {
                                                    ?>

                                                    <option value="<?= $data['id'] ?>"> <?= $data['name'] ?> </option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="tel" class="form-control" placeholder="Phone" required id="rrphone">
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control prolist" id="plan">
                                                <option value="Free">Free</option>
                                                <option value="OneMonth">1 Month / 100฿</option>
                                                <option value="ThreeMonth">3 Months / 250฿</option>
                                            </select>
                                        </div><br>
                                        <div class="col-md-6">
                                            <a href="#firststep" data-toggle="tab" id="backstep">
                                                <input type="submit" class="form-control text-uppercase" value="Back" >
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="submit" class="form-control text-uppercase" value="Confirmed">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
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