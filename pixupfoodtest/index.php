<?php
session_start();
include './dbconn.php';
?>

<html>
    <head>
       <?php include './template/customer-title-index.php'; ?>
        <title>PixupFood - The Original Food Delivery</title>
    </head>
    <body>
        <?php include './template/customer-navbar-indexpage.php'; ?>

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
                        <ul class="media-list main-list" style="border-top:1px solid #e8e8e8; padding-top:1.1em">
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

        <?php include './template/footer-indexpage.php'; ?>
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