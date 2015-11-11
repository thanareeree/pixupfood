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
                                        <li >
                                            <a href="/view/res_manage_now_order.php" >รายการสั่งซื้ออยู่ระหว่างการดำเนินการ </a>
                                        </li>
                                        <li>
                                            <a href="/view/res_manage_history_order.php" >รายการสั่งซื้อเสร็จสมบูรณ์ </a>
                                        </li>
                                        <li class="active">
                                            <a href="/view/res_manage_ignore_order.php" >รายการที่ปฏิเสธหรือยกเลิกเเล้ว </a>
                                        </li>
                                    </ul>
                                    <!-- Tab 1 -->
                                    <div class="tab-content">

                                        <!-- Tab รายการอยู่ระหว่างดำเนินการ -->
                                        <div class="tab-pane active" id="tab_default_2_2">
                                            <div class="page-header" style="font-size: 40px; margin-top: 5px">
                                                รายการที่ปฏิเสธหรือยกเลิกเเล้ว  

                                            </div>
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header" style="font-size: 30px; margin-top: 5px"> รายการทั้งหมด  
                                                        <div class="pull-right">
                                                            <p class="text-center">
                                                                <span style="font-size: 20px; color: red"></span></p>
                                                        </div>
                                                    </div>
                                                    <!-- ตารางรายการอยู่ระหว่างดำเนินการ -->
                                                    <div class="row">
                                                      <!--  <div class="col-md-12">
                                                            <form action="#" method="get">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="system-search" name="q" placeholder="ค้นหาข้อมูลในตารางนี้" required>
                                                                    <span class="input-group-btn">
                                                                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>-->
                                                        <div class="col-md-12">
                                                            <table class="table table-list-search fixed  table table-striped table-bordered" id="ignoreDataTable">
                                                                <thead>
                                                                    <tr>
                                                                        <!--<th>ลำดับ</th>-->
                                                                        <th>หมายเลขคำสั่งซื้อ</th>
                                                                        <th >ชื่อลูกค้า</th>
                                                                        <th class="text-center">รายการอาหาร</th>
                                                                        <th class="text-center">จำนวน(ชุด)</th>
                                                                        <th class="text-center">เมื่อวันที่</th>
                                                                        <th class="text-center">สถานะ</th>
                                                                        <th class="text-center">รายละเอียด</th>



                                                                    </tr>
                                                                </thead>
                                                                <tbody class="table  table-hover" id="showdataIgnoreOrder">
                                                                    <?php
                                                                    date_default_timezone_set("Asia/Bangkok");


                                                                    $resid = $_SESSION["restdata"]["id"];


                                                                    $orderNowAllRes = $con->query("SELECT concat('N') as orderType , id, updated_status_time, status "
                                                                            . "FROM normal_order "
                                                                            . "WHERE (status = 7 or status = 6)  AND restaurant_id = '$resid' "
                                                                            . "UNION "
                                                                            . "select concat('F') as orderType, id, updated_status_time, status "
                                                                            . "FROM fast_order WHERE (status = 7 or status = 6) AND restaurant_id = '$resid' "
                                                                            . "ORDER BY updated_status_time DESC, id");

                                                                    $i = 1;
                                                                    while ($orderIdAllData = $orderNowAllRes->fetch_assoc()) {
                                                                        $order_type = $orderIdAllData["orderType"];
                                                                        $orderIdAll = $orderIdAllData["id"];


                                                                        if ($order_type == 'F') {

                                                                            $fastOrderRes = $con->query("SELECT fast_order.id as fast_id, fast_order.delivery_date, "
                                                                                    . "fast_order.delivery_time, order_status.description, order_status.id, fast_order.shippingAddress_id,"
                                                                                    . " fast_order.customer_id , quantity as qty , customer.firstName, customer.lastName , "
                                                                                    . "fast_order.main_menu_id, request_fast_order.priority, fast_order.order_time,customer.tel,"
                                                                                    . " restaurant.name, fast_order.updated_status_time, fast_order.messenger_id, fast_order.order_no "
                                                                                    . "FROM `fast_order` "
                                                                                    . "LEFT JOIN order_status ON order_status.id = fast_order.status "
                                                                                    . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
                                                                                    . "LEFT JOIN request_fast_order ON request_fast_order.fast_id = fast_order.id "
                                                                                    . "LEFT JOIN customer ON customer.id = fast_order.customer_id "
                                                                                    . "WHERE fast_order.id = '$orderIdAll'"
                                                                                    . "GROUP by fast_order.id "
                                                                                    . "ORDER BY fast_order.order_time DESC");
                                                                            while ($fastOrderData = $fastOrderRes->fetch_assoc()) {
                                                                                ?>
                                                                                <tr>

                                                                                    <td><?= $fastOrderData["order_no"] ?></td>                         
                                                                                    <td><?= $fastOrderData["firstName"] . '&nbsp;' . $fastOrderData["lastName"] ?></td>
                                                                                    <td class="text-center">1</td>
                                                                                    <td style="text-align: center"><?= $fastOrderData["qty"] ?></td>
                                                                                    <td class="text-center"><?= substr($fastOrderData["updated_status_time"], 0, 11) ?>&nbsp;<?= substr($fastOrderData["updated_status_time"], 11, 5) ?>&nbsp;น. </td>

                                                                                    <td style="text-align: center"><?= $fastOrderData["description"] ?></td>
                                                                                    <td class="text-center">
                                                                                        <button class="btn btn-info btn-xs fastOrderView" data-id="<?= $fastOrderData["fast_id"] ?>" data-no="<?= $fastOrderData["order_no"] ?>" >
                                                                                            <span class="glyphicon glyphicon-eye-open"></span> 
                                                                                            แสดง
                                                                                        </button>
                                                                                    </td>

                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            $normalOrderRes = $con->query("SELECT normal_order.id as order_id, normal_order.order_time,delivery_date, "
                                                                                    . "delivery_time, total_nofee,prepay, normal_order.status, normal_order.shippingAddress_id,"
                                                                                    . " normal_order.customer_id , COUNT(order_detail.id) as foodlist, SUM(order_detail.quantity) as qty , "
                                                                                    . "customer.firstName, customer.lastName, customer.tel, order_status.description, normal_order.updated_status_time,"
                                                                                    . "normal_order.messenger_id, normal_order.order_no  "
                                                                                    . "FROM `normal_order` "
                                                                                    . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
                                                                                    . "LEFT JOIN customer ON customer.id = normal_order.customer_id "
                                                                                    . "LEFT JOIN order_status ON order_status.id = normal_order.status"
                                                                                    . " WHERE normal_order.id = '$orderIdAll'  "
                                                                                    . "GROUP BY normal_order.id "
                                                                                    . "ORDER BY normal_order.order_time DESC");
                                                                            while ($normalOrderData = $normalOrderRes->fetch_assoc()) {
                                                                                ?>
                                                                                <tr >

                                                                                    <td><?= $normalOrderData["order_no"] ?></td>                         
                                                                                    <td><?= $normalOrderData["firstName"] . '&nbsp;' . $normalOrderData["lastName"] ?></td>
                                                                                    <td class="text-center"><?= $normalOrderData["foodlist"] ?></td>
                                                                                    <td style="text-align: center"><?= $normalOrderData["qty"] ?></td>
                                                                                    <td class="text-center"><?= substr($normalOrderData["updated_status_time"], 0, 11) ?>&nbsp;<?= substr($normalOrderData["updated_status_time"], 11, 5) ?>&nbsp;น.</td>
                                                                                    <td style="text-align: center"><?= $normalOrderData["description"] ?></td>
                                                                                    <td class="text-center">
                                                                                        <button class="btn btn-info btn-xs normalOrderView" data-id="<?= $normalOrderData["order_id"] ?>" data-no="<?= $normalOrderData["order_no"] ?>" >
                                                                                            <span class="glyphicon glyphicon-eye-open"></span> 
                                                                                            แสดง
                                                                                        </button>
                                                                                    </td>


                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                
                                                                ?>
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




    <!-- start footer -->
    <?php include '../template/footer.php'; ?>

    <!-- ตารางรายการออเดอร์ -->
    <script src="/assets/js/OrderSearch.js"></script>
    <script src="/assets/js/manage_ignore_order.js"></script>
    <script src="/assets/js/dataTables.js"></script>
    <script>
        var table = $('#ignoreDataTable').DataTable({
        });
    </script>
</body>
</html>