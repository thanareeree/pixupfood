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
        <link rel="stylesheet" href="/assets/css/check-radio.css">




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
                        <div class="hidden-xs">ตารางการจัดส่งสินค้า</div>
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
                                    <a href="/view/res_manage_edit_deliveryplace.php" >พื้นที่จัดส่งสินค้า</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_messenger.php" > พนักงานจัดส่ง</a>
                                </li>
                                <li >
                                    <a href="/view/res_manage_edit_promotion.php" >โปรโมชั่น</a>
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
                                                                                    <img src="<?= $boxData["img_path"] ?>" style="width: 100px; height: auto; margin-bottom: 10px; margin-left: 23%">
                                                                                    <div class="card-action">
                                                                                        <div class="text-center">
                                                                                            <span style="font-size: 16px; font-weight: bold"><?= $boxData["description"] ?> </span>
                                                                                        </div>
                                                                                        <label class="Form-label--tick" style="margin-bottom: -10px;margin-left: 60px; margin-top: 20px">
                                                                                              <input type="checkbox" class=" Form-label-checkbox"  name="foodbox[]"  value=" <?= $boxData["id"] ?>"> 
                                                                                            <span class="Form-label-text" ></span>
                                                                                        </label>
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
                                                                        <a id="editfoodboxbtn">
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
                                                        <div class="card card-content" id="editFoodbox" style="display: none">
                                                            <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                                แก้ไขรูปแบบกล่อง
                                                            </div>
                                                            <div id="dataform_foodbox">
                                                                <form method="post" action="/restaurant-setting/edit-foodbox.php">
                                                                    <?php
                                                                    $box = $con->query("SELECT food_box.id, food_box.description, img_path FROM food_box ");

                                                                    while ($boxDataType = $box->fetch_assoc()) {
                                                                        $boxid = $boxDataType["id"];
                                                                        $resfoodboxRes = $con->query("SELECT food_box.id, food_box.description "
                                                                                . "FROM mapping_food_box "
                                                                                . "LEFT JOIN food_box ON food_box.id = mapping_food_box.food_box_id "
                                                                                . "WHERE mapping_food_box.restaurant_id = '$resid' and mapping_food_box.food_box_id = '$boxid' "
                                                                                . "order by mapping_food_box.food_box_id ");
                                                                        if ($resfoodboxRes->num_rows > 0) {
                                                                            ?>
                                                                            <div class="col-md-6">
                                                                                <div class="card">
                                                                                    <div class="card-content">
                                                                                        <img src="<?= $boxDataType["img_path"] ?>" style="width: 100px; height: auto; margin-bottom: 10px; margin-left: 23%">
                                                                                        <div class="card-action">
                                                                                            <div class="text-center">
                                                                                                <span style="font-size: 16px; font-weight: bold"><?= $boxDataType["description"] ?> </span>
                                                                                            </div>
                                                                                            <label class="Form-label--tick" style="margin-bottom: -10px;margin-left: 60px; margin-top: 20px">
                                                                                                <input type="checkbox" class=" Form-label-checkbox"   name="foodbox[]" checked=""  value=" <?= $boxid ?>">
                                                                                                <span class="Form-label-text" ></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <div class="col-md-6">
                                                                                <div class="card">
                                                                                    <div class="card-content">
                                                                                        <img src="<?= $boxDataType["img_path"] ?>" style="width: 100px; height: auto; margin-bottom: 10px; margin-left: 23%">
                                                                                        <div class="card-action">
                                                                                            <div class="text-center">
                                                                                                <span style="font-size: 16px; font-weight: bold"><?= $boxDataType["description"] ?> </span>
                                                                                            </div>
                                                                                            <label class="Form-label--tick" style="margin-bottom: -10px;margin-left: 60px; margin-top: 20px">
                                                                                                <input type="checkbox" class=" Form-label-checkbox"   name="foodbox[]"  value=" <?= $boxid ?>">
                                                                                                <span class="Form-label-text" ></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <button type="submit" class="btn btn-success" style="margin-left: 220px;margin-top: 30px" >บันทึก</button>
                                                                </form> 
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
                                                                        <a data-toggle="modal" data-target="#limitModal">
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
                                                                        <a data-toggle="modal" data-target="#minimumModal">
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
                                                            <form id="dataform_edit_deliveryfee" method="post" action="/restaurant/edit-deliveryfee.php?resId=<?= $resid ?>">
                                                                <div class="input-group col-md-6" style="margin: 10px 120px;" id="edit-deliveryfee">
                                                                    <input type="text" class="form-control" id="deliveryfee" name="deliveryfee" placeholder="ค่าจัดส่ง">
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
                                                                        <a data-toggle="modal" data-target="#deliveryfeeModal">
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
    <div class="modal fade" id="boxtypeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px">รูปแบบกล่อง</div></span>
                </div>
                <form action="/restaurant-setting/edit-deliveryfee.php" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="margin-bottom: 15px;">
                                    <label class="col-sm-2 control-label" for="textinput">ค่าจัดส่ง</label>
                                    <div class="col-sm-10" style="margin-bottom: 15px;">
                                        <input type="text" placeholder="โทรศัพท์" class="form-control"  name="newfee" required="" value="<?= $deliveryData["deliveryfee"] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="limitModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px">จำนวนกล่องที่สามารถรับรายการสั่งซื้อได้สูงสุด/วัน</div></span>
                </div>
                <form action="/restaurant-setting/edit-limitbox.php" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="margin-bottom: 15px;">
                                    <label class="col-sm-2 control-label" for="textinput">จำนวนกล่อง</label>
                                    <div class="col-sm-10" style="margin-bottom: 15px;">
                                        <input type="text" placeholder="โทรศัพท์" class="form-control"  name="limitbox" required="" value="<?= $resdata["amount_box_limit"] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="minimumModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px">จำนวนกล่องขั้นต่ำ/รายการสั่งซื้อ</div></span>
                </div>
                <form action="/restaurant-setting/edit-minimumbox.php" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="margin-bottom: 15px;">
                                    <label class="col-sm-2 control-label" for="textinput">จำนวนกล่อง</label>
                                    <div class="col-sm-10" style="margin-bottom: 15px;">
                                        <input type="text" placeholder="โทรศัพท์" class="form-control" name="minimumbox" required="" value="<?= $resdata["amount_box_minimum"] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deliveryfeeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px">ค่าจัดส่ง</div></span>
                </div>
                <form action="/restaurant-setting/edit-deliveryfee.php" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="margin-bottom: 15px;">
                                    <label class="col-sm-2 control-label" for="textinput">ค่าจัดส่ง</label>
                                    <div class="col-sm-10" style="margin-bottom: 15px;">
                                        <input type="text" placeholder="โทรศัพท์" class="form-control"  name="newfee" required="" value="<?= $deliveryData["deliveryfee"] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- start footer -->
    <?php include '../template/footer.php'; ?>
    <!--<script src="/assets/bootstrap-fileinput-master/js/fileinput.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/fileinput.min.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/fileinput_locale_LANG.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/plugins/canvas-to-blob.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/plugins/canvas-to-blob.min.js"></script>-->

    <script src="/assets/js/res_manage_edit_order.js"></script>

</body>
</html>
