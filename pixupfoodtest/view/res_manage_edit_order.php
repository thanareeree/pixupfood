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
        ?>
        <?php include '../template/restaurant-navbar.php'; ?>
        <form>
            <input type="hidden" id="resIdvalue" value="<?= $resid ?>">
        </form>
        <!-- start head -->
         <section id="RestaurantHeader">
            <div class="overlay">
                <div class="container text-center">
                    <h1><i class="glyphicon glyphicon-cutlery"></i>&nbsp;<?= $resdata["name"] ?></h1>
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
                                    <a href="/view/res_manage_edit_order.php" > เกี่ยวกับรายการสั่งซื้อ</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_payment.php" >วิธีการชำระเงิน</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_messenger.php" > พนักงานจัดส่ง</a>
                                </li>
                            </ul>

                            <div class="tab-content">

                                <div class="tab-pane active" id="tab_default_2"><!--รายการสั่งซื้อ-->
                                    <div class="page-header"style="margin-top: 20px;">
                                        <span style="font-size: 40px">เกี่ยวกับรายการสั่งซื้อของลูกค้า</span>
                                    </div>

                                    <div class="card">
                                        <div class="card-content">
                                            <span style="font-size: 35px;">ตั้งค่าทั่วไป</span>
                                            <div class="row">

                                                <div class="col-md-6">

                                                    <!--รูปแบบกล่อง-------------------------------------------->
                                                    <?php
                                                    $foodboxRes = $con->query("SELECT food_box.id, food_box.description "
                                                            . "FROM mapping_food_box "
                                                            . "LEFT JOIN food_box ON food_box.id = mapping_food_box.food_box_id "
                                                            . "WHERE mapping_food_box.restaurant_id = '$resid' ");

                                                    if ($foodboxRes->num_rows == null) {
                                                        ?>
                                                    
                                                        <div class="card card-content" >
                                                            <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                                รูปแบบกล่อง

                                                            </div>
                                                            <form  method="post" action="/restaurant/edit-foodbox-type.php">
                                                                <div class="row">
                                                                <?php
                                                                $boxRes = $con->query("SELECT food_box.id, food_box.description, img_path FROM food_box ");
                                                                while ($boxData = $boxRes->fetch_assoc()) {
                                                                    ?>
                                                                    
                                                                    <input type="hidden"name="restiddata"value="<?= $resid ?>">
                                                                    
                                                                    <div class="col-md-6">
                                                                        <div class="card">
                                                                            <div class="card-content">
                                                                                <img src="<?= $boxData["img_path"]?>" style="width: 100px; height: auto; margin-bottom: 10px; margin-left: 23%">
                                                                                <div class="card-action">
                                                                                    <input type="checkbox"  name="foodbox[]"  value=" <?= $boxData["id"] ?>"> <?= $boxData["description"] ?> 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                        
                                                                    
                                                                    
                                                                <?php } ?>
                                                                    </div>
                                                                
                                                                    <div class="row" style="margin-top: 20px;">
                                                                        <div class="col-md-12">
                                                                        <hr>
                                                                <span class="input-group">
                                                                    <button class="btn btn-success" id="savebtn" type="submit" style="margin-left: 390%">บันทึก</button>
                                                                </span>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        
                                                                 </div>   
                                                    
                                                    <?php } else { ?>
                                                        <div class="card card-content" id="showdata_foodbox">
                                                            <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                                รูปแบบกล่อง
                                                                <div class="pull-right">
                                                                    <p class="text-center">
                                                                        <a  class="btn icon-btn"id="editfoodboxbtn">
                                                                            <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                            <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                        </a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div id="dataform_foodbox">
                                                                <?php
                                                                while ($foodboxResData = $foodboxRes->fetch_assoc()) {
                                                                    ?>
                                                                    <div class="input-group col-md-6" style="margin: 10px 120px;" id="foodboxtypeShow" >
                                                                        <ul>
                                                                            <li style="font-size: 18px"> <?= $foodboxResData["description"] ?></li>
                                                                        </ul>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <!-- จำนวนกล่องสูงสุด -------------------->
                                                    <?php if ($resdata["amount_box_limit"] == "") { ?>
                                                        <div class="card card-content" id="showdata_limitbox">
                                                            <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                                จำนวนกล่องที่สามารถรับรายการสั่งซื้อได้สูงสุด/วัน

                                                            </div>
                                                            <form id="dataform_edit_limitbox" action="/restaurant/edit-amountbox-limit.php" method="post">
                                                                <div class="input-group col-md-6" style="margin: 10px 120px;"  >

                                                                    <div class="input-group col-md-12" id="edit-minimumbox">
                                                                        <input type="hidden"name="restiddata"value="<?= $resid ?>">
                                                                        <input type="number" class="form-control" required="" id="limitbox" name="limitbox"  placeholder="จำนวนกล่อง">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-success" id="savebtn" type="submit">บันทึก</button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    <?php } else { ?>
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
                                                                    <div>
                                                                        <span style="font-size: 20px">จำนวนกล่อง: </span>
                                                                        <span style="font-size: 20px; color: orange;"><?= $resdata["amount_box_limit"] ?>&nbsp;</span>
                                                                        <span style="font-size: 20px">กล่อง</span><br>
                                                                    </div>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    <?php } ?>

                                                    <!-- จำนวนกล่องขั้นต่ำ -------------------->
                                                    <?php if ($resdata["amount_box_minimum"] == "") { ?>
                                                        <div class="card card-content" id="showdata_minimumbox">
                                                            <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                                จำนวนกล่องขั้นต่ำ/รายการสั่งซื้อ
                                                                
                                                            </div>
                                                            <form id="dataform_edit_minimumbox" action="/restaurant/edit-minimum-box.php?resId=<?= $resid ?>" method="post">
                                                                <div class="input-group col-md-6" style="margin: 10px 120px;"  >

                                                                    <div class="input-group col-md-12" id="edit-minimumbox">
                                                                        <input type="number" class="form-control" id="minimumbox" required="" name="minimumbox" placeholder="จำนวนกล่อง">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-success" id="savebtn" type="submit">บันทึก</button>
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>

                                                    <?php } else { ?>
                                                        <div class="card card-content" id="showdata_limitbox">
                                                            <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                                จำนวนกล่องขั้นต่ำ/รายการสั่งซื้อ
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
                                                                    <div>
                                                                        <span style="font-size: 20px">จำนวนกล่อง: </span>
                                                                        <span style="font-size: 20px; color: orange;"><?= $resdata["amount_box_minimum"] ?>&nbsp;</span>
                                                                        <span style="font-size: 20px">กล่อง</span><br>
                                                                    </div>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                                <!------ ค่าจัดส่งข ----->
                                                <div class="col-md-6">
                                                    
                                                    
                                                    <?php
                                                    $deliveryRes = $con->query("SELECT delivery_type.id, delivery_type.description, "
                                                            . "mapping_delivery_type.deliveryfee "
                                                            . "FROM restaurant "
                                                            . "LEFT JOIN mapping_delivery_type ON mapping_delivery_type.restaurant_id = restaurant.id "
                                                            . "LEFT JOIN delivery_type ON delivery_type.id = mapping_delivery_type.delivery_type_id "
                                                            . "WHERE restaurant.id = '$resid' ");
                                                    $deliveryData = $deliveryRes->fetch_assoc();
                                                    if ($deliveryData["deliveryfee"] == null) {
                                                        ?>
                                                        <div class="card card-content" id="showdata_deliveryfee">
                                                            <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                                กำหนดค่าจัดส่ง
                                                            </div>
                                                            <form id="dataform_edit_deliveryfee" method="post" action="/restaurant/edit-deliveryfee.php?resId=<?=$resid?>">
                                                                    <div class="input-group col-md-6" style="margin: 10px 120px;" id="edit-deliveryfee">
                                                                        <input type="text" class="form-control" id="deliveryfee" name="deliveryfee" placeholder="จำนวนกล่อง">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-success" id="savebtn" type="submit">บันทึก</button>
                                                                        </span>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="card card-content" id="showdata_deliveryfee">
                                                                <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                                    ค่าจัดส่ง
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
                                                                            <span style="font-size: 20px; color: orange;">&nbsp;<?= $deliveryData["deliveryfee"] ?>&nbsp;</span>
                                                                            <span style="font-size: 20px">บาท</span><br>

                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        <?php } ?>

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

            $("#editfoodboxbtn").on("click", function (e) {
                $("#foodboxtypeEdit").show();

            });


        });
    </script>

</body>
</html>
