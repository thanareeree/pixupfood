<?php
include '../api/islogin.php';
include '../dbconn.php';
?>




<html>
    <head>
        <title>Pixupfood - Restaurant Menu Management</title>

        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/res_restaurant_manage.css">
        <style>
            .card .card-image img {
                border-radius: 2px 2px 0 0;
                background-clip: padding-box;
                z-index: -1;
                width: 100%;
                max-width: 100%;
                height: 156px;
            }


        </style>
    </head>
    <body>
        <?php
        $resid = $_SESSION["restdata"]["id"];
        $result = $con->query("select * from restaurant where id = '$resid' ");
        $resdata = $result->fetch_assoc();
        ?>
        <?php include '../template/restaurant-navbar.php'; ?>
        <form>
            <input type="hidden" id="residValue" value="<?= $resid ?>">
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
                    <button type="button" id="menulist" class="btn btn-warning" >
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
                    <button type="button" id="editres" class="btn btn-default">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        <div class="hidden-xs">การตั้งค่า</div>
                    </button>
                </a>
            </div>
        </div>
    </scetion>
    <!--End Menu Item-->


    <!-- รายการอาหาร -->
    <div class="tab-pane fade in" id="tab4">
        <div class="container" style="margin-top: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="/view/res_restaurant_manage_menulist.php" >รายการอาหารปัจจุบัน </a>  
                                </li>
                                <li>
                                    <a href="/view//res_manage_menu_close.php" >รายการอาหารที่หมดชั่วคราว </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1_4">
                                    <div class="page-header">
                                        <div class="row">
                                            <div class="col-md-8"><h2>รายการอาหารปัจจุบัน</h2></div>

                                            <div class="col-md-2">
                                                <p class="text-center pull-" style="margin-top: 20px; margin-left: 200px ">
                                                    <a class="btn icon-btn btn-success" id="addbtn">
                                                        <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success">
                                                        </span> เพิ่มใหม่</a>
                                                    <a class="btn icon-btn btn-danger" id="closebtn" style="display: none">
                                                        <span class="glyphicon btn-glyphicon glyphicon-triangle-top img-circle text-warning">
                                                        </span>ปิด</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!--- Add Menu-->
                                    <div class="row" id="addMenuForm" style="display: none">
                                       
                                      
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-content"> 
                                                        <h3 style="margin-bottom: 40px">เพิ่มเมนูของร้าน</h3>
                                                        <form action="/restaurant/menu-add.php" method="post" id="addMenuRes">
                                                            <div>
                                                                <span style="font-size: 18px;"> หมวดหมู่ </span>&nbsp;
                                                                <select style="width: 150px;font-size: 18px;" id="select_type" name="select_type" required="">
                                                                    <option value="0">--ตัวเลือก--</option>
                                                                    <option value="ชนิดข้าว">ชนิดข้าว</option>
                                                                    <option value="กับข้าว">กับข้าว</option>
                                                                    <option value="อาหารจานเดียว">อาหารจานเดียว</option>

                                                                </select>
                                                                <span style="margin-left: 25px;font-size: 18px;" id="type" > ชื่อรายการอาหาร </span>&nbsp;&nbsp;
                                                                <select class="riceList" name="riceList" id="riceList"style="width: 150px; font-size: 18px; " >
                                                                    <option value="0">--ตัวเลือก--</option>
                                                                    <?php
                                                                    $riceRes = $con->query("SELECT DISTINCT  main_menu.id, main_menu.name "
                                                                            . "FROM main_menu"
                                                                            . " LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                            . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                            . "WHERE main_menu.type = 'ชนิดข้าว'"
                                                                            . "ORDER BY main_menu.name");
                                                                    while ($riceData = $riceRes->fetch_assoc()) {
                                                                        ?>
                                                                        <option value="<?= $riceData['id'] ?>"> <?= $riceData['name'] ?> </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <select class="menuList" name="menuList" id="menuList"style="width: 150px; font-size: 18px; display: none"  >
                                                                    <option value="0">--ตัวเลือก--</option>
                                                                    <?php
                                                                    $riceRes = $con->query("SELECT DISTINCT main_menu.id, main_menu.name "
                                                                            . "FROM main_menu"
                                                                            . " LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                            . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                            . "WHERE main_menu.type = 'กับข้าว'"
                                                                            . "ORDER BY main_menu.name");
                                                                    while ($riceData = $riceRes->fetch_assoc()) {
                                                                        ?>
                                                                        <option value="<?= $riceData['id'] ?>"> <?= $riceData['name'] ?> </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <select class="singleMenu" name="singleMenu" id="singleMenu"style="width: 150px; font-size: 18px;display: none " >
                                                                    <option value="0">--ตัวเลือก--</option>
                                                                    <?php
                                                                    $riceRes = $con->query("SELECT DISTINCT main_menu.id, main_menu.name "
                                                                            . "FROM main_menu"
                                                                            . " LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                            . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                            . "WHERE main_menu.type = 'อาหารจานเดียว'"
                                                                            . "ORDER BY main_menu.name");
                                                                    while ($riceData = $riceRes->fetch_assoc()) {
                                                                        ?>
                                                                        <option value="<?= $riceData['id'] ?>"> <?= $riceData['name'] ?> </option>
                                                                    <?php } ?>
                                                                </select>

                                                                <span style="margin-left: 25px;font-size: 18px;" id="type"  > ราคา </span>&nbsp;&nbsp;
                                                                <input type="text"  id="priceinput" style="font-size: 18px;" required="">

                                                                <button type="submit" class="btn btn-success" style="margin-left: 25px;" id="savebtn"><i class="glyphicon glyphicon-plus"></i></button>
                                                                <span style="color: red" id="showerror"></span>
                                                                <!--<span id="uploadtext" ></span>
                                                                <p align="center" ><button type="button" name="img" value="อัพโหลด" onClick="imagesnewmenu.click()" onMouseOut="uploadtext.value = imagesnewmenu.value" class="btn btn-primary btn-block" style="font-style:normal">เลือกรูป</button></p>
                                                                <br><span id="showselectmenu"></span>-->
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="display: none" id="addNewMenuForm">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-content"> 
                                                        <h3>เพิ่มชื่อเมนูใหม่</h3>
                                                        <form action="/restaurant/" method="post" id="addNewMenu">
                                                            <div class="row" style="margin-left: 25px;margin-top: 50px;">
                                                                <span style="font-size: 18px;"> หมวดหมู่ </span>&nbsp;
                                                                <select style="width: 150px;font-size: 18px;" id="typefood-add">
                                                                    <option value="0">--ตัวเลือก--</option>
                                                                    <option value="ชนิดข้าว">ชนิดข้าว</option>
                                                                    <option value="กับข้าว">กับข้าว</option>
                                                                    <option value="อาหารจานเดียว">อาหารจานเดียว</option>

                                                                </select>
                                                                <span style="margin-left: 25px;font-size: 18px;" id="typeselect"> หมวดหมู่ </span>&nbsp;&nbsp;
                                                                <select class="foodtypelist" name="foodtypelist" style="width: 150px;  margin-left: 5px;font-size: 18px">
                                                                    <option>--ตัวเลือก--</option>
                                                                    <?php
                                                                    $res1 = $con->query("SELECT * FROM `food_type`");
                                                                    while ($data1 = $res1->fetch_assoc()) {
                                                                        ?>
                                                                        <option value="<?= $data1['id'] ?>"> <?= $data1['description'] ?> </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="margin-left: 24px;font-size: 18px;"> ชื่ออาหาร </span> 
                                                                &nbsp;<input type="text" style="font-size: 18px;" id="foodname">
                                                                <button type="submit" class="btn btn-success" style="margin-left: 25px;" id="addNewMenubtn"><i class="glyphicon glyphicon-plus"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- จบค้นหา -->


                                    <!-- ค้นหา -->
                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="col-md-12" style="margin-bottom: 50px">
                                                        <h2>ค้นหา</h2>
                                                        <form action="#" method="post" >
                                                            <input type="hidden" name="restaurantid" id="restaurantid" value="<?= $resid; ?>" >
                                                            <div class="col-md-6">

                                                                <div class="input-group">
                                                                    <input type="text" class="form-control input-lg" id="searchtext" placeholder="ชื่อรายการอาหาร">
                                                                    <span class="input-group-btn ">
                                                                        <button class="btn btn-default input-lg" type="button" id="searchbyname"><i class="glyphicon glyphicon-search"></i></button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- Menu 1 Row -->
                                                    <div class="row" id="showmenudata">


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- จบค้นหา -->

                                    <!-- ชนิดข้าว -->

                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <h2>ขนิดข้าว</h2>
                                                    <!-- Menu 1 Row -->
                                                    <div class="row">
                                                        <?php
                                                        $resid = $_SESSION["restdata"]["id"];
                                                        $res2 = $con->query("SELECT DISTINCT restaurant.id,menu.img_path, menu.price, menu.id as menuResId, menu.status, "
                                                                . "main_menu.name as menuname, restaurant.name as resname "
                                                                . "FROM restaurant "
                                                                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                                                                . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                                . "left JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                . "left JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                . "WHERE restaurant.id = '$resid' and main_menu.type = 'ชนิดข้าว'");
                                                        while ($data2 = $res2->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="card">
                                                                    <div class="maxheight">
                                                                        <div class="card-image" >
                                                                            <img src="<?= ($data2["img_path"] == "") ? '/assets/images/default-img360.png' : $data2["img_path"] ?>" >
                                                                        </div>
                                                                        <div class="card-content height">
                                                                            <div class="product-name"><?= $data2["menuname"] ?></div>
                                                                            <div class="product-price"><?= $data2["price"] ?>&nbsp;บาท</div>
                                                                        </div>

                                                                        <div class="card-action" style="margin-top: -10px">
                                                                            <div class="row col-md-12" >
                                                                                <div class="col-md-3 pull-left">
                                                                                    <p class="text-center">
                                                                                        <a class="btn icon-btn btn-primary" data-toggle="modal" data-target='#EditMenu<?= $data2["menuResId"] ?>'>
                                                                                            <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-warning">
                                                                                            </span> แก้ไข</a></p>
                                                                                </div>
                                                                                <div class="col-md-4"></div>
                                                                                <div class="col-md-3 pull-left">
                                                                                    <p class="text-center">
                                                                                        <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#'>
                                                                                            <span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-warning">
                                                                                            </span> ลบทิ้ง</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- จบชนิดข้าว -->

                                    <!-- เริ่มรายการกับข้าว -->
                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <h2>รายการกับข้าว</h2>
                                                    <!-- Menu 1 Row -->
                                                    <div class="row">
                                                        <?php
                                                        $resid = $_SESSION["restdata"]["id"];
                                                        $res2 = $con->query("SELECT DISTINCT restaurant.id,menu.img_path, menu.price, menu.id as menuResId, menu.status, "
                                                                . "main_menu.name as menuname, restaurant.name as resname "
                                                                . "FROM restaurant "
                                                                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                                                                . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                                . "left JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                . "left JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                . "WHERE restaurant.id = '$resid' and main_menu.type = 'กับข้าว'");

                                                        while ($data2 = $res2->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="card">
                                                                    <div class="maxheight">
                                                                        <div class="card-image">
                                                                            <img src="<?= ($data2["img_path"] == "") ? '/assets/images/default-img360.png' : $data2["img_path"] ?>" >
                                                                        </div>
                                                                        <div class="card-content height">
                                                                            <div class="product-name"><?= $data2["menuname"] ?></div>
                                                                            <div class="product-price"><?= $data2["price"] ?>&nbsp;บาท</div>
                                                                        </div>

                                                                        <div class="card-action" style="margin-top: -10px">
                                                                            <div class="row col-md-12" >
                                                                                <div class="col-md-3 pull-left">
                                                                                    <p class="text-center">
                                                                                        <a class="btn icon-btn btn-primary editmenubtn" id="editbtn<?= $data2["menuResId"] ?>" data-toggle="modal" data-target='#EditMenu<?= $data2["menuResId"] ?>'>
                                                                                            <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-warning">
                                                                                            </span> แก้ไข</a></p>
                                                                                </div>
                                                                                <div class="col-md-4"></div>
                                                                                <div class="col-md-3 pull-left">
                                                                                    <p class="text-center">
                                                                                        <a class="btn icon-btn btn-danger deletemenubtn" id="deletebtn<?= $data2["menuResId"] ?>" data-toggle="modal" data-target='#'>
                                                                                            <span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-warning">
                                                                                            </span> ลบทิ้ง</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- จบรายการกับข้าว-->

                                    <!-- อาหารจานด่วน -->
                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <h2>อาหารจานเดียว</h2>
                                                    <!-- Menu 1 Row-->
                                                    <div class="row">
                                                        <?php
                                                        $resid = $_SESSION["restdata"]["id"];
                                                        $res2 = $con->query("SELECT DISTINCT restaurant.id,menu.img_path, menu.price, menu.id as menuResId, menu.status, "
                                                                . "main_menu.name as menuname, restaurant.name as resname "
                                                                . "FROM restaurant "
                                                                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                                                                . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                                . "left JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                . "left JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                . "WHERE restaurant.id = '$resid' and main_menu.type = 'อาหารจานเดียว'");
                                                        while ($data2 = $res2->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="card">
                                                                    <div class="maxheight">
                                                                        <div class="card-image">
                                                                            <img src="<?= ($data2["img_path"] == "") ? '/assets/images/default-img360.png' : $data2["img_path"] ?>">
                                                                        </div>
                                                                        <div class="card-content height">
                                                                            <div class="product-name"><?= $data2["menuname"] ?></div>
                                                                            <div class="product-price"><?= $data2["price"] ?>&nbsp;บาท</div>
                                                                        </div>

                                                                        <div class="card-action" style="margin-top: -10px">
                                                                            <div class="row col-md-12" >
                                                                                <div class="col-md-3 pull-left">
                                                                                    <p class="text-center">
                                                                                        <a class="btn icon-btn btn-primary" data-toggle="modal" data-target='#EditMenu<?= $data2["menuResId"] ?>'>
                                                                                            <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-warning">
                                                                                            </span> แก้ไข</a></p>
                                                                                </div>
                                                                                <div class="col-md-4"></div>
                                                                                <div class="col-md-3 pull-left">
                                                                                    <p class="text-center">
                                                                                        <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#'>
                                                                                            <span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-warning">
                                                                                            </span> ลบทิ้ง</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- จบรายการอาหารจานด่วน-->


                                    <!-- Modal แก้ไขเมนู ------------------------------------------------------------------------------>
                                    <!--EditMenu Modal-->

                                    <?php
                                    $resid = $_SESSION["restdata"]["id"];
                                    $res2 = $con->query("SELECT DISTINCT restaurant.id,menu.img_path, menu.price, menu.id as menuResId, menu.status, "
                                            . "main_menu.name as menuname, restaurant.name as resname "
                                            . "FROM restaurant "
                                            . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                                            . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                            . "left JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                            . "left JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                            . "WHERE restaurant.id = '$resid' ");
                                    while ($data2 = $res2->fetch_assoc()) {
                                        ?>
                                        <div class="modal fade" id="EditMenu<?= $data2["menuResId"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="/restaurant/menu-edit-image.php?menuresid=<?= $data2["menuResId"] ?>" method="post"  enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row" style="margin: 0px;">
                                                                <div class="card">
                                                                    <div class="card-action">
                                                                        <div class="page-header" style="font-size:18px;margin-top: 0px;">
                                                                            รูปภาพ
                                                                        </div> 
                                                                        <div class="row">
                                                                            <div class="col-md-6"> 
                                                                                <div class="thumbnails">
                                                                                    <div class="span4">
                                                                                        <div class="thumbnail">
                                                                                                <!-- <input type="file" name="img"> --->
                                                                                            <img src="<?= ($data2["img_path"] == "") ? '/assets/images/default-img360.png' : $data2["img_path"] ?>" alt="ALT NAME">
                                                                                        </div>                                                                                    
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6" style="margin-top: 60px;"> 
                                                                                <span id="uploadtext" ></span>
                                                                                <p align="center" ><button type="button" name="img" id="chooseimgbtn"  onClick="imagerest.click()" onMouseOut="uploadtext.value = imagerest.value" class="btn btn-primary btn-block" style="font-style:normal">เลือกรูป</button></p>
                                                                                <input type="file" id="imagerest" name="imagerest" style="display:none" accept="image/jpeg,image/pjpeg,image/png"  />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row" style="margin:15px -15px;">
                                                                    <div class="col-md-12">
                                                                        <div class="card" style="margin-top: 1px;">
                                                                            <div class="card-action">
                                                                                <div class="page-header" style="font-size:18px;margin-top: 0px;">
                                                                                    ทั่วไป
                                                                                </div>
                                                                                <div class="row" style="margin:10px 0 0 5px;">
                                                                                    <span style="margin-left: 25px;"> ราคาอาหาร </span> &nbsp;<input type="text" name="newPrice" value="<?= $data2["price"] ?>">&nbsp; บาท 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="card" style="margin-top: 1px;">
                                                                        <div class="card-action">
                                                                            <div class="page-header" style="font-size:18px;margin-top: 0px;">สถานะ</div>


                                                                            <div class="material-switch ">
                                                                                <span style="margin-left: 33px;"> สินค้าหมด </span> &nbsp;
                                                                                <input id="closeMenu<?= $data2["menuResId"] ?>" name="closeMenu" type="checkbox" <?= ($data2["status"] == 0 ? 'checked' : '') ?>/>
                                                                                <label for="closeMenu<?= $data2["menuResId"] ?>" class="label-success"></label>
                                                                                &nbsp; <span>มีสินค้า</span>
                                                                            </div>
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
                                    <?php } ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Tab เมนูอาหาร -->


    <!-- start footer -->
    <?php include '../template/footer.php'; ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#addbtn").on("click", function (e) {
                $("#addMenuForm").show();
                $("#addNewMenuForm").show();
                $("#addbtn").hide();
                $("#closebtn").show();
            });
            $("#closebtn").on("click", function (e) {
                $("#addMenuForm").hide();
                $("#addNewMenuForm").hide();
                $("#addbtn").show();
                $("#closebtn").hide();
                document.location.reload();
            });



            $('#imagesnewmenu').on('change', function (e) {
                var filename = $('#imagesnewmenu').val();
                var fname = filename.substring(12);
                var name = "File: " + fname;
                $("#uploadtext").html(name);
            });



            $('#select_type').on('change', function (e) {
                $("#type").show();
                if ($("#select_type").val() == 'ชนิดข้าว') {
                    $("#riceList").show();
                    $("#menuList").hide();
                    $("#singleMenu").hide();
                    $("#menusetList").hide();
                    $("#riceList").attr("required");
                } else if ($("#select_type").val() == 'กับข้าว') {
                    $("#riceList").hide();
                    $("#menuList").show();
                    $("#singleMenu").hide();
                    $("#menusetList").hide();
                    $("#menuList").attr("required");
                } else if ($("#select_type").val() == 'อาหารจานเดียว') {
                    $("#riceList").hide();
                    $("#menuList").hide();
                    $("#singleMenu").show();
                    $("#menusetList").hide();
                    $("#singleMenu").attr("required");
                } else {
                    $("#riceList").hide();
                    $("#menuList").hide();
                    $("#singleMenu").hide();
                    $("#menusetList").hide();
                }

            });

            $("#typefood-add").on("change", function (e) {
                if ($("#typefood-add").val() == "ชนิดข้าว") {
                    $("#typeselect").hide();
                    $(".foodtypelist").hide();
                } else {
                    $("#typeselect").show();
                    $(".foodtypelist").show();
                }
            });

            $("#addMenuRes").on("submit", function (e) {
                var menuid = $("#menuList").val();
                var riceid = $("#riceList").val();
                var singleid = $("#singleMenu").val();
                var menusetid = $("#menusetList").val();
                var price = $("#priceinput").val();
                var resid = $("#residValue").val();
                $("#showerror").html("");
                $("#savabtn").attr("disabled");
                $("#savabtn").html("<img src='/assets/images/loader.gif' style='height:15px; margin:0 auto;'>");
                $.ajax({
                    url: "/restaurant/menu-add.php",
                    type: "POST",
                    data: {"menuid": menuid, "riceid": riceid, "singleid": singleid, "menusetid": menuid, "price": price, "resid": resid},
                    dataType: "json",
                    success: function (data) {
                        $("#savebtn").removeAttr("disabled");
                        if (data.result == 1) { //สำเร็จ
                            $("#addMenuRes").trigger("reset");
                        } else {

                        }
                    }
                });
                e.preventDefault();

                return false;
            });


            $("#ryhryryu").on("submit", function (e) {
                var type = $("#typefood-add").val();
                var foodtype = $(".foodtypelist").val();
                var foodname = $("#foodname").val();

                $("#show_error").html("");
                $("#addNewMenubtn").attr("disabled");

                $.ajax({
                    url: "/restaurant/menu-add.php",
                    type: "post",
                    data: {"menuid": menuid, "riceid": riceid, "singleid": singleid, "menusetid": menuid},
                    dataType: "json",
                    success: function (data) {
                        $("#savebtn").removeAttr("disabled");
                        if (data.result == 1) { //สำเร็จ

                        } else {

                        }
                    }
                });
            });

            $("#searchtext").on("keyup", function (e) {
                if (e.keyCode == 13) {
                    $("#searchbyname").click();
                }
            });


            $("#searchtext").on("keyup", function (e) {
                var searchmenuname = $("#searchtext").val();
                var resid = $("#restaurantid").val();

                $.ajax({
                    url: "/restaurant/menu-searchbyname.php",
                    type: "POST",
                    dataType: "html",
                    data: {"resid": resid, "searchname": searchmenuname},
                    success: function (data, textStatus, jqXHR) {
                        $("#show").html(data);
                    }
                });
            });

            $('#searchtext').on('blur', function (e) {
                 $('#searchtext').val("");
                $("#showmenudata").html("");
            });
            /*
            $("#searchNewMenu").on("keyup", function (e) {
                if (e.keyCode == 13) {
                    $("#searchAddBtn").click();
                }
            });
            
              $("#searchNewMenu").on("keyup", function (e) {
                var searchmenuname = $("#searchNewMenu").val();
                var resid = $("#resid").val();

                $.ajax({
                    url: "/restaurant/menu-search-add-menu.php",
                    type: "POST",
                    dataType: "html",
                    data: {"resid": resid, "searchname": searchmenuname},
                    success: function (data, textStatus, jqXHR) {
                        $("#showdatamenu").html(data);
                    }
                });
            });*/
            
            /*$("#searchtext").(function (e){
             $("#showmenudata").remove();
             });*/

            $('input[type=file]').on('change', function (e) {
                var filename = $('.imagerest').val();
                var fname = filename.substring(12);
                var name = "File: " + fname;
                $("#uploadtext").html(name);
            });

            $("input[type=checkbox]").click(function (e) {
                if ($(this).is(":checked")) {
                    $(this).value("1");
                } else {
                    $(this).value("0");
                }
            });




        });
    </script>


</body>
</html>
