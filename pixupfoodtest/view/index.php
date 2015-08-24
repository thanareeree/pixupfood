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
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/search.css">
        <link rel="stylesheet" href="../assets/css/slide2.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/simple-sidebar.css" />

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
                    <a href="login.php" style="color:rgba(255,127,0,1)" class="navbar-brand">Pixup</a>
                    <a href="#" class="navbar-brand" style="color:black;padding-left: 0px;">Food</a>
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
                        <li><a href="#contact"><?= (!isset($_SESSION["islogin"]))?  'No Session': $_SESSION["userdata"]["firstName"]  ?></a></li>
                        <li>
                            <a href="login.php">
                                <img src="../assets/images/bar/user.png" style="width:40px;height:40px;"/>
                            </a>
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
                        <img src="../assets/images/slide/aa.png" class="img-responsive" style="margin-top:0px;">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>The best of Think is do</h1>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="../assets/images/slide/bb.png" class="img-responsive" style="margin-top:0px">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>Changes to the Grid</h1>
                                <p>Bootstrap 3 still features a 12-column grid, but many of the CSS class names have completely changed.</p>
                                <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="../assets/images/slide/cc.png" class="img-responsive" style="margin-top:0px">
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
        <!-- start nearby -->
        <section id="nearby" style="padding-bottom:5px">
            <div class="container">
                <div class="row">
                    <div class="carousel slide" id="rescarousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <ul class="thumbnails">
                                    <li class="col-sm-3">
                                        <div class="fff">
                                            <div class="thumbnail">
                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                            </div>
                                            <div class="caption">
                                                <h4>Praesent commodo</h4>
                                                <p>Nullam Condimentum Nibh Etiam Sem</p>
                                                <a style="color:rgba(255,127,0,1)" class="btn btn-mini" href="#">» Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-sm-3">
                                        <div class="fff">
                                            <div class="thumbnail">
                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                            </div>
                                            <div class="caption">
                                                <h4>Praesent commodo</h4>
                                                <p>Nullam Condimentum Nibh Etiam Sem</p>
                                                <a style="color:rgba(255,127,0,1)" class="btn btn-mini" href="#">» Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-sm-3">
                                        <div class="fff">
                                            <div class="thumbnail">
                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                            </div>
                                            <div class="caption">
                                                <h4>Praesent commodo</h4>
                                                <p>Nullam Condimentum Nibh Etiam Sem</p>
                                                <a style="color:rgba(255,127,0,1)" class="btn btn-mini" href="#">» Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-sm-3">
                                        <div class="fff">
                                            <div class="thumbnail">
                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                            </div>
                                            <div class="caption">
                                                <h4>Praesent commodo</h4>
                                                <p>Nullam Condimentum Nibh Etiam Sem</p>
                                                <a style="color:rgba(255,127,0,1)" class="btn btn-mini" href="#">» Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div><!-- /Slide1 --> 
                            <div class="item">
                                <ul class="thumbnails">
                                    <li class="col-sm-3">
                                        <div class="fff">
                                            <div class="thumbnail">
                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                            </div>
                                            <div class="caption">
                                                <h4>Praesent commodo</h4>
                                                <p>Nullam Condimentum Nibh Etiam Sem</p>
                                                <a style="color:rgba(255,127,0,1)" class="btn btn-mini" href="#">» Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-sm-3">
                                        <div class="fff">
                                            <div class="thumbnail">
                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                            </div>
                                            <div class="caption">
                                                <h4>Praesent commodo</h4>
                                                <p>Nullam Condimentum Nibh Etiam Sem</p>
                                                <a style="color:rgba(255,127,0,1)" class="btn btn-mini" href="#">» Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-sm-3">
                                        <div class="fff">
                                            <div class="thumbnail">
                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                            </div>
                                            <div class="caption">
                                                <h4>Praesent commodo</h4>
                                                <p>Nullam Condimentum Nibh Etiam Sem</p>
                                                <a style="color:rgba(255,127,0,1)" class="btn btn-mini" href="#">» Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-sm-3">
                                        <div class="fff">
                                            <div class="thumbnail">
                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                            </div>
                                            <div class="caption">
                                                <h4>Praesent commodo</h4>
                                                <p>Nullam Condimentum Nibh Etiam Sem</p>
                                                <a style="color:rgba(255,127,0,1)" class="btn btn-mini" href="#">» Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div><!-- /Slide2 --> 
                            <div class="item">
                                <ul class="thumbnails">
                                    <li class="col-sm-3">	
                                        <div class="fff">
                                            <div class="thumbnail">
                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                            </div>
                                            <div class="caption">
                                                <h4>Praesent commodo</h4>
                                                <p>Nullam Condimentum Nibh Etiam Sem</p>
                                                <a style="color:rgba(255,127,0,1)" class="btn btn-mini" href="#">» Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-sm-3">
                                        <div class="fff">
                                            <div class="thumbnail">
                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                            </div>
                                            <div class="caption">
                                                <h4>Praesent commodo</h4>
                                                <p>Nullam Condimentum Nibh Etiam Sem</p>
                                                <a style="color:rgba(255,127,0,1)" class="btn btn-mini" href="#">» Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-sm-3">
                                        <div class="fff">
                                            <div class="thumbnail">
                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                            </div>
                                            <div class="caption">
                                                <h4>Praesent commodo</h4>
                                                <p>Nullam Condimentum Nibh Etiam Sem</p>
                                                <a style="color:rgba(255,127,0,1)" class="btn btn-mini" href="#">» Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-sm-3">
                                        <div class="fff">
                                            <div class="thumbnail">
                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                            </div>
                                            <div class="caption">
                                                <h4>Praesent commodo</h4>
                                                <p>Nullam Condimentum Nibh Etiam Sem</p>
                                                <a style="color:rgba(255,127,0,1)" class="btn btn-mini" href="#">» Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div><!-- /Slide3 --> 
                        </div>


                        <nav>
                            <ul class="control-box2 pager">
                                <li><a style="color:black" data-slide="prev" href="#rescarousel" class=""><i class="glyphicon glyphicon-chevron-left"></i></a></li>
                                <li><a style="color:black" data-slide="next" href="#rescarousel" class=""><i class="glyphicon glyphicon-chevron-right"></i></a></li>
                            </ul>
                        </nav>
                        <!-- /.control-box -->   

                    </div><!-- /#myCarousel -->
                </div>
            </div>
        </section>
        <!-- end nearby -->
        <!-- start 6 step -->
        <section id="step">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow fadeInUp templatemo-box" data-wow-delay="0.3s" style="text-align:left">
                        <h2>สั่งง่ายๆเพียง 6 ขั้นตอน</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                        <img src="../assets/images/sixStep/step1.png">
                        <h3>เข้าสู่ระบบ</h3>
                    </div>
                    <div class="col-md-2 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                        <img src="../assets/images/sixStep/step2.png">
                        <h3>ค้นหา</h3>
                    </div>
                    <div class="col-md-2 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                        <img src="../assets/images/sixStep/step3.png">
                        <h3>เลือกรายการอาหาร</h3>
                    </div>
                    <div class="col-md-2 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                        <img src="../assets/images/sixStep/step4.png">
                        <h3>สั่งตามขั้นตอน</h3>
                    </div>
                    <div class="col-md-2 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                        <img src="../assets/images/sixStep/step5.png">
                        <h3>ติดตามสินค้า</h3>
                    </div>
                    <div class="col-md-2 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                        <img src="../assets/images/sixStep/step6.png">
                        <h3>มาอร่อยได้เลย!</h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- end 6 step -->

        <!-- news update head -->
        <section id="nupdateh">
            <img src="../assets/images/newsupdatehead.png">
        </section>
        <!-- news update head -->

        <!-- start news update -->
        <section id="feature" style="padding:5px 0 5px 0">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-5 wow fadeInLeft" data-wow-delay="0.6s">
                        <h2 class="text-uppercase">News update</h2>
                        <div class="featured-article">
                            <a href="#">
                                <img src="http://placehold.it/482x350" alt="" class="thumb">
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
                                    <img class="media-object" src="http://placehold.it/150x90" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/150x90" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/150x90" alt="...">
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
                        <div class="featured-article">
                            <a href="#">
                                <img src="http://placehold.it/482x350" alt="" class="thumb">
                            </a>
                            <div class="block-title">
                                <h2>Lorem ipsum dolor asit amet</h2>
                                <p class="by-author"><small>By Jhon Doe</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 wow fadeInRight" data-wow-delay="0.6s" style="padding:0 15px 0 100px">
                        <ul class="media-list main-list">
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/150x90" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/150x90" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/150x90" alt="...">
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
        <script src="../assets/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script>
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
        <!--<script src="../assets/js/jquery.js"></script>-->
        
        <script src="../assets/js/wow.min.js"></script>   
        <script src="../assets/js/jquery.singlePageNav.min.js"></script>
        <script src="../assets/js/custom.js"></script>
        <script src="../assets/js/jquery.al.js"></script>
    </body>
</html>