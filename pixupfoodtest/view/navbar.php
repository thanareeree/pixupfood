<?php


function addlink($title) { ?>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/search.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/simple-sidebar.css" />
    <link rel="stylesheet" href="../assets/Supermarket/stylesheet.css">

<?php } 


function show_navbar() { ?>
    <!-- start preloader -->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!-- end preloader -->
    <!-- start navigation -->
    <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
        <!-- <div class="navbar-header" style="padding-left:10px;">
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
        </div> -->
        <div class="container" style="margin-left:100px;margin-right:40px;height:70px;width:auto;">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                </button>
                <a href="../index.php" style="color:rgba(255,127,0,1)" class="navbar-brand">Pixup</a>
                <a href="../index.php" class="navbar-brand" style="color:black;padding-left: 0px;">Food</a>
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
                    <li><a  <?= (!isset($_SESSION["islogin"])) ? 'href="#"' : 'href="../api/logout.php" class="nav-link"' ?> ><?= (!isset($_SESSION["islogin"])) ? 'สมัครสมาชิก | เข้าสู่ระบบ >>' : $_SESSION["userdata"]["firstName"] . " " . $_SESSION["userdata"]["lastName"] ?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <img src="../assets/images/bar/user.png" style="width:40px;height:40px;"/>
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
                                                    <form class="form-horizontal" action="../api/loginsession.php" method="post">
                                                        <fieldset>
                                                            <input id="textinput" name="loginemail" type="text" placeholder="Enter User Name" class="form-control input-md">                                                                
                                                            <input id="textinput" name="password" type="password" placeholder="Enter Password" class="form-control input-md" style="margin: 10px 0 5px 0">
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
            </div>
        </div>
    </nav>
    <!-- end navigation -->


<?php } ?>



<?php

function show_footer() { ?>

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

    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/custom.js"></script>
     <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<?php } ?>


<?php

function cusnavbar() { ?>
    <!-- start preloader -->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!-- end preloader -->
    <!-- start navigation -->
    <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
        <div class="container" style="margin-left:100px;margin-right:40px;height:70px;width:auto;">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                </button>

                <a href="../index.php" class="navbar-brand">Pixup</a>
                <a href="../index.php" class="navbar-brand" style="color:rgba(0,0,32,1);padding-left: 0px;">Food</a>
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
                    <li><a href="../api/logout.php" class="nav-link"><?= (!isset($_SESSION["islogin"])) ? 'No Session' : "สวัสดีคุณ " . $_SESSION["userdata"]["firstName"] . " " . $_SESSION["userdata"]["lastName"] ?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../assets/images/bar/user.png" style="width:40px;height:40px;"/>
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
                                                            <a href="cus_customer_profile.php">
                                                                <img src="../assets/images/profile/1.jpg" width="160px" height="160px">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <form class="form-horizontal">
                                                        <fieldset>
                                                            <input id="textinput" name="textinput" type="text" placeholder="Enter User Name" class="form-control input-md"><br>
                                                            <a href="../api/logout.php">
                                                                <button id="logoutbutton" type="button" class="btn btn-danger btn-sm pull-right" style="margin-left: 15px;">Logout</button>
                                                            </a>
                                                            <a href="cus_customer_profile.php">
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


<?php } ?>



