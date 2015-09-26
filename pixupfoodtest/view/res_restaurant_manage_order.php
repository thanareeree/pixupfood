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
                                                        <span style="font-size: 20px; color: orange">2 รายการใหม่ <span style="font-size: 20px; color: black">|</span> <span style="font-size: 20px; color: red">1 รายการด่วน</span></p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header" style="font-size: 30px; margin-top: 5px">รายการใหม่<span style="color: red; font-size: 30px; "> (ด่วน)</span> 
                                                        <div class="pull-right">
                                                            <p class="text-center">
                                                                <span style="font-size: 20px; color: red">1 รายการด่วน</span></p>
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
                                                            <table class="table table-list-search">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ลำดับ</th>
                                                                        <th>เลขที่รายการ</th>
                                                                        <th>ชื่อลูกค้า</th>
                                                                        <th>ชนิดอาหาร</th>
                                                                        <th>จำนวน(ขุด)</th>
                                                                        <th>วัน/เวลาที่ลูกค้านัดรับ</th>
                                                                        <th>เวลาที่เหลือ(นาที)</th>
                                                                        <th>รายละเอียด</th>
                                                                        <th>รับรายการ</th>
                                                                        <th>ปฏิเสธรายการ</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="table table-condensed table-hover">
                                                                    <tr class="danger">
                                                                        <td style="text-align: center">1</td>
                                                                        <td>102458</td>                         
                                                                        <td>คุณธิติ มหาโยธารักษ์</td>
                                                                        <td>ข้าวกล้อง+ผัดกระเพราหมู+ไข่ดาว</td>
                                                                        <td style="text-align: center">50</td>
                                                                        <td>12-11-2015 12:30</td>
                                                                        <td style="text-align: center">30</td>
                                                                        <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#detail' href="#detail"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                        <td class="text-center"><a class="btn btn-success btn-xs" data-toggle="modal" data-target='#accept' href="#accept"><span class="glyphicon glyphicon-check"></span> รับ</a></td>
                                                                        <td class="text-center"><a class="btn btn-danger btn-xs" data-toggle="modal" data-target='#ignore' href="#ignore"><span class="glyphicon glyphicon-trash"></span> ปฏิเสธ</a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: center">2</td>
                                                                        <td>158642</td>
                                                                        <td>คุณเอนก อนงค์พงศ์ไพร</td>
                                                                        <td>ข้าวหอมมะลิ+หมูกระเทียม+ผัดผักรวม</td>
                                                                        <td style="text-align: center">30</td>
                                                                        <td>30-9-2015 13:30</td>
                                                                        <td style="text-align: center">25</td>
                                                                        <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#detail' href="#detail"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                        <td class="text-center"><a class="btn btn-success btn-xs" data-toggle="modal" data-target='#accept' href="#accept"><span class="glyphicon glyphicon-check"></span> รับ</a></td>
                                                                        <td class="text-center"><a class="btn btn-danger btn-xs" data-toggle="modal" data-target='#ignore' href="#ignore"><span class="glyphicon glyphicon-trash"></span> ปฏิเสธ</a></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="text-align: center">3</td>
                                                                        <td>123456</td>
                                                                        <td>คุณปัญชลี สิริวัฒนชัยฉัตรบริรักษ์</td>
                                                                        <td>ข้าวหอมมะลิ+หมูผัดกะปิ+คั่วกลิ้ง</td>
                                                                        <td style="text-align: center">300</td>
                                                                        <td>30-10-2015 14:30</td>
                                                                        <td style="text-align: center">5</td>
                                                                        <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#detail' href="#detail"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                        <td class="text-center"><a class="btn btn-success btn-xs" data-toggle="modal" data-target='#accept' href="#accept"><span class="glyphicon glyphicon-check"></span> รับ</a></td>
                                                                        <td class="text-center"><a class="btn btn-danger btn-xs" data-toggle="modal" data-target='#ignore' href="#ignore"><span class="glyphicon glyphicon-trash"></span> ปฏิเสธ</a></td>
                                                                    </tr>

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
                                                                <span style="font-size: 20px;">1 รายการ</span></p>
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
                                                                <table class="table table-list-search2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>เลขที่รายการ</th>
                                                                            <th>ชื่อลูกค้า</th>
                                                                            <th>ชนิดอาหาร</th>
                                                                            <th>จำนวน(ขุด)</th>
                                                                            <th>วัน/เวลาที่ลูกค้านัดรับ</th>
                                                                            <th>เวลาที่เหลือ(ชั่วโมง)</th>
                                                                            <th>รายละเอียด</th>
                                                                            <th>รับรายการ</th>
                                                                            <th>ปฏิเสธรายการ</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table table-condensed table-hover">
                                                                        <tr class="warning">
                                                                            <td style="text-align: center">1</td>
                                                                            <td>102458</td>                         
                                                                            <td>คุณธิติ มหาโยธารักษ์</td>
                                                                            <td>ข้าวกล้อง+ผัดกระเพราหมู+ไข่ดาว</td>
                                                                            <td style="text-align: center">50</td>
                                                                            <td>12-11-2015 12:30</td>
                                                                            <td style="text-align: center">3</td>
                                                                            <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#detail' href="#detail"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                            <td class="text-center"><a class="btn btn-success btn-xs" data-toggle="modal" data-target='#accept' href="#accept"><span class="glyphicon glyphicon-check"></span> รับ</a></td>
                                                                            <td class="text-center"><a class="btn btn-danger btn-xs" data-toggle="modal" data-target='#ignore' href="#ignore"><span class="glyphicon glyphicon-trash"></span> ปฏิเสธ</a></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td style="text-align: center">2</td>
                                                                            <td>158642</td>
                                                                            <td>คุณเอนก อนงค์พงศ์ไพร</td>
                                                                            <td>ข้าวหอมมะลิ+หมูกระเทียม+ผัดผักรวม</td>
                                                                            <td style="text-align: center">30</td>
                                                                            <td>30-9-2015 13:30</td>
                                                                            <td style="text-align: center">2</td>
                                                                            <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#detail' href="#detail"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                            <td class="text-center"><a class="btn btn-success btn-xs" data-toggle="modal" data-target='#accept' href="#accept"><span class="glyphicon glyphicon-check"></span> รับ</a></td>
                                                                            <td class="text-center"><a class="btn btn-danger btn-xs" data-toggle="modal" data-target='#ignore' href="#ignore"><span class="glyphicon glyphicon-trash"></span> ปฏิเสธ</a></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td style="text-align: center">3</td>
                                                                            <td>123456</td>
                                                                            <td>คุณปัญชลี สิริวัฒนชัยฉัตรบริรักษ์</td>
                                                                            <td>ข้าวหอมมะลิ+หมูผัดกะปิ+คั่วกลิ้ง</td>
                                                                            <td style="text-align: center">300</td>
                                                                            <td>30-10-2015 14:30</td>
                                                                            <td style="text-align: center">2</td>
                                                                            <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#detail' href="#detail"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                            <td class="text-center"><a class="btn btn-success btn-xs" data-toggle="modal" data-target='#accept' href="#accept"><span class="glyphicon glyphicon-check"></span> รับ</a></td>
                                                                            <td class="text-center"><a class="btn btn-danger btn-xs" data-toggle="modal" data-target='#ignore' href="#ignore"><span class="glyphicon glyphicon-trash"></span> ปฏิเสธ</a></td>
                                                                        </tr>
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
                                        <!-- ignore -->
                                        <div class="modal fade" id="ignore" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px; color: red">เตือน!!</div></span>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span style="font-size: 20px;">ต้องการปฏิเสธรายการ ? </span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                        <button type="button" class="btn btn-danger">ยืนยัน</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End ignore --> 

                                        <!-- accept -->
                                        <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px; color: red">เตือน!!</div></span>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span style="font-size: 20px;">ต้องการยอมรับรายการ ? </span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                        <button type="button" class="btn btn-success">ยืนยัน</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End accept --> 

                                        <!-- Detial -->
                                        <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel">

                                                            <span style="font-size: 30px; margin-top: 5px;">รายละเอียดของรายการหมายเลข: </span>
                                                            <span style="font-size: 30px; margin-top: 5px; color: orange">102458 </span>     

                                                        </span>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row" style="margin-top: 0px;">
                                                            <div class="col-md-12">
                                                                <div class="col-md-7">
                                                                    <!--<div class="card">
                                                                        <div class="card-content">
                                                                            <span style="font-size: 20px">สถานะของรายการ: </span>
                                                                            <span style="font-size: 20px; color: orange;"> รอการตอบรับ </span><br>
                                                                            <span style="font-size: 20px">ตอบรับรายการโดย: </span>
                                                                            <span style="font-size: 20px; color: orange;"> นายใหญ่โภชนา </span><br>
                                                                            <span style="font-size: 20px">ตอบรับรายวันที่: </span>
                                                                            <span style="font-size: 20px; color: orange;"> 12-11-2015 </span><br>
                                                                            <span style="font-size: 20px">ตอบรับรายวันที่: </span>
                                                                            <span style="font-size: 20px; color: orange;"> 12:30 </span><br>
                                                                        </div>
                                                                    </div>-->
                                                                    <!-- ถ้าเป็นสถานะปฏิเสธ <div class="card">
                                                                        <div class="card-content">
                                                                            <span style="font-size: 20px">สถานะของรายการ: </span>
                                                                            <span style="font-size: 20px; color: orange;"> ปฏิเสธรายการ </span><br>
                                                                            <span style="font-size: 20px">ปฏิเสธรายการโดย: </span>
                                                                            <span style="font-size: 20px; color: orange;"> นายใหญ่โภชนา </span><br>
                                                                            <span style="font-size: 20px">ปฏิเสธรายวันที่: </span>
                                                                            <span style="font-size: 20px; color: orange;"> 12-11-2015 </span><br>
                                                                            <span style="font-size: 20px">ปฏิเสธรายวันที่: </span>
                                                                            <span style="font-size: 20px; color: orange;"> 12:30 </span><br>
                                                                        </div>
                                                                    </div> -->
                                                                    <div class="card">
                                                                        <div class="card-content">
                                                                            <span style="font-size: 20px">หมายเลขสมาชิกลูกค้า: </span>
                                                                            <span style="font-size: 20px; color: orange;"> 26143 </span><br>

                                                                            <span style="font-size: 20px">ชื่อ: </span>
                                                                            <span style="font-size: 20px; color: orange;"> คุณธิติ มหาโยธารักษ์ </span><br>

                                                                            <span style="font-size: 20px">โทรศัพท์: </span>
                                                                            <span style="font-size: 20px; color: orange;"> 0812345678 </span><br>

                                                                            <span style="font-size: 20px">อีเมล: </span>
                                                                            <span style="font-size: 20px; color: orange;"> bank.thiti@gmail.com </span><br>


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="card">
                                                                        <div class="card-content">
                                                                            <span style="font-size: 20px">จัดส่งสินค้าโดย: </span><br>
                                                                            <span style="font-size: 20px; color: orange;">108suchart สุชาติ ปานขำ</span><br>
                                                                            <span style="font-size: 20px">โทรศัพท์: </span><br>
                                                                            <span style="font-size: 20px; color: orange;">0812345678</span><br>

                                                                            <span style="font-size: 20px">ส่งสินค้าถึงวันที่: </span><br>
                                                                            <span style="font-size: 20px; color: orange;"> 12-11-2015</span><br>

                                                                            <span style="font-size: 20px">ส่งสินค้าถึงเวลา: </span><br>
                                                                            <span style="font-size: 20px; color: orange;"> 12:40 </span><br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-content">

                                                                            <span style="font-size: 20px">วันที่ลูกค้านัดรับสินค้า: </span><br>
                                                                            <span style="font-size: 20px; color: orange;"> 12-11-2015</span><br>

                                                                            <span style="font-size: 20px">เวลาที่ลูกค้านัดรับสินค้า: </span><br>
                                                                            <span style="font-size: 20px; color: orange;"> 12:30 </span><br>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 5px;">
                                                            <div class="col-md-12">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="card-content">
                                                                            <span style="font-size: 20px">สถานที่ส่งสินค้า </span>
                                                                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                                            <span style="font-size: 17px">บริษัท นาดาว บางกอก จำกัด 92/14 ซอยสุขุมวิท 31 (สวัสดี) แขวงคลองตันเหนือ เขตวัฒนา กทม. 10110</span>
                                                                            <hr>
                                                                            ตรงนี้ต้องใส่แมพที่แสดงจากจุด A คือร้าน ไปยังจุด B คือที่จัดส่งของลูกค้า
                                                                            และมีการโชว์ระยะทาง แต่ใส่ไปใส่มาแม่งยังเน่าอยู่ เดี๋ยวค่อยว่ากันนะ ตอนนี้ยอมใจ 

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin-top: 5px;">
                                                            <div class="col-md-12">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="card-content">
                                                                            <span style="font-size: 20px">รายการสินค้า </span>
                                                                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <table class="table table-list-search">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>ลำดับ</th>
                                                                                                <th>รายการ</th>
                                                                                                <th>ราคาต่อหน่วย/บาท</th>
                                                                                                <th>จำนวน</th>
                                                                                                <th>ราคารวม/บาท</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody class="table table-condensed table-hover">
                                                                                            <tr>
                                                                                                <td>1</td>                     
                                                                                                <td>ข้าวกล้อง</td>
                                                                                                <td style="text-align: center">10.00</td>
                                                                                                <td style="text-align: center">50</td>
                                                                                                <td style="text-align: center">500.00</td>

                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>2</td>                     
                                                                                                <td>ผัดกระเพราหมู</td>
                                                                                                <td style="text-align: center">15.00</td>
                                                                                                <td style="text-align: center">50</td>
                                                                                                <td style="text-align: center">750.00</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>3</td>                     
                                                                                                <td>ไข่ดาว</td>
                                                                                                <td style="text-align: center">5.00</td>
                                                                                                <td style="text-align: center">50</td>
                                                                                                <td style="text-align: center">250.00</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>4</td>                     
                                                                                                <td>ค่าจัดส่ง</td>
                                                                                                <td style="text-align: center">100.00</td>
                                                                                                <td style="text-align: center">1</td>
                                                                                                <td style="text-align: center">100.00</td>
                                                                                            </tr>
                                                                                            <tr class="success">
                                                                                                <td></td>                     
                                                                                                <td>ราคารวม</td>
                                                                                                <td style="text-align: center"></td>
                                                                                                <td style="text-align: center"></td>
                                                                                                <td style="text-align: center">1,600.00</td>
                                                                                            </tr>
                                                                                            <tr class="warning">
                                                                                                <td></td>                     
                                                                                                <td>ส่วนลด10% 1D23A5</td>
                                                                                                <td style="text-align: center"></td>
                                                                                                <td style="text-align: center">1</td>
                                                                                                <td style="text-align: center">-160.00</td>
                                                                                            </tr>
                                                                                            <tr class="danger">
                                                                                                <td></td>                     
                                                                                                <td>ราคารวมหลังหักส่วนลด</td>
                                                                                                <td style="text-align: center"></td>
                                                                                                <td style="text-align: center"></td>
                                                                                                <td style="text-align: center">1,440.00</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>   
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 5px;">
                                                            <div class="col-md-12">
                                                                <div class="col-md-6">
                                                                    <div class="card">
                                                                        <div class="card-content">
                                                                            <span style="font-size: 20px">เพิ่มเติม </span>
                                                                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                                            <span style="font-size: 15px; color: red;"> กระเพราไม่ใส่ถั่วฝักยาว </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="card">
                                                                        <div class="card-content">
                                                                            <span style="font-size: 20px">การชำระเงิน </span>
                                                                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                                            <span style="font-size: 15px"> โอนเงินมัดจำผ่านธนาคาร: <br><span style="font-size: 15px; color: orange;"> กสิกรไทย เลขที่ 12-1231212-1 <br> 400.00 บาท</span> </span> &nbsp; 

                                                                            <a href="#" class="btn btn-warning btn-xs "data-toggle="modal" data-target='.pop-up-2' href=".pop-up-2" style="margin-left: 90px;">แสดงสลิป</a><br>

                                                                            <span style="font-size: 15px"> ชำระเงินด้วยเงินสด: <br><span style="font-size: 15px; color: red;"> ต้องชำระเพิ่ม ณ ที่รับสินค้า 1040.00 บาท </span> </span> &nbsp; 


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-dismiss="modal" data-target='#accept' href="#accept">ยอมรับรายการ</button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-dismiss="modal" data-target='#ignore' href="#ignore">ปฏิเสธรายการ</button>
                                                        <button type="button" class="btn btn-primary">ออกใบงาน</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                        <img src="../assets/images/sample slip.jpg" class="img-responsive img-rounded center-block" alt="">
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
    <script src="/assets/js/ui-bootstrap-tpls-0.13.4.min.js"></script>


</body>
</html>