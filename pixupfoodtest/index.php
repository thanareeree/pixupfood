<?php
session_start();
include './dbconn.php';
?>
<html>
    <head>
        <?php include './template/customer-title.php'; ?>
        <title>PixupFood - The Original Food Delivery</title>
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/css/slide2.css">
    </head>
    <body>
        <?php include 'template/customer-navbar.php'; ?>
        <div id="slider-l" class="slider-l">
            <a href="/view/search_page.php?search=">
                <img src="/assets/images/search.png" class="img-responsive" width="100px">
                <a onclick="parentNode.remove()" style="color: #0000ff;margin:0 0 0 15px ;">
                    <span>ปิดป้ายนี้</span></a> 
        </div>
        <!-- start home -->
        <section id="home">            
            <!-- Carousel -->
            <div id="Carousel1" class="carousel slide">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#Carousel1" data-slide-to="0" class="active"></li>
                    <li data-target="#Carousel1" data-slide-to="1"></li>
                    <li data-target="#Carousel1" data-slide-to="2"></li>
                    <li data-target="#Carousel1" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="assets/images/slide/nn.jpg" class="img-responsive" style="margin-top:0px;">
                    </div>
                    <div class="item">
                        <img src="assets/images/slide/dd.jpg" class="img-responsive" style="margin-top:0px;">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>ร้านโฮมเรส</h1>
                                <p>ข้าวกล่องหลากหลาย อร่อยชัวร์</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="assets/images/slide/ee.jpg" class="img-responsive" style="margin-top:0px">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>ป้าหน้า มอ</h1>
                                <p>ข้าวกล่องราคาประหยัด</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="assets/images/slide/ff.jpg" class="img-responsive" style="margin-top:0px">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>ร้านลมัยโภชนา</h1>
                                <p>ข้าวกล่องรสเด็ด</p>
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
                <h2 style="text-align:left">ร้านอาหารใกล้ๆคุณ</h2>
                <div class="row">
                    <div class="carousel slide" id="rescarousel">
                        <div class="carousel-inner">
                            <ul class="thumbnails">
                                <div id="shownearbylist">


                                </div>
                            </ul>
                        </div>
                        <!-- /#myCarousel -->
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
                        <a href="/view/cus_allnews.php" style="color:rgba(111,0,114,1)">
                            <h2 class="text-uppercase">ข่าวสาร<<</h2>
                        </a>
                        <div class="featured-article">
                            <?php
                            $res = $con->query("SELECT news.id, news.img_path, news.title, news.detail, news.created_time, restaurant.name "
                                    . "FROM `news` "
                                    . "LEFT JOIN restaurant ON restaurant.id = news.restaurant_id "
                                    . "ORDER BY news.created_time DESC LIMIT 1");
                            $news = $res->fetch_assoc();
                            $newfirstid = $news["id"];
                            ?>
                            <a href="#">
                                <img src="<?= $news["img_path"] ?>" alt="" class="thumb" >
                            </a>
                            <div class="block-title">
                                <h2><?= $news["title"] ?></h2>
                                <p class="by-author"><?= $news["detail"] ?><br><br>
                                    <?= $news["name"] ?>&nbsp;เมื่อวันที่: &nbsp;<?= substr($news["created_time"], 0, 11) . " " . substr($news["created_time"], 11, 5) ?>&nbsp;น.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 wow fadeInRight" data-wow-delay="0.6s" style="padding:63px 15px 0 100px">
                        <ul class="media-list main-list">
                            <?php
                            $res = $con->query("SELECT news.img_path, news.title, news.detail, news.created_time, restaurant.name "
                                    . "FROM `news` "
                                    . "LEFT JOIN restaurant ON restaurant.id = news.restaurant_id "
                                    . "WHERE news.id != '$newfirstid' ORDER BY RAND() DESC LIMIT 3");
                            while ($data = $res->fetch_assoc()) {
                                ?>
                                <li class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="<?=$data["img_path"]?>" alt="..." width="150px" style="max-height:90px;">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?= $data["title"]?></h4>
                                       <p class="by-author"><?= $data["detail"] ?><br><br>
                                    <?= $data["name"] ?>&nbsp;เมื่อวันที่: &nbsp;<?= substr($data["created_time"], 0, 11) . " " . substr($data["created_time"], 11, 5) ?>&nbsp;น.
                                </p>
                                    </div>
                                </li>
                            <?php } ?>
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
                        <a href="view/cus_allpromotions.php" style="color:rgba(111,0,114,1)">
                            <h2 class="text-uppercase">โปรโมชั่น<<</h2>
                        </a>
                        <div class="featured-article">
                            <a href="#">
                                <img src="assets/images/allpromo/promo01.jpg" alt="" class="thumb">
                            </a>
                            <div class="block-title">
                                <h2>ลดสนั่นเมือง</h2>
                                <p class="by-author"><small>ลดสูงสุดถึง 50% วันนี้ - 31 ธันวาคม 2558 ที่ร้านลุงอนันต์<br>เมื่อสั่งอาหารผ่านเว็บไซต์</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 wow fadeInRight" data-wow-delay="0.6s" style="padding:60px 15px 0 100px">
                        <ul class="media-list main-list" style="border-top:1px solid #e8e8e8; padding-top:1.1em">
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="assets/images/allpromo/promo02.jpg"  alt="..." width="150px" style="max-height:90px;">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">ป้าลมัยใจดี!!</h4>
                                    <p class="by-author">ป้าลมัยใจดี ลด 10% ทุกยอดการสั่งซื้อผ่านเว็บไซต์เท่านั้น!!!</p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="assets/images/allpromo/promo03.jpg"  alt="..." width="150px" style="max-height:90px;">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">ไม่มีอีกแล้ว กับโปรโมชั่นสุดพิเศษ!!!</h4>
                                    <p class="by-author">ป้าน้อยใจปล้ำ เมื่อสั่งอาหารผ่านเว็บไซต์ ซื้อ 3 กล่องฟรี 1 กล่อง*<br>*จำกัดกล่องฟรีสูงสุดไม่เกิน 20 กล่อง</p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="assets/images/allpromo/promo04.jpg"  alt="..." width="150px" style="max-height:90px;">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">ฟรีน้ำกระป๋อง!!</h4>
                                    <p class="by-author">เมื่อมียอดสั่งซื้อกับร้านลุงเอก ผ่านเว็บไซต์ ทุก 100.- รับน้ำอัดลมฟรี 2 กระป๋อง</p>
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
                    <div class="col-md-12 wow bounceIn" style="margin-bottom: 25px;">
                        <h2 class="text-uppercase">Our Pricing</h2>
                    </div>
                    <div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="panel price panel-green">
                            <div class="panel-heading arrow_box text-center">
                                <h3>FREE PLAN</h3>
                            </div>
                            <div class="panel-body text-center">
                                <p class="lead" style="font-size:35px;margin: 0px;"><strong>฿0 / month</strong></p>
                            </div>
                            <ul class="list-group list-group-flush text-center">
                                <li class="list-group-item"><i class="icon-ok text-success"></i> จำกัดเมนูอาหาร 20 เมนู</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> จำกัดจำนวนคนส่งอาหาร</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> ติดตามสถานะด้วยตนเอง</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> ดูแลระบบในเวลาเปิดร้าน</li>
                                <li class="list-group-item"> -</li>
                                <li class="list-group-item"> -</li>
                                <li class="list-group-item"> -</li>
                                <li class="list-group-item"> -</li>
                            </ul>
                            <div class="panel-body text-center">
                                <span>ใช้งานฟรี ไม่เสียค่าใช้จ่าย!</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="panel price panel-blue">
                            <div class="panel-heading  text-center">
                                <h3>BASIC PLAN</h3>
                            </div>
                            <div class="panel-body text-center">
                                <p class="lead" style="font-size:35px;margin: 0px;"><strong>฿100 / month</strong></p>
                            </div>
                            <ul class="list-group list-group-flush text-center">
                                <li class="list-group-item"><i class="icon-ok text-success"></i> จำกัดเมนูอาหาร 60 เมนู</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> ไม่จำกัดจำนวนคนส่งอาหาร</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> ติดตามสถานะด้วย code</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> ดูแลระบบในเวลาเปิดร้าน</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> รีวิวร้านอาหาร 1ครั้ง/เดือน</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> ฟรีขึ้นโฆษณาหน้าแรก 1ตัว</li>
                                <li class="list-group-item"> -</li>
                                <li class="list-group-item"> -</li>
                            </ul>
                            <div class="panel-body text-center">
                                <span>จ่ายสบายๆ เหมาะกับผู้เริ่มต้นใช้งาน!</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="panel price panel-red">
                            <div class="panel-heading arrow_box text-center">
                                <h3>PRO PLAN</h3>
                            </div>
                            <div class="panel-body text-center">
                                <p class="lead" style="font-size:35px;margin: 0px;"><strong>฿250 / 3months</strong></p>
                            </div>
                            <ul class="list-group list-group-flush text-center">
                                <li class="list-group-item"><i class="icon-ok text-success"></i> ไม่จำกัดเมนูอาหาร</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> ไม่จำกัดจำนวนคนส่งอาหาร</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> ติดตามสถานะด้วย code</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> ดูแลระบบตลอด 24/7</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> รีวิวร้านอาหาร 2ครั้ง/เดือน</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> สอนการใช้งานตามขั้นตอน</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> ดูแลระบบหลังบ้าน</li>
                                <li class="list-group-item"><i class="icon-ok text-success"></i> ฟรีขึ้นโฆษณาหน้าแรก 2ตัว</li>
                            </ul>
                            <div class="panel-body text-center">
                                <span>สุดคุ้ม! กับบริการเสริมพิเศษ</span>
                            </div>
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
                            <h2 class="text-uppercase">ติดต่อเรา</h2>
                            <p>มีปัญหาในการใช้งาน สนใจ หรือต้องการสอบถามข้อมูลเพิ่มเติมสามารถติดต่อเราได้ทันที </p>
                            <address>
                                <p><i class="fa fa-map-marker"></i>365/1167 หมู่บ้านสวนธน ซ.พุทธบูชา47 แขวงบางมด เขตทุ่งครุ กรุงเทพมหานคร 10140</p>
                                <p><i class="fa fa-phone"></i> 0877056769</p>
                                <p><i class="fa fa-envelope-o"></i> support@pixupfood.com</p>
                            </address>
                        </div>
                        <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="contact-form">
                                <form action="#" method="post">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="ชื่อ - นามสกุล">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" placeholder="อีเมลล์">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" placeholder="ชื่อเรื่อง">
                                    </div>
                                    <div class="col-md-12">
                                        <textarea class="form-control" placeholder="ข้อความ" rows="4"></textarea>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="submit" class="form-control text-uppercase" value="ส่ง">
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
                $(function () {

                    var $sidebar = $("#slider-l"),
                            $window = $(window),
                            offset = $sidebar.offset(),
                            topPadding = 15;
                });
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
                        url: '/customer/customer-search-nearby.php',
                        type: "POST",
                        data: {"lat": lat,
                            "long": long, "type":"nearby"},
                        dataType: "html",
                        success: function (returndata) {
                            if (returndata == "error") {
                                alert("123459859859656");
                            } else {
                                $("#shownearbylist").append(returndata);
                                $('[data-toggle="tooltip"]').tooltip()
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