<?php
session_start();
include '../dbconn.php';
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
        <link rel="stylesheet" href="../assets/css/fresh-bootstrap-table.css">
        <link rel="stylesheet" href="../assets/css/search_page.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/search.css">
        <link rel="stylesheet" href="../assets/css/slide2.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/simple-sidebar.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

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
        <section id="search_page">
            <div class="overlay">
                <div class="container text-center">
                    <h1>PIXUPFOOD</h1>
                    <h4>Search Food & Restaurant That You Want</h4>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
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
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="search_page_body">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h2>Fillter</h2>
                        <div class="col-md-12" style="padding-left:0px;">
                            <select class="form-control prolist" id="plan">
                                <option value="Type">ประเภทอาหาร</option>
                                <option value="North">อาหารเหนือ</option>
                                <option value="EastNorth">อาหารอีสาน</option>
                                <option value="South">อาหารใต้</option>
                                <option value="Carte">อาหารตามสั่งทั่วไป</option>
                                <option value="Dessert">ขนมหวาน</option>
                                <option value="Bakery">เบเกอรี่</option>
                            </select>
                        </div>
                        <div class="col-md-12" style="padding-left:0px;">
                            <h3>Restaurant Options</h3>
                            <form action="">
                                <input type="checkbox" name="sex" value="male">&nbsp;สั่งอาหารมากกว่า 100 ชุด<br>
                                <input type="checkbox" name="sex" value="female">&nbsp;สั่งอาหารล่วงหน้ามากกว่า 1 วัน<br>
                                <input type="checkbox" name="sex" value="male">&nbsp;มีรายการโปรโมชัน<br>
                                <input type="checkbox" name="sex" value="female">&nbsp;รับชำระสินค้าออนไลน์<br>
                                <input type="checkbox" name="sex" value="male">&nbsp;ร้านที่เปิดให้บริการ<br>
                                <input type="checkbox" name="sex" value="female">&nbsp;มีบริการด่วนพิเศษ
                            </form>
                        </div>
                        <div class="col-md-12" style="padding-left:0px;">
                            <h3>Food Types</h3>
                            <form action="">
                                <input type="checkbox" name="sex" value="male">&nbsp;อาหารตามสั่ง<br>
                                <input type="checkbox" name="sex" value="female">&nbsp;อาหารจัดเซ็ต(Box Set)<br>
                                <input type="checkbox" name="sex" value="male">&nbsp;อาหารว่าง<br>
                                <input type="checkbox" name="sex" value="female">&nbsp;ขนม เครื่องดื่ม และ เบเกอรี่<br>
                                <input type="checkbox" name="sex" value="male">&nbsp;อาหารมังสวิรัติ<br>
                                <input type="checkbox" name="sex" value="female">&nbsp;อาหารฮาลาล
                            </form>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h2>Result</h2>
                        <div class="col-md-12" style="padding-left:0px;">
                            <div class="content2" style="padding-bottom:15px">
                                <div class="fresh-table" style="font-family: 'supermarketregular';">
                                    <table id="fresh-table" class="table">
                                        <thead style="background-color: #FF9F00">
                                        <th data-field="picture"  style="width: 180px">Pictures</th>
                                        <th data-field="rfname"  data-sortable="true" style="width: 300px">Restaurants/Foods Name</th>
                                        <th data-field="addetail"  data-sortable="true" >Address/Details</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a class="pull-left" href="#">
                                                        <img class="media-object" src="http://placehold.it/150x90" alt="...">
                                                    </a>
                                                </td>
                                                <td>
                                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                                </td>
                                                <td>
                                                    <p>By Jhon Doe</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="pull-left" href="#">
                                                        <img class="media-object" src="http://placehold.it/150x90" alt="...">
                                                    </a>
                                                </td>
                                                <td>
                                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                                </td>
                                                <td>
                                                    <p>By Jhon Doe</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
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
        <script type="text/javascript">
            var $table = $('#fresh-table'),
                    full_screen = false;

            $().ready(function () {
                $table.bootstrapTable({
                    toolbar: ".toolbar",
                    showRefresh: false,
                    search: true,
                    showToggle: true,
                    showColumns: false,
                    pagination: true,
                    striped: true,
                    pageSize: 12,
                    pageList: [12, 25, 50, 100],
                    formatShowingRows: function (pageFrom, pageTo, totalRows) {
                        //do nothing here, we don't want to show the text "showing x of y from..." 
                    },
                    formatRecordsPerPage: function (pageNumber) {
                        return pageNumber + " rows visible";
                    },
                    icons: {
                        refresh: 'fa fa-refresh',
                        toggle: 'fa fa-th-list',
                        columns: 'fa fa-columns',
                        detailOpen: 'fa fa-plus-circle',
                        detailClose: 'fa fa-minus-circle'
                    }
                });



                $(window).resize(function () {
                    $table.bootstrapTable('resetView');
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