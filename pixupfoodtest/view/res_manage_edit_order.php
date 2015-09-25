<?php
include '../api/islogin.php';
include '../dbconn.php';
?>




<html>
    <head>
        <title>Pixupfood - Restaurant Setting Management</title>
        <?php include '../template/customer-title.php'; ?>

        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/res_restaurant_manage.css">
        




    </head>
    <body>
        <?php
        $resid = $_SESSION["restdata"]["id"];
        $result = $con->query("select * from restaurant where id = '$resid' ");
        $resdata = $result->fetch_assoc();

        $deliveryRes = $con->query("SELECT delivery_type.id, delivery_type.description, "
                . "mapping_delivery_type.deliveryfee "
                . "FROM restaurant "
                . "LEFT JOIN mapping_delivery_type ON mapping_delivery_type.restaurant_id = restaurant.id "
                . "LEFT JOIN delivery_type ON delivery_type.id = mapping_delivery_type.delivery_type_id "
                . "WHERE restaurant.id = '$resid' ");
        $deliveryData = $deliveryRes->fetch_assoc();
        ?>
        <?php include '../template/restaurant-navbar.php'; ?>
        <form>
            <input type="hidden" id="resIdvalue" value="<?= $resid ?>">
        </form>
        <!-- start head -->
        <section id="head">
            <div id="myCarousel" class="carousel" style="margin-top:70px;">
                <!-- Indicators -->
                <div class="item">
                    <img src="/assets/images/slide/aa.png" class="img-responsive">
                    <div class="container">
                        <div class="carousel-caption-new">
                            <div class="RestaurantHeader">
                                <?= $resdata["name"] ?>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </section>
        <!-- end head-->

        <!-- Menu Bar-->
        <!--Menu Item-->
    <scetion id="menu">
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_order.php">
                    <button type="button" id="orders" class="btn btn-default" >
                        <span class="glyphicon glyphicon-align-left" aria-hidden="true" ></span>
                        <div class="hidden-xs">รายการสั่งซื้อ</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_today.php">
                    <button type="button" id="today" class="btn btn-default">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">วันนี้</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_menulist.php">
                    <button type="button" id="menulist" class="btn btn-default" >
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <div class="hidden-xs">รายการอาหาร</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_calendar.php">
                    <button type="button" id="calendar" class="btn btn-default" >
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        <div class="hidden-xs">ปฏิทิน</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_edit.php">
                    <button type="button" id="editres" class="btn btn-warning">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        <div class="hidden-xs">การตั้งค่า</div>
                    </button>
                </a>
            </div>
        </div>
    </scetion>
    <!--End Menu Item-->


    <section>
        <div class="container" style="margin-top: 50px;margin-bottom: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li >
                                    <a href="/view/res_restaurant_manage_edit.php" >ทั่วไป </a>
                                </li>
                                <li class="active">
                                    <a href="/view/res_restaurant_manage_order.php" > เกี่ยวกับรายการสั่งซื้อ</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_payment.php" >วิธีการชำระเงิน</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_messenger.php" > พนักงานจัดส่ง</a>
                                </li>
                            </ul>

                            <div class="tab-content">

                                <div class="tab-pane" id="tab_default_2"><!--รายการสั่งซื้อ-->
                                    <div class="page-header"style="margin-top: 20px;">
                                        <span style="font-size: 40px">เกี่ยวกับรายการสั่งซื้อของลูกค้า</span>
                                    </div>

                                    <div class="card">
                                        <div class="card-content">
                                            <span style="font-size: 35px;">ตั้งค่าทั่วไป</span>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="card card-content" id="showdata_foodbox">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            รูปแบบกล่อง
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a  href="#" id="editbtn">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <form id="dataform_edit_foodbox">
                                                            <?php
                                                            $foodboxRes = $con->query("SELECT food_box.id "
                                                                    . "FROM mapping_food_box "
                                                                    . "LEFT JOIN food_box ON food_box.id = mapping_food_box.food_box_id "
                                                                    . "WHERE mapping_food_box.restaurant_id = '$resid' ");

                                                            $boxRes = $con->query("SELECT food_box.id, food_box.description FROM food_box ");
                                                            while ($boxData = $boxRes->fetch_assoc()) {
                                                                ?>
                                                                <div class="input-group col-md-6" style="margin: 10px 120px;"  >
                                                                    <input type="checkbox" name="foodbox[]" value="<?= $boxData["id"] ?>"><?= $boxData["description"] ?>
                                                                </div>
                                                            <?php } ?>
                                                            <span class="input-group" style="margin-left: 250px;">
                                                                <button class="btn btn-success" id="savebtn" type="button">บันทึก</button>
                                                            </span>
                                                        </form>
                                                    </div>
                                                    <div class="card card-content" id="showdata_limitbox">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            จำนวนกล่องที่สามารถรับรายการสั่งซื้อได้สูงสุด/วัน
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a  href="#" id="editbtn">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <form id="dataform_edit_limitbox">
                                                            <div class="input-group col-md-6" style="margin: 10px 120px;"  >
                                                                <?php if ($resdata["amount_box_limit"] == "") { ?>
                                                                    <div class="input-group col-md-12" id="edit-minimumbox">
                                                                        <input type="number" class="form-control" id="minimumbox"  value="<?= $resdata["amount_box_limit"] ?>" placeholder="จำนวนกล่อง">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-success" id="savebtn" type="submit">บันทึก</button>
                                                                        </span>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div>
                                                                        <span style="font-size: 20px">จำนวนกล่อง: </span>
                                                                        <span style="font-size: 20px; color: orange;"><?= $resdata["amount_box_limit"] ?>&nbsp;</span>
                                                                        <span style="font-size: 20px">กล่อง</span><br>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div class="card card-content" id="showdata_minimumbox">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            จำนวนกล่องขั้นต่ำ/สั่งซื้อ
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a  href="#" id="editbtn">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <form id="dataform_edit_minimumbox">
                                                            <div class="input-group col-md-6" style="margin: 10px 120px;"  >
                                                                <?php if ($resdata["amount_box_minimum"] == "") { ?>
                                                                    <div class="input-group col-md-12" id="edit-minimumbox">
                                                                        <input type="number" class="form-control" id="minimumbox"  value="<?= $resdata["amount_box_minimum"] ?>" placeholder="จำนวนกล่อง">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-success" id="savebtn" type="submit">บันทึก</button>
                                                                        </span>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div>
                                                                        <span style="font-size: 20px">จำนวนกล่อง: </span>
                                                                        <span style="font-size: 20px; color: orange;"><?= $resdata["amount_box_minimum"] ?>&nbsp;</span>
                                                                        <span style="font-size: 20px">กล่อง</span><br>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card card-content" id="showdata_deliveryfee">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            กำหนดค่าจัดส่ง
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a  href="#" id="editbtn">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <form id="dataform_edit_deliveryfee">
                                                            <div class="input-group col-md-6" style="margin: 10px 120px;"  >
                                                                <div id="showdata">
                                                                    <span style="font-size: 20px"><?= $deliveryData["description"] ?>: </span>
                                                                    <span style="font-size: 20px; color: orange;"><?= ($deliveryData["deliveryfee"] == "" ? '&nbsp;-' : $deliveryData["deliveryfee"]) ?>&nbsp;</span>
                                                                    <span style="font-size: 20px">บาท</span><br>
                                                                </div>
                                                            </div>
                                                            <div class="input-group col-md-6" style="margin: 10px 120px; display: none" id="edit-deliveryfee">
                                                                <input type="text" class="form-control" id="deliveryfee"  value="<?= $deliveryData["deliveryfee"] ?>" placeholder="จำนวนกล่อง">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-success" id="savebtn" type="submit">บันทึก</button>
                                                                </span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- start footer -->
    <?php include '../template/footer.php'; ?>
    <!--<script src="/assets/bootstrap-fileinput-master/js/fileinput.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/fileinput.min.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/fileinput_locale_LANG.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/plugins/canvas-to-blob.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/plugins/canvas-to-blob.min.js"></script>-->

    <script>
        $(document).ready(function () {
            $(".btn-pref .btn").click(function () {
                $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
                $(".tab").addClass("active"); // instead of this do the below 
                $(this).removeClass("btn-default").addClass("btn-warning");
            });

            $('#imagerest').on('change', function (e) {
                var filename = $('#imagerest').val();
                var fname = filename.substring(12);
                var name = "File: " + fname;
                $("#uploadtext").html(name);
                $("#chooseimgbtn").hide();
                $("#uploadimgbtn").show();
            });

            $("#switchClose").click(function (e) {
                $.ajax({
                    type: "POST",
                    url: "/restaurant/edit-close-restaurant.php",
                    data: {"resId": $("#resIdvalue").val(),
                        "close": $("#switchClose").val()},
                    dataType: "json",
                    success: function (data) {
                        $("#switchClose").removeAttr("checked");
                        if (data.result == "1") {
                            $("#switchClose").attr("checked");
                            document.location.reload();
                        } else if (data.result == "0") {
                            $("#switchClose").removeAttr("checked");
                            $
                            //document.location.reload();
                        } else {
                            alert("ไม่สามารถบันทึกข้อมูลได้\nError : " + data.error);
                        }
                    }
                });
            });
        });
    </script>

    <!--maps--> 
    <script>
        // Primary function for the Geo location app
        function success(position) {
            // create a simple variable for the ID
            var s = document.querySelector('#geostatus');

            if (s.className == 'success') {
                return;
            }

            // Replaces text with new message
            s.innerHTML = "พบตำแหน่งของคุณแล้ว!";
            // Adds new class to the ID status block
            s.className = 'success';

            // creates map wrapper for responsiveness
            var mapwrapper = document.createElement('div');
            mapwrapper.className = 'mapwrapper';

            // creates the block element at sets the width and height
            var mapcanvas = document.createElement('div');
            // Adds ID to the new div
            mapcanvas.id = 'mapcanvas';

            // Adds the new block element as the last thing within the article block
            document.querySelector('.map').appendChild(mapwrapper);

            // Adds the new block element as the last thing within the mapwrapper block
            document.querySelector('.mapwrapper').appendChild(mapcanvas);


            // creates a new variable 'latlng' off of the google maps object
            var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            // create new variable that contains options in key:value pairs
            var myOptions = {
                zoom: 15,
                center: latlng,
                // ROADMAP is set by default, other options are HYBRID, SATELLITE and TERRAIN
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            // creates the new 'map' variable using the google object
            // then using the 'mapcanvas' ID appending the options
            var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

            // creates new 'marker' variable
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: "You are here! (at least within a " + position.coords.accuracy + " meter radius)"
            });
        }

        // Function that displays the error message
        function error(msg) {

            // sets simple variable to the status ID
            var s = document.querySelector('#geostatus');
            // designates typ eof message and passes in value                         s.innerHTML = typeof msg == 'string' ? msg : "ไม่สามารถค้นหาตำแหน่งได้";
            s.className = 'fail';
        }


        // statement that tests for device functionality
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, error);
        } else {
            error('not supported');
        }

        var mapwrapper = document.createElement('div');
        mapwrapper.className = 'mapwrapper';

    </script>
</body>
</html>
