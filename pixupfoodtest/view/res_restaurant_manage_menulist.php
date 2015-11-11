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
        <link rel="stylesheet" href="/assets/css/bootstrap-toggle.min.css">
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
                        <div class="hidden-xs">ตารางการจัดส่งสินค้า</div>
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
                                            <div class="col-md-8"><h2>
                                                    รายการอาหารปัจจุบัน ทั้งหมด&nbsp;
                                                    <?php
                                                    $res = $con->query("SELECT COUNT(id) as menu FROM `menu` WHERE restaurant_id = '$resid' GROUP BY restaurant_id");
                                                    $data = $res->fetch_assoc();
                                                    if ($res->num_rows == 0) {
                                                        echo "0&nbsp;รายการ";
                                                    } else {
                                                        echo $data["menu"] . "&nbsp;รายการ";
                                                    }
                                                    ?>
                                                </h2></div>

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

                                            <div class="card">
                                                <div class="card-content"> 
                                                    <h3 style="margin-bottom: 20px">เพิ่มรายการอาหารใหม่ (เลือกจากส่วนกลาง)</h3>
                                                    <hr>
                                                    <form action="/restaurant/menu-add.php" method="post" id="addMenuRes">

                                                        <div class="row" style="margin-left: 140px">
                                                            <span style="font-size: 18px;"> หมวดหมู่ </span>&nbsp;
                                                            <select style="width: 150px;font-size: 18px;" id="select_type" name="select_type" required="">
                                                                <option value="0">--ตัวเลือก--</option>
                                                                <option value="ชนิดข้าว">ชนิดข้าว</option>
                                                                <option value="กับข้าว">กับข้าว</option>
                                                                <option value="อาหารจานเดียว">อาหารจานเดียว</option>
                                                                <option value="ขนม">ขนม</option>
                                                                <option value="เครื่องดื่ม">เครื่องดื่ม</option>

                                                            </select>
                                                            <span style="margin-left: 25px;font-size: 18px;" id="type" > ชื่อรายการอาหาร </span>&nbsp;&nbsp;
                                                            <select class="riceList" name="riceList" id="riceList"style="width: 150px; font-size: 18px; " >
                                                                <option value="0">--ตัวเลือก--</option>
                                                                <?php
                                                                $riceRes = $con->query("SELECT DISTINCT  main_menu.id, main_menu.name "
                                                                        . "FROM main_menu"
                                                                        . " LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                        . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                        . "WHERE main_menu.type = 'ชนิดข้าว' "
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
                                                            <select class="snackList" name="snackList" id="snackList"style="width: 150px; font-size: 18px;display: none " >
                                                                <option value="0">--ตัวเลือก--</option>
                                                                <?php
                                                                $snackRes = $con->query("SELECT DISTINCT main_menu.id, main_menu.name "
                                                                        . "FROM main_menu"
                                                                        . " LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                        . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                        . "WHERE main_menu.type = 'ขนม'"
                                                                        . "ORDER BY main_menu.name");
                                                                while ($snackData = $snackRes->fetch_assoc()) {
                                                                    ?>
                                                                    <option value="<?= $snackData['id'] ?>"> <?= $snackData['name'] ?> </option>
                                                                <?php } ?>
                                                            </select>
                                                            <select class="drinkList" name="drinkList" id="drinkList"style="width: 150px; font-size: 18px;display: none " >
                                                                <option value="0">--ตัวเลือก--</option>
                                                                <?php
                                                                $drinkRes = $con->query("SELECT DISTINCT main_menu.id, main_menu.name "
                                                                        . "FROM main_menu"
                                                                        . " LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                        . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                        . "WHERE main_menu.type = 'เครื่องดื่ม'"
                                                                        . "ORDER BY main_menu.name");
                                                                while ($drinkData = $drinkRes->fetch_assoc()) {
                                                                    ?>
                                                                    <option value="<?= $drinkData['id'] ?>"> <?= $drinkData['name'] ?> </option>
                                                                <?php } ?>
                                                            </select>

                                                            <span style="margin-left: 25px;font-size: 18px;" id="type"  > ราคา </span>&nbsp;&nbsp;
                                                            <input type="text"  id="priceinput" style="font-size: 18px;" required="">

                                                            <div id="duplicateMenu" ></div>
                                                        </div>

                                                    </form>
                                                    <div class="card-action">
                                                        <div class="col-md-10"> </div>
                                                        <div class="col-md-2" style="padding-right: 0px;padding-left: 45px;">
                                                            <button type="submit" class="btn btn-success" style="margin-left: 25px;width: 100;" id="savebtn"><i class="glyphicon glyphicon-plus"></i></button>
                                                            <span style="color: red" id="showerror"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                 

                                            </div>
                                        </div>

                                        <div class="col-md-12" style="display: none" id="addNewMenuForm">
                                            <div class="card">
                                                <form action="/restaurant/menu-add-old.php" method="post" id="addNewMenu" enctype="multipart/form-data" style="margin-left: 100px;">
                                                    <div class="card-content">
                                                        <h3 style="margin-bottom: 20px">เพิ่มรายการอาหารใหม่ที่ไม่มีอยู่ในส่วนกลาง*</h3>
                                                        <hr>
                                                        <h5 style="margin-bottom: 20px; color: red">*รายการอาหารที่เพิ่มใหม่จะถูกบันทึกไปยังฐานข้อมูลเพื่อเก็บเป็นรายการอาหารของส่วนกลาง</h5>

                                                        <div class="row" style="margin-bottom: 20px">

                                                            <div class="col-md-6">
                                                                <div class="card">
                                                                    <div class="card-content"> 
                                                                        <h3> ระบุรายละเอียด </h3>
                                                                        <hr>

                                                                        <div class="row" style="margin-left: 25px;margin-top: 50px; margin-top: 20px;">
                                                                            <span style="font-size: 18px;"> หมวดหมู่ </span>&nbsp;
                                                                            <select required="" style="width: 150px;font-size: 18px;" id="typefood-add" name="typefood-add">
                                                                                <option value="0">--ตัวเลือก--</option>
                                                                                <option value="ชนิดข้าว">ชนิดข้าว</option>
                                                                                <option value="กับข้าว">กับข้าว</option>
                                                                                <option value="อาหารจานเดียว">อาหารจานเดียว</option>
                                                                                <option value="ขนม">ขนม</option>
                                                                                <option value="เครื่องดื่ม">เครื่องดื่ม</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="row" style="margin-left: 25px;margin-top: 50px; margin-top: 20px;">

                                                                            <span style="font-size: 18px;" id="typeselect" > หมวดหมู่ </span>&nbsp;
                                                                            <select class="foodtypelist" name="foodtypelist" required="" style="width: 150px;  font-size: 18px">
                                                                                <option>--ตัวเลือก--</option>
                                                                                <?php
                                                                                $res1 = $con->query("SELECT * FROM `food_type`");
                                                                                while ($data1 = $res1->fetch_assoc()) {
                                                                                    ?>
                                                                                    <option value="<?= $data1['id'] ?>"> <?= $data1['description'] ?> </option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="row" style="margin-left: 25px;margin-top: 50px; margin-top: 20px;">

                                                                            <span style="font-size: 18px;"> ชื่อ </span> 
                                                                            &nbsp;<input type="text" style="font-size: 18px;" id="foodname" name="foodname"  required="" placeholder="ระบุชื่ออาหาร">
                                                                        </div>
                                                                         <h3> เลือกรูปภาพอาหาร </h3>
                                                                        <hr>
                                                                        <div id="updateImg" style="" >
                                                                            <input type="file" id="imagerest" name="imagerest"  accept="image/jpeg,image/pjpeg,image/png" required="" />
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="card">
                                                                    <div class="card-content">
                                                                        <h3> ระบุราคาของเมนูนี้ </h3>
                                                                        <hr>
                                                                        <br>
                                                                        <div style="width: 300px;margin-left: 80px">
                                                                            <input type="text" class="form-control" placeholder="ระบุราคาของเมนูนี้" id="priceMainMenu" name="priceMainMenu" required="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="card-action">
                                                            <div class="row">
                                                                <div class="col-md-10"></div>
                                                                <div class="col-md-2" style="padding-right: 0px;padding-left: 45px;">
                                                                    <button type="submit" class="btn btn-success" style="width: 100;" id="addNewMenubtn"><i class="glyphicon glyphicon-plus"></i></button>
                                                                </div>

                                                            </div>
                                                        </div> 
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>




                                    <!-- ค้นหา -->
                                    <div class="row" style="display: none">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="col-md-12" style="margin-bottom: 50px">
                                                        <div class="col-md-12">
                                                            <h2>ค้นหา </h2>
                                                        </div>
                                                        <input type="hidden" name="restaurantid" id="restaurantid" value="<?= $resid; ?>" >
                                                        <div class="col-md-11">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control input-lg" id="searchtext" placeholder="ชื่อรายการอาหาร">
                                                                <span class="input-group-btn ">
                                                                    <button class="btn btn-default input-lg" type="button" id="searchbyname"><i class="glyphicon glyphicon-search"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p>
                                                                <a class="btn icon-btn btn-danger" id="close-searchbtn" style="display: none">
                                                                    <span class="glyphicon btn-glyphicon glyphicon-triangle-top img-circle text-warning">
                                                                    </span>ปิด</a>
                                                            </p>
                                                        </div>


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
                                                                . "main_menu.name as menuname, restaurant.name as resname, main_menu.img_path as img "
                                                                . "FROM restaurant "
                                                                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                                                                . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                                . "left JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                . "left JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                . "WHERE restaurant.id = '$resid' and main_menu.type = 'ชนิดข้าว' and menu.status = 0");
                                                        while ($data2 = $res2->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="card">
                                                                    <div class="maxheight">
                                                                        <div class="card-image" >
                                                                            <img src="<?= ($data2["img_path"] == "") ? $data2["img"] : $data2["img_path"] ?>" >
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
                                                                                        <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#deleteMenu<?= $data2["menuResId"] ?>'>
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
                                                                . "main_menu.name as menuname, restaurant.name as resname, main_menu.img_path as img "
                                                                . "FROM restaurant "
                                                                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                                                                . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                                . "left JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                . "left JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                . "WHERE restaurant.id = '$resid' and main_menu.type = 'กับข้าว' and menu.status = 0");

                                                        while ($data2 = $res2->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="card">
                                                                    <div class="maxheight">
                                                                        <div class="card-image">
                                                                            <img src="<?= ($data2["img_path"] == "") ? $data2["img"] : $data2["img_path"] ?>" >
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
                                                                                        <a class="btn icon-btn btn-danger deletemenubtn" id="deletebtn<?= $data2["menuResId"] ?>" data-toggle="modal" data-target='#deleteMenu<?= $data2["menuResId"] ?>'>
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
                                                                . "main_menu.name as menuname, restaurant.name as resname, main_menu.img_path as img "
                                                                . "FROM restaurant "
                                                                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                                                                . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                                . "left JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                . "left JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                . "WHERE restaurant.id = '$resid' and main_menu.type = 'อาหารจานเดียว' and menu.status = 0");
                                                        while ($data2 = $res2->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="card">
                                                                    <div class="maxheight">
                                                                        <div class="card-image">
                                                                            <img src="<?= ($data2["img_path"] == "") ? $data2["img"] : $data2["img_path"] ?>">
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
                                                                                        <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#deleteMenu<?= $data2["menuResId"] ?>'>
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
                                                                                            <img src="<?= ($data2["img_path"] == "") ? '/assets/images/default-img360.png' : $data2["img_path"] ?>" alt="ALT NAME" style="height: 160px">
                                                                                        </div>                                                                                    
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6" style="margin-top: 60px;"> 
                                                                                <input type="file" id="imagerest" name="imagerest"  accept="image/jpeg,image/pjpeg,image/png"  />
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
                                                                                    <div class="col-md-6">
                                                                                        <div class="row" style="margin-left: 5px">
                                                                                            <span > ราคาอาหาร </span> &nbsp;<input type="text" style="width: 37%"name="newPrice" value="<?= $data2["price"] ?>">&nbsp; บาท 
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6" style="padding-left: 0px;padding-right: 10px;">
                                                                    <div class="card" style="margin-top: 1px;">
                                                                        <div class="card-action">
                                                                            <div class="page-header" style="font-size:18px;margin-top: 0px;">สถานะ </div>
                                                                            <div>
                                                                                <input type="checkbox" name="closeMenu[]" value="<?= ($data2["status"] == 0 ? '1' : '0') ?>" data-toggle="toggle" id=" closeMenu<?= $data2["menuResId"] ?>"  data-on="มีสินค้า" <?= ($data2["status"] == 0 ? 'checked' : '') ?> data-off="หมด" data-onstyle="success" data-offstyle="danger">
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

                                        <!-- modal delete -->
                                        <div class="modal fade" id="deleteMenu<?= $data2["menuResId"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="/restaurant/menu-delete.php?menuresid=<?= $data2["menuResId"] ?>" method="post" >
                                                        <div class="modal-body">
                                                            ต้องการลบข้อมูล ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                            <button type="submit" class="btn btn-danger">ยืนยัน</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>

                                    <!-- ขนม-->
                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <h2>ขนม</h2>
                                                    <!-- Menu 1 Row-->
                                                    <div class="row">
                                                        <?php
                                                        $resid = $_SESSION["restdata"]["id"];
                                                        $res2 = $con->query("SELECT DISTINCT restaurant.id,menu.img_path, menu.price, menu.id as menuResId, menu.status, "
                                                                . "main_menu.name as menuname, restaurant.name as resname, main_menu.img_path as img "
                                                                . "FROM restaurant "
                                                                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                                                                . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                                . "left JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                . "left JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                . "WHERE restaurant.id = '$resid' and main_menu.type = 'ขนม' and menu.status = 0");
                                                        while ($data2 = $res2->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="card">
                                                                    <div class="maxheight">
                                                                        <div class="card-image">
                                                                            <img src="<?= ($data2["img_path"] == "") ? $data2["img"] : $data2["img_path"] ?>">
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
                                                                                        <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#deleteMenu<?= $data2["menuResId"] ?>'>
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

                                    <!-- จบขนม -->

                                    <!-- เครื่องดื่ม -->
                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <h2>เครื่องดื่ม</h2>
                                                    <!-- Menu 1 Row-->
                                                    <div class="row">
                                                        <?php
                                                        $resid = $_SESSION["restdata"]["id"];
                                                        $res2 = $con->query("SELECT DISTINCT restaurant.id,menu.img_path, menu.price, menu.id as menuResId, menu.status, "
                                                                . "main_menu.name as menuname, restaurant.name as resname, main_menu.img_path as img "
                                                                . "FROM restaurant "
                                                                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                                                                . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                                . "left JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                . "left JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                . "WHERE restaurant.id = '$resid' and main_menu.type = 'เครื่องดื่ม' and menu.status = 0");
                                                        while ($data2 = $res2->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="card">
                                                                    <div class="maxheight">
                                                                        <div class="card-image">
                                                                            <img src="<?= ($data2["img_path"] == "") ? $data2["img"] : $data2["img_path"] ?>">
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
                                                                                        <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#deleteMenu<?= $data2["menuResId"] ?>'>
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
    <script src="/assets/js/bootstrap-toggle.min.js"></script>
    <script type="text/javascript" src="/assets/js/restaurant-menu.js"></script>


</body>
</html>
