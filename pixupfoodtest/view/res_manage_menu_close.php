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

                                    <!-- ค้นหา -->
                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <!-- Menu 1 Row -->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="/assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>
                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>
                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3" style="left: 13px;">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-success" data-toggle="modal" data-target='#'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-retweet img-circle text-success"> </span> 
                                                                                    เปิดการจำหน่าย
                                                                                </a>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="/assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>
                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>

                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>
                                                                    </div>
                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3" style="left: 13px;">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-success" data-toggle="modal" data-target='#'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-retweet img-circle text-success"> </span>
                                                                                        เปิดการจำหน่าย
                                                                                    </a>
                                                                                </p>
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
