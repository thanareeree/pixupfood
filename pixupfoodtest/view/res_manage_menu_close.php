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
                                <li>
                                    <a href="/view/res_restaurant_manage_menulist.php" >รายการอาหารปัจจุบัน </a>  
                                </li>
                                <li  class="active" >
                                    <a href="/view/res_manage_menu_close.php" >รายการอาหารที่หมดชั่วคราว </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                
                                <!-- รายการอาหารที่หมดชั่วคราว -->

                                <div class="tab-pane active" id="tab_default_2_4">
                                    <div class="page-header">
                                        <div class="row">
                                            <div class="col-md-6"><h2>รายการอาหารที่หมดชั่วคราว</h2></div>
                                            <div class="col-md-3"><p class="text-center" style="width: 0px;height: 0px;margin-left: 437px;margin-top: 20px;">
                                                
                                            </div>
                                        </div>
                                    </div>
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
                                                                . "main_menu.name as menuname, restaurant.name as resname, main_menu.img_path as img "
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
                                                                . "main_menu.name as menuname, restaurant.name as resname, main_menu.img_path as img "
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
       
                                </div>
                                <!-- จบแทบ รายการอาหารที่หมดชั่วคราว -->
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
            


            $("#searchtext").on("keyup", function (e) {
                if (e.keyCode == 13) {
                    $("#searchbyname").click();
                }
            });


            $("#searchbyname").on("click", function (e) {
                var searchmenuname = $("#searchtext").val();
                var resid = $("#restaurantid").val();

                $.ajax({
                    url: "/restaurant/menu-searchbyname.php",
                    type: "POST",
                    dataType: "html",
                    data: {"resid": resid, "searchname": searchmenuname},
                    success: function (data, textStatus, jqXHR) {
                        $("#showmenudata").html(data);
                    }
                });
            });



        });
    </script>


</body>
</html>
