<?php
include '../api/islogin.php';
include '../dbconn.php';
?>


<html>
    <head>
        <title>Pixupfood - Restaurant Order Management</title>

        <?php
        include '../template/customer-title.php';
        ?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/res_restaurant_manage.css">
        <link rel="stylesheet" href="/assets/css/normal_order.css">
        <link href="/restaurant-order/request_order/modal-request.php"

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
        <input type="hidden" id="residValue" value="<?= $resid ?>">
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
                    <button type="button" id="orders" class="btn btn-warning" >
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
                    <button type="button" id="editres" class="btn btn-default">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        <div class="hidden-xs">การตั้งค่า</div>
                    </button>
                </a>
            </div>
        </div>
    </scetion>
    <!--End Menu Item-->


    <div class="well white">
        <div class="tab-content">
            <!-- Start Content in Order List--> 
            <div class="tab-pane fade in active" id="tab2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabbable-panel">
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs ">
                                        <li class="active">
                                            <a href="/view/res_restaurant_manage_order.php" >รายการสั่งซื้อใหม่ </a>
                                        </li>
                                        <li>
                                            <a href="/view/res_manage_now_order.php" >รายการสั่งซื้ออยู่ระหว่างการดำเนินการ </a>
                                        </li>
                                        <li>
                                            <a href="/view/res_manage_history_order.php" >รายการสั่งซื้อเสร็จสมบูรณ์ </a>
                                        </li>
                                    </ul>
                                    <!-- Tab 1 -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_default_1_2">
                                            <div class="page-header" style="font-size: 40px; margin-top: 5px">
                                                รายการสั่งซื้อใหม่  
                                                <div class="pull-right">
                                                    <p class="text-center">
                                                        <span style="font-size: 20px; color: orange"><span class="countall"></span> รายการใหม่ <span style="font-size: 20px; color: black">|</span> <span style="font-size: 20px; color: red"><span class="countfast"></span> รายการด่วน</span></p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header" style="font-size: 30px; margin-top: 5px">รายการใหม่<span style="color: red; font-size: 30px; "> (ด่วน)</span> 
                                                        <div class="pull-right">
                                                            <p class="text-center">
                                                                <span style="font-size: 20px; color: red"><span class="countfast"></span> รายการด่วน</span></p>
                                                        </div>
                                                    </div>
                                                    <!-- ตารางรายการด่วน -->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <form action="#" method="get">
                                                                <div class="input-group">
                                                                    <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                                                    <input class="form-control" id="system-search" name="q" placeholder="ค้นหาข้อมูลในตารางนี้" required>
                                                                    <span class="input-group-btn">
                                                                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table class="table table-list-search table-hover">
                                                                <thead>
                                                                    <tr >
                                                                        <th>ลำดับ</th>
                                                                        <th>เลขที่รายการ</th>
                                                                        <th>ชื่อลูกค้า</th>
                                                                        <th>รายการอาหาร</th>
                                                                        <th>จำนวน(ขุด)</th>
                                                                        <th>วัน/เวลาที่ลูกค้านัดรับ</th>
                                                                        <th>เวลาที่เหลือ</th>
                                                                        <th>รายละเอียด</th>
                                                                        <th>รับรายการ</th>
                                                                        <th>ปฏิเสธรายการ</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="table table-condensed table-hover" id="showdataFastOrder">


                                                                </tbody>
                                                            </table>   
                                                        </div>
                                                    </div>
                                                    <!-- จบตารางรายการด่วน -->
                                                </div>
                                            </div>


                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header" style="font-size: 30px; margin-top: 5px">รายการใหม่
                                                        <div class="pull-right">
                                                            <p class="text-center">
                                                                <span style="font-size: 20px;"><span class="countnormal"></span> รายการ</span>
                                                            </p>
                                                        </div>

                                                        <!-- ตารางรายการใหม่ -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="#" method="get">
                                                                    <div class="input-group">
                                                                        <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                                                        <input class="form-control" id="system-search2" name="q" placeholder="ค้นหาข้อมูลในตารางนี้" required>
                                                                        <span class="input-group-btn">
                                                                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <table class="table table-list-search2 table-hover">
                                                                    <thead >
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>เลขที่รายการ</th>
                                                                            <th>ชื่อลูกค้า</th>
                                                                            <th>รายการอาหาร</th>
                                                                            <th>จำนวน(ชุด)</th>
                                                                            <th>วัน/เวลาที่ลูกค้านัดรับ</th>
                                                                            <th>เวลาที่เหลือ(ชั่วโมง)</th>
                                                                            <th>รายละเอียด</th>
                                                                            <th>รับรายการ</th>
                                                                            <th>ปฏิเสธรายการ</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table table-condensed table-hover" id="showdataNormalOrder">

                                                                    </tbody>
                                                                </table>   
                                                            </div>
                                                        </div>
                                                        <!-- จบตารางรายการใหม่ -->
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>


                                        <!-- modal ตารางนะยูวว  -->
                                        <!-- ignore normal-->
                                        <div class="modal fade" id="ignoreNormalOrderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px;">ปฏิเสธรายการหมายเลข:&nbsp;<span id="ignoreNormalId"></span></div></span>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <div class="alert alert-danger" role="alert">
                                                            <span style="font-size: 20px;">ต้องการปฏิเสธรายการ ? </span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        <button type="button" class="btn btn-danger" id="ignoreNormalBtn">ยืนยัน</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End ignore --> 
                                        
                                           <!-- ignore fasttttttttttttttttttttttt -->
                                        <div class="modal fade" id="ignoreFastOrderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px; color: red">เตือน!!<span id="ignoreFastId"></span></div></span>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span style="font-size: 20px;">ต้องการปฏิเสธรายการ ? </span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        <button type="button" class="btn btn-danger" id="ignoreFastBtn">ยืนยัน</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End ignore --> 

                                        <!-- accept fastttttt -->
                                        <div class="modal fade" id="acceptFastOrderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px; ">รับรายการหมายเลข:&nbsp;<span id="acceptFastId" style="color: orange;"></span></div></span>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span style="font-size: 20px;">ต้องการยอมรับรายการ ? </span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        <button type="button" class="btn btn-success" id="acceptFastBtn">ยืนยัน</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End accept --> 
                                        
                                          <!-- accept normallllllllll -->
                                        <div class="modal fade" id="acceptNormalOrderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px; ">รับรายการหมายเลข:&nbsp;<span id="acceptNormalId" style="color: orange;"></span></div></span>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span style="font-size: 20px;">ต้องการยอมรับรายการ ? </span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        <button type="button" class="btn btn-success" id="acceptNormalBtn">ยืนยัน</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End accept --> 

                                        <!-- Detial fasttt   -->
                                        <div class="modal fade" id="detailFastOrderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel">
                                                            <span style="font-size: 30px; margin-top: 5px;">รายละเอียดของรายการหมายเลข: </span>
                                                            <span style="font-size: 30px; margin-top: 5px; color: orange" id="showFastOrderId"> </span>     
                                                        </span>
                                                    </div>
                                                    <div id="fastOrderViewBody">

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        <button type="button" class="btn btn-danger" id="ignoreFastOrderBtn" >ปฏิเสธรายการ</button>
                                                        <button type="button" class="btn btn-success" id="acceptFastOrderBtn" >ยอมรับรายการ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Detail --> 
                                        
                                          <!-- Detial normal -->
                                        <div class="modal fade bs-example-modal-lg" id="detailNormalOrderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel">
                                                            <span style="font-size: 30px; margin-top: 5px;">รายละเอียดของรายการหมายเลข: </span>
                                                            <span style="font-size: 30px; margin-top: 5px; color: orange" id="showOrderId"> </span>     
                                                        </span>
                                                    </div>
                                                    <div id="normalOrderViewBody">

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                        <button type="button" class="btn btn-danger" id="ignoreNormalOrderBtn" >ปฏิเสธรายการ</button>
                                                        <button type="button" class="btn btn-success" id="acceptFastOrderBtn" >ยอมรับรายการ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Detail --> 

                                        <!-- จบ modal ตารางนะยูวว -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- start footer -->
    <?php include '../template/footer.php'; ?>
    <!-- ตารางรายการออเดอร์ -->
    <script src="/assets/js/OrderSearch.js"></script>
  <!--  <script src="/assets/js/ui-bootstrap-tpls-0.13.4.min.js"></script>-->
    <script src="/assets/js/manage_order.js"></script>
</body>
</html>