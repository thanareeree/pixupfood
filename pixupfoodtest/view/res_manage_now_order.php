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
                                        <li >
                                            <a href="/view/res_restaurant_manage_order.php" >รายการสั่งซื้อใหม่ </a>
                                        </li>
                                        <li class="active">
                                            <a href="/view/res_manage_now_order.php" >รายการสั่งซื้ออยู่ระหว่างการดำเนินการ </a>
                                        </li>
                                        <li>
                                            <a href="/view/res_manage_history_order.php" >รายการสั่งซื้อเสร็จสมบูรณ์ </a>
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
                                                    <div class="page-header" style="font-size: 30px; margin-top: 5px">รายการสั่งซื้อแบบสั่งด่วน 
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
                                                            <table class="table table-list-search  table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ลำดับ</th>
                                                                        <th>เลขที่รายการ</th>
                                                                        <th>ชื่อลูกค้า</th>
                                                                        <th class="text-center">รายการอาหาร</th>
                                                                        <th class="text-center">จำนวน(ชุด)</th>
                                                                        <th class="text-center">วัน/เวลาที่ลูกค้านัดรับ</th>
                                                                        <th class="text-center">สถานะ</th>
                                                                        <th class="text-center">รายละเอียด</th>
                                                                        <th class="text-center">เปลี่ยนสถานะ</th>
                                                                        <th class="text-center">หมายเหตุ</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="table  table-hover" id="showdataNowFastOrder">

                                                                </tbody>
                                                            </table>   
                                                        </div>
                                                    </div>
                                                    <!-- จบตารางรายการอยู่ระหว่างดำเนินการ -->


                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header" style="font-size: 30px; margin-top: 5px">รายการสั่งซื้อแบบปกติ 
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
                                                                    <input class="form-control" id="system-search2" name="q" placeholder="ค้นหาข้อมูลในตารางนี้" required>
                                                                    <span class="input-group-btn">
                                                                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table class="table  table-hover table-list-search2">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ลำดับ</th>
                                                                        <th>เลขที่รายการ</th>
                                                                        <th>ชื่อลูกค้า</th>
                                                                        <th class="text-center">รายการอาหาร</th>
                                                                        <th class="text-center">จำนวน(ชุด)</th>
                                                                        <th class="text-center">วัน/เวลาที่ลูกค้านัดรับ</th>
                                                                        <th class="text-center">สถานะ</th>
                                                                        <th class="text-center">รายละเอียด</th>
                                                                        <th class="text-center">เปลี่ยนสถานะ</th>
                                                                        <th class="text-center">หมายเหตุ</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="table " id="showdataNowNormalOrder">

                                                                </tbody>
                                                            </table>   
                                                        </div>
                                                    </div>
                                                    <!-- จบตารางรายการอยู่ระหว่างดำเนินการ -->


                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Tab 2 -->

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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Detail --> 




                                        <!-- รูปสลิป -->
                                        <div class="modal fade pop-up-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-2" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <span class="modal-title" id="myLargeModalLabel-2" style="font-size: 30px">สลิปประกอบรายการเลขที่</span>  <span style="font-size: 30px; color: orange"> 102458</span>
                                                    </div>
                                                    <div class="modal-body">           
                                                        <span style="font-size: 15px; color: red;">ยอดเงินที่ปรากฎในระบบเป็นเพียงการคำนวณจากเงื่อนไขต่างๆในระบบอาจไม่ใช่ยอดเงินจริง กรุณาตรวจสอบข้อมูลภายในสลิปอีกครั้ง อย่างไรก็ตามหากพบปัญหากรุณาติดต่อ </span>  
                                                        <a href="#" data-toggle="modal" data-target='#text' style="color: blue;" >support@pixupfood.com </a> 
                                                        <hr>
                                                        <span style="font-size: 20px"> โอนเงินมัดจำผ่านธนาคาร: </span>
                                                        <span style="font-size: 15px; color: orange;"> กสิกรไทย เลขที่ 12-1231212-1</span>  <br> 
                                                        <span style="font-size: 20px"> จำนวนเงิน:</span> <span style="font-size: 15px; color: orange;">400.00 บาท</span>  <br>
                                                        <span style="font-size: 20px"> วัน/เวลาที่ระบบบันทึกสลิป:</span> <span style="font-size: 15px; color: orange;">12-10-2015 14:30</span>  <br>
                                                        <hr>
                                                        <img src="/assets/images/slip03.jpg" class="img-responsive img-rounded center-block" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- จบรูปสลิบ -->
                                        <div class="modal fade" id="text" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel"><div style="font-size: 30px;">รายงาน</div></span>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span style="font-size: 15px;">ส่งถึง: support@pixupfood.com </span><br>
                                                        <span style="font-size: 15px;">เรื่อง: สลิปประกอบรายการเลขที่ 102458 </span>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-12">

                                                                <textarea name="message" placeholder="พิมพ์ข้อความของคุณที่นี่..." rows="5" style=" width: 100%"></textarea>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                        <button type="button" class="btn btn-primary" >ส่ง</button>

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

    <script src="/assets/js/manage_now_order.js"></script>


</body>
</html>