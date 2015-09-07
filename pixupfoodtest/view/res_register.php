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
        <title>Restaurant Register Form</title>
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
        <style>
            #map {
                height: 250px;
                width: 50%;
            }
        </style>


    </head>
    <body onload="startMap()">
        <?php show_navbar(); ?>
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
                                <h3 class="text-uppercase">Phone :</h3>
                                <p>โทรศัพท์ </p>
                            </div>
                            <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                                <div>
                                    <form action="#" method="post">
                                        <div class="col-md-12">
                                            <input type="email" class="form-control" placeholder="Email" required id="resemail" name="resemail">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control" placeholder="Password" required id="respassword" name="respassword">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control" placeholder="Confirm Password" required id="resconfirmpwd" name="resconfirmpwd">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="FirstName" required id="resfname" name="resfname">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="LastName" required id="reslname" name="reslname">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control"  required id="latinput" name="latinput" >
                                        </div>
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control"  required id="longinput" name="longinput">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="tel" class="form-control" placeholder="Phone" required id="resphone" name="resphone">
                                        </div><br>
                                        <div class="col-md-6 pull-right">
                                            <a href="#secondstep" data-toggle="tab" id="nextstep">
                                                <input type="button" class="form-control text-uppercase btn-primary" value="Next">
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
                                <h3 class="text-uppercase">Detail :</h3>
                                <p>รายละเอียดร้าน </p><br>
                                <h3 class="text-uppercase">Address :</h3>
                                <p>ที่อยู่ร้านอาหาร </p><br>
                                <h3 class="text-uppercase">Province :</h3>
                                <p>จังหวัด </p>
                                <h3 class="text-uppercase">Zone :</h3>
                                <p>เขต </p>
                                <h3 class="text-uppercase">Plan :</h3>
                                <p>แผนการใช้งาน</p>
                            </div>
                            <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                                <div>
                                    <form action="#" method="post">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="RestaurantName" required id="restaurantname" name="restaurantname">
                                        </div>
                                        <div class="col-md-12">
                                            <textarea class="form-control" placeholder="Detail" rows="3" required id="detail" name="detail"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea class="form-control" placeholder="Address" rows="3" required id="resaddress" name="resaddress"></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <select class="form-control prolist" id="provincelist">
                                                <?php
                                                $res = $con->query("SELECT `id`, `name` FROM `province`");
                                                while ($data = $res->fetch_assoc()) {
                                                    ?>

                                                    <option value="<?= $data['id'] ?>"> <?= $data['name'] ?> </option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control prolist" id="zonelist">
                                                <?php
                                                $res = $con->query("SELECT `id`, `name` FROM `zone`");
                                                while ($data = $res->fetch_assoc()) {
                                                    ?>

                                                    <option value="<?= $data['id'] ?>"> <?= $data['name'] ?> </option>

                                                <?php } ?>
                                            </select>
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
            <div id="map" style="display: none"></div>
        </section>
        <!-- end register -->



        <?php show_footer(); ?>
        <script>
            $(document).ready(function () {
                function startMap() {

                    map = new google.maps.Map(document.getElementById("map"));
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(getPosition);
                        //navigator.geolocation.watchPosition(updatePosition);
                    } else {
                        alert("ไม่รองรับ HTML5 Geolocation");
                    }
                }
                ;
                startMap();


                function getPosition(pos) {
                    globalPosition = pos;
                    document.getElementById("latinput").value = pos.coords.latitude;
                    document.getElementById("longinput").value = pos.coords.longitude;
                    console.log(pos);

                }
                ;

                //Handles menu drop down
                $('.dropdown-menu').find('form').click(function (e) {
                    e.stopPropagation();
                });
                $("#backstep").click(function () {
                    $("#firststep").fadeIn(500);
                    $("#secondstep").hide();
                });

                $("#nextstep").click(function () {
                    $("#firststep").hide();
                    $("#secondstep").fadeIn(500);
                });

            });
        </script>
    </body>
</html>