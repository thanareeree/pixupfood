<?php
include '../api/islogin.php';
include '../view/navbar.php';
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
        <link rel="stylesheet" href="/assets/css/datatables.css">
    </head>
    <body>
        <?php
        $resid = $_SESSION["restdata"]["id"];
        $result = $con->query("select * from restaurant where id = '$resid' ");
        $resdata = $result->fetch_assoc();
        ?>
        <?php include '../template/restaurant-navbar.php'; ?>

        <!-- start profile -->
        <section id="RestaurantHeader">
            <div class="overlay">
                <div class="container text-center">
                    <h1><i class="glyphicon glyphicon-cutlery"></i>&nbsp;<?= $resdata["name"] ?></h1>
                </div>
            </div>
        </section>

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
                                        <li >
                                            <a href="/view/res_restaurant_manage_order.php" >รายการสั่งซื้อใหม่ </a>
                                        </li>
                                        <li class="active">
                                            <a href="/view/res_manage_now_order.php" >รายการสั่งซื้ออยู่ระหว่างการดำเนินการ </a>
                                        </li>
                                        <li>
                                            <a href="/view/res_manage_history_order.php" >รายการสั่งซื้อเสร็จสมบูรณ์ </a>
                                        </li>
                                        <li >
                                            <a href="/view/res_manage_ignore_order.php" >รายการที่ปฏิเสธหรือยกเลิกเเล้ว </a>
                                        </li>
                                    </ul>
                                    <!-- Tab 1 -->
                                    <div class="tab-content">

                                        <!-- Tab รายการอยู่ระหว่างดำเนินการ -->
                                        <div class="tab-pane active" id="tab_default_2_2">
                                            <div class="page-header" style="font-size: 40px; margin-top: 5px">
                                                รายการสั่งซื้ออยู่ระหว่างดำเนินการ   
                                            </div>
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header" style="font-size: 30px; margin-top: 5px"> สถานะของรายการสั่งซื้อ  
                                                        <div style="margin-top: 10px; margin-bottom: 20px" class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                                                            <div class="btn-group" role="group">
                                                                <button type="button" id="allbtn" class="btn btn-warning" >ทั้งหมด</button>
                                                            </div>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" id="prepaybtn" class="btn btn-default" >รอค่ามัดจำ</button>
                                                            </div>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" id="inbtn" class="btn btn-default">เตรียมวัตถุดิบ</button>
                                                            </div>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" id="diffpaybtn" class="btn btn-default">บรรจุสินค้า</button>
                                                            </div>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" id="delibtn" class="btn btn-default" >เตรียมจัดส่ง</button>
                                                            </div>
                                                        </div>
                                                        <div class="pull-right">
                                                            <p class="text-center">
                                                                <span style="font-size: 20px; color: red"></span></p>
                                                        </div>
                                                    </div>
                                                    <!-- ตารางรายการอยู่ระหว่างดำเนินการ -->
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
                                                            <table class="table table-list-search fixed  table-hover" id="nowtable">
                                                                <thead>
                                                                    <tr>
                                                                        <!--<th>ลำดับ</th>-->
                                                                        <th>หมายเลขคำสั่งซื้อ</th>
                                                                       <!-- <th class="text-center">รายการอาหาร</th>-->
                                                                        <th class="text-center">จำนวน(ชุด)</th>
                                                                        <th>ที่อยู่จัดส่ง</th>
                                                                        <th class="text-center">วัน/เวลาที่ลูกค้านัดรับ</th>
                                                                        <th class="text-center">สถานะ</th>
                                                                        <th class="text-center">รายละเอียด</th>
                                                                        <th class="text-center">เปลี่ยนสถานะ</th>


                                                                    </tr>
                                                                </thead>
                                                                <tbody class="table  table-hover" id="showdataNowFastOrder">

                                                                </tbody>
                                                                <tbody class="table  table-hover" id="showdataNowTypeOrder" style="display: none">

                                                                </tbody>
                                                            </table>   
                                                        </div>
                                                    </div>
                                                    <!-- จบตารางรายการอยู่ระหว่างดำเนินการ -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Tab 2 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Detial fasttt   -->
    <div class="modal fade  bs-example-modal-lg" id="detailFastOrderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <span class="modal-title" id="myModalLabel">
                        <span style="font-size: 30px; margin-top: 5px;">รายละเอียดของคำสั่งซื้อหมายเลข: </span>
                        <span style="font-size: 30px; margin-top: 5px; color: orange" id="showFastOrderId"> </span>     
                    </span>
                </div>
                <div id="fastOrderViewBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
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
                        <span style="font-size: 30px; margin-top: 5px;">รายละเอียดของคำสั่งซื้อหมายเลข: </span>
                        <span style="font-size: 30px; margin-top: 5px; color: orange" id="showOrderId"> </span>     
                    </span>
                </div>
                <div id="normalOrderViewBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Detail --> 
    <!-- errorModal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px;">เตือน!&nbsp;</div></span>
                </div>
                <div class="modal-body ">
                    <div class="alert alert-danger" role="alert">
                        <span style="font-size: 20px;" id="errorMessage"> </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <!-- messengerNormalModal -->
    <div class="modal fade" id="messengerNormalModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="myModalLabel"><div style="font-size: 20px;font-weight: bold; margin-top: 5px;">กรุณาเลือกพนักงานจัดส่ง&nbsp;<span id="messNormalId"></span></div></span>
                </div>
                <div class="modal-body ">
                    <div>
                        <select class="form-control messengerselect"id="messengerselect" required="">
                            <?php
                            $res = $con->query("select * from messenger where restaurant_id = '$resid'");
                            if ($res->num_rows == 0) {
                                ?>
                                <option value="0">ไม่มีข้อมูล</option>
                                <?php
                            } else {
                                while ($data = $res->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $data["id"] ?>"><?= $data["username"] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <div style="margin-top: 20px" >
                            <table class="table table-list-search fixed  table-hover" id="nowtable">
                                <thead>
                                    <tr>
                                        <!--<th>ลำดับ</th>-->
                                        <th>หมายเลขคำสั่งซื้อ</th>
                                        <th>ที่อยู่จัดส่ง</th>
                                        <th class="text-center">วัน/เวลาที่ลูกค้านัดรับ</th>
                                    </tr>
                                </thead>
                                <tbody class="table  table-hover messenData" id="messenData">


                                </tbody>
                            </table>   
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="savemessengerNormal" >บันทึก</button>
                </div>
            </div>
        </div>
    </div>

    <!-- messengerFastModal -->
    <div class="modal fade" id="messengerFastModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px;">กรุณาเลือกพนักงานจัดส่ง&nbsp;<span id="messFastId"></span></div></span>
                </div>
                <div class="modal-body ">
                    <div>
                        <select class="form-control messengerselect"id="messengerselect" required="">
                            <?php
                            $res = $con->query("select * from messenger where restaurant_id = '$resid'");
                            if ($res->num_rows == 0) {
                                ?>
                                <option value="0">ไม่มีข้อมูล</option>
                                <?php
                            } else {
                                while ($data = $res->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $data["id"] ?>"><?= $data["username"] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <div style="margin-top: 20px" >
                            <table class="table table-list-search fixed  table-hover" id="nowtable">
                                <thead>
                                    <tr>
                                        <!--<th>ลำดับ</th>-->
                                        <th>หมายเลขคำสั่งซื้อ</th>
                                        <th>ที่อยู่จัดส่ง</th>
                                        <th class="text-center">วัน/เวลาที่ลูกค้านัดรับ</th>
                                    </tr>
                                </thead>
                                <tbody class="table  table-hover messenData" id="messenFastData">

                                </tbody>
                            </table>   
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="savemessengerFast" >บันทึก</button>
                </div>
            </div>
        </div>
    </div>



    <!-- start footer -->
    <?php include '../template/footer.php'; ?>

    <!-- ตารางรายการออเดอร์ -->
    <script src="/assets/js/OrderSearch.js"></script>
    <script src="/assets/js/manage_now_order.js"></script>
    <script src="/assets/js/dataTables.js"></script>
</body>
</html>