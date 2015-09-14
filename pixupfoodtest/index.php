<?php
session_start();
include './dbconn.php';
include './view/navbar.php';
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
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <!-- bootstrap css -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">


        <!-- custom css -->
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/search.css">
        <link rel="stylesheet" href="assets/css/slide2.css">
        <link rel="stylesheet" type="text/css" href="assets/css/simple-sidebar.css" />


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
                    <img src="assets/images/bar/menu.png" width="50" height="50" style="margin-top:8px;"/>
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
            <div class="container" style="margin-left:100px;margin-right:40px;height:70px;width:auto;">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                    </button>
                    <a href="index.php" style="color:rgba(255,127,0,1)" class="navbar-brand">Pixup</a>
                    <a href="index.php" class="navbar-brand" style="color:black;padding-left: 0px;">Food</a>
                    <div class="col-md-4" style="margin:7px 0 0 15%;">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                    <input type="text" class="form-control input-lg" placeholder="Search.." id="searchinput" />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="button" id="searchbtn">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <ul class="nav navbar-nav navbar-right text-uppercase" <?= (!isset($_SESSION["islogin"])) ? '' : 'style="display: none"' ?> >
                        <li><a  href="#" > สมัครสมาชิก | เข้าสู่ระบบ >></a></li>
                        <li class="dropdown">
                            <a href="login.php" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                <img src="assets/images/bar/user.png" style="width:40px;height:40px;"/>
                            </a>
                            <ul class="dropdown-menu" style="padding: 0px">
                                <li>
                                    <div class="middlePage">
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
                                                                <a href="view/cus_register.php">
                                                                    <img src="assets/images/bar/userl.png" style="width:60px; height:60px;margin-top: 10px;">
                                                                </a>
                                                                <a href="view/cus_register.php">
                                                                    <p style="font-weight:bold"> CUSTOMERS </p>
                                                                </a>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <a href="view/res_register.php">
                                                                    <img src="assets/images/bar/restaurant.png" style="width:60px; height:60px;margin-top: 10px;">
                                                                </a>
                                                                <a href="view/res_register.php">
                                                                    <p style="font-weight:bold"> RESTAURANTS </p>
                                                                </a>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-7" style="border-left:1px solid #ccc;height:160px">
                                                        <form class="form-horizontal" action="api/loginsession.php" method="post" id="loginbox">
                                                            <fieldset>
                                                                <input id="loginemail"  name="loginemail" type="text" placeholder="Enter User Name" class="form-control input-md">                                                                
                                                                <input  id="password" name="password" type="password" placeholder="Enter Password" class="form-control input-md" style="margin: 10px 0 5px 0">
                                                                <div class="spacing"><input type="checkbox" name="checkboxes" id="checkboxes-0" value="1"><small> Remember me</small></div>
                                                                <div class="spacing spacing-height"><a href="#"><p style="font-size: 14px">Forgot Password?</p></a><br/></div>
                                                                <button type="submit"  class="btn btn-info btn-sm pull-right">Sign In</button>
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

                    <ul class="nav navbar-nav navbar-right text-uppercase" <?= (!isset($_SESSION["islogin"])) ? 'style="display: none"' : '' ?> >
                        <li><a href="api/logout.php" class="nav-link"><?= (!isset($_SESSION["islogin"])) ? 'No Session' : "สวัสดีคุณ " . $_SESSION["userdata"]["firstName"] . " " . $_SESSION["userdata"]["lastName"] ?></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="assets/images/bar/user.png" style="width:40px;height:40px;"/>
                            </a>
                            <ul class="dropdown-menu" style="padding: 0px">
                                <li>
                                    <div class="middlePage1">
                                        <div class="panel panel-info">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-4" style="border-right:1px solid #ccc;height:auto;">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <a href="view/cus_customer_profile.php">
                                                                    <img src="assets/images/profile/1.jpg" width="160px" height="160px">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <form class="form-horizontal">
                                                            <fieldset>
                                                                <input id="textinput" name="textinput" type="text" placeholder="Enter User Name" class="form-control input-md"><br>
                                                                <a href="api/logout.php">
                                                                    <button id="logoutbutton" type="button" class="btn btn-danger btn-sm pull-right" style="margin-left: 15px;">Logout</button>
                                                                </a>
                                                                <a href="view/cus_customer_profile.php">
                                                                    <button id="profilebutton" class="btn btn-info btn-sm pull-right" type="button">Profile</button>
                                                                </a>
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

        <!-- start home -->
        <section id="home">
            <!-- Carousel ================================================== -->
            <div id="Carousel1" class="carousel slide">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#Carousel1" data-slide-to="0" class="active"></li>
                    <li data-target="#Carousel1" data-slide-to="1"></li>
                    <li data-target="#Carousel1" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="assets/images/slide/aa.png" class="img-responsive" style="margin-top:0px;">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>The best of Think is do</h1>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="assets/images/slide/bb.png" class="img-responsive" style="margin-top:0px">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>Changes to the Grid</h1>
                                <p>Bootstrap 3 still features a 12-column grid, but many of the CSS class names have completely changed.</p>
                                <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="assets/images/slide/cc.png" class="img-responsive" style="margin-top:0px">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>Percentage-based sizing</h1>
                                <p>With "mobile-first" there is now only one percentage-based grid.</p>
                                <p><a class="btn btn-large btn-primary" href="#">Browse gallery</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#Carousel1" data-slide="prev">
                    <span class="icon-prev"></span>
                </a>
                <a class="right carousel-control" href="#Carousel1" data-slide="next">
                    <span class="icon-next"></span>
                </a>  
            </div>
            <!-- /.carousel -->
        </section>
        <!-- end home -->
        <!-- start 5 step -->
        <section id="step">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow fadeInUp templatemo-box" data-wow-delay="0.3s" style="text-align:left">
                        <h2>สั่งง่ายๆเพียง 5 ขั้นตอน</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-2 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                        <img src="assets/images/sixStep/step2.png" width="80" height="80">
                        <h3>ค้นหาร้านอาหาร</h3>
                    </div>
                    <div class="col-md-2 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                        <img src="assets/images/sixStep/step3.png" width="80" height="80">
                        <h3>เลือกรายการอาหาร</h3>
                    </div>
                    <div class="col-md-2 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                        <img src="assets/images/sixStep/step4.png" width="80" height="80">
                        <h3>สั่งตามขั้นตอน</h3>
                    </div>
                    <div class="col-md-2 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                        <img src="assets/images/sixStep/step5.png" width="80" height="80">
                        <h3>จัดส่งสินค้า</h3>
                    </div>
                    <div class="col-md-2 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                        <img src="assets/images/sixStep/step6.png" width="80" height="80">
                        <h3>รับของและชำระเงิน</h3>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
            </div>
        </section>
        <!-- end 6 step -->

        <!-- start nearby -->
        <section id="nearby" style="padding-bottom:5px">
            <div class="container wow fadeInUp">
                <h2 style="text-align:left">ร้านไหนใกล้ๆคุณ</h2>
                <div class="row">
                    <div class="carousel slide" id="rescarousel">
                        <div class="carousel-inner">
                            <ul class="thumbnails">
                                <div id="shownearbylist">


                                </div>
                            </ul>

                        </div><!-- /#myCarousel -->
                    </div>
                </div>
            </div>
        </section>
        <div id="map" style="display: none"></div>

        <!-- news update head -->
        <section id="nupdateh">
            <img src="assets/images/newsupdatehead.png">
        </section>
        <!-- news update head -->

        <!-- start news update -->
        <section id="feature" style="padding:5px 0 5px 0">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-5 wow fadeInLeft" data-wow-delay="0.6s">
                        <a href="#" style="color:rgba(111,0,114,1)">
                            <h2 class="text-uppercase">ข่าวสาร<<</h2>
                        </a>
                        <div class="featured-article">
                            <a href="#">
                                <img src="assets/images/default-img482.png" alt="" class="thumb">
                            </a>
                            <div class="block-title">
                                <h2>Lorem ipsum dolor asit amet</h2>
                                <p class="by-author"><small>By Jhon Doe</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 wow fadeInRight" data-wow-delay="0.6s" style="padding:63px 15px 0 100px">
                        <ul class="media-list main-list">
                            <li class="media" style="border-top:1px solid #e8e8e8; padding-top:1.1em">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="assets/images/default-img150.png" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="assets/images/default-img150.png" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="assets/images/default-img150.png" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- end news update -->

        <!-- start feature1 -->
        <section id="feature1" style="padding:5px 0 5px 0">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-5 wow fadeInLeft" data-wow-delay="0.6s">
                        <a href="#" style="color:rgba(111,0,114,1)">
                            <h2 class="text-uppercase">โปรโมชั่น<<</h2>
                        </a>
                        <div class="featured-article">
                            <a href="#">
                                <img src="assets/images/default-img482.png" alt="" class="thumb">
                            </a>
                            <div class="block-title">
                                <h2>Lorem ipsum dolor asit amet</h2>
                                <p class="by-author"><small>By Jhon Doe</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 wow fadeInRight" data-wow-delay="0.6s" style="padding:60px 15px 0 100px">
                        <ul class="media-list main-list">
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="assets/images/default-img150.png" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="assets/images/default-img150.png" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="assets/images/default-img150.png" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- end feature1 -->

        <!-- start pricing -->
        <section id="pricing">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow bounceIn">
                        <h2 class="text-uppercase">Our Pricing</h2>
                    </div>
                    <div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="pricing text-uppercase">
                            <div class="pricing-title">
                                <h4>Basic Plan</h4>
                                <p>$10</p>
                                <small class="text-lowercase">monthly</small>
                            </div>
                            <ul>
                                <li>2 GB Space</li>
                                <li>200 GB Bandwidth</li>
                                <li>20 More Themes</li>
                                <li>Lifetime Support</li>
                            </ul>
                            <button class="btn btn-primary text-uppercase">Sign up</button>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="pricing active text-uppercase">
                            <div class="pricing-title">
                                <h4>Business Plan</h4>
                                <p>$20</p>
                                <small class="text-lowercase">monthly</small>
                            </div>
                            <ul>
                                <li>5 GB space</li>
                                <li>500 GB Bandwidth</li>
                                <li>50 More Themes</li>
                                <li>Lifetime Support</li>
                            </ul>
                            <button class="btn btn-primary text-uppercase">Sign up</button>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="pricing text-uppercase">
                            <div class="pricing-title">
                                <h4>Pro Plan</h4>
                                <p>$30</p>
                                <small class="text-lowercase">monthly</small>
                            </div>
                            <ul>
                                <li>10 GB space</li>
                                <li>1,000 GB bandwidth</li>
                                <li>100 more themes</li>
                                <li>Lifetime Support</li>
                            </ul>
                            <button class="btn btn-primary text-uppercase">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end pricing -->

        <!-- start contact -->
        <section id="contact">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                            <h2 class="text-uppercase">Contact Us</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. </p>
                            <address>
                                <p><i class="fa fa-map-marker"></i>1234 Street Name, City Name, United States</p>
                                <p><i class="fa fa-phone"></i> 0992 234234 / 0234 234234</p>
                                <p><i class="fa fa-envelope-o"></i> hello@yoursite.com</p>
                            </address>
                        </div>
                        <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="contact-form">
                                <form action="#" method="post">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" placeholder="Subject">
                                    </div>
                                    <div class="col-md-12">
                                        <textarea class="form-control" placeholder="Message" rows="4"></textarea>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="submit" class="form-control text-uppercase" value="Send">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end contact -->

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
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/wow.min.js"></script>   
        <script src="assets/js/custom.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

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

                var lat = 13.6415824;
                var long = 100.4963968;
                function startMap() {

                    map = new google.maps.Map(document.getElementById("map"));
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(getPosition, errorFunction);
                        //navigator.geolocation.watchPosition(updatePosition);
                    } else {
                        alert("ไม่สามารถใช้งาน Search by nearby ได้");
                        document.getElementById("latinput").value = "";
                        document.getElementById("longinput").value = "";
                    }
                }

                startMap();

                function getPosition(pos) {
                    globalPosition = pos;
                    lat = pos.coords.latitude;
                    long = pos.coords.longitude;
                    // alert($("#latinput").val() + "\n" + $("#longinput").val());
                    console.log(pos);

                }

                function errorFunction() {
                    alert("ไม่สามารถใช้งาน Search by nearby ได้");
                    document.getElementById("latinput").value = "";
                    document.getElementById("longinput").value = "";
                }

                function showlist() {
                    $.ajax({
                        url: 'customer/customer-search-nearby.php',
                        type: "POST",
                        data: {"lat": lat,
                            "long": long},
                        dataType: "html",
                        success: function (returndata) {
                            if (returndata == "error") {
                                alert("123459859859656");
                            } else {
                                $("#shownearbylist").append(returndata);
                            }
                        }
                    });
                }
                showlist();

                $("#searchbtn").click(function (e) {
                    var searchkeyword = $("#searchinput").val();
                    document.location = "view/search_page.php?search=" + searchkeyword;
                });

                $("#searchinput").on("keyup", function (e) {
                    if (e.keyCode == "13") {
                        var searchkeyword = $(this).val();
                        document.location = "view/search_page.php?search=" + searchkeyword;
                    }
                });

            });
        </script>




    </body>
</html>