<?php
include '../api/islogin.php';
include '../dbconn.php';
?>

<html>
    <head>
        <title>Customer Profile</title>
        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/profile.css">
        <link rel="stylesheet" href="/assets/css/customer-comment.css">
        <link rel="stylesheet" href="/assets/css/datatables.css">
    </head>
    <body>
        <?php
        $cusid = $_SESSION["userdata"]["id"];
        $res2 = $con->query("select * from customer where id = '$cusid' ");
        $data2 = $res2->fetch_assoc();

        $res3 = $con->query("SELECT * FROM `shippingAddress` WHERE customer_id = '$cusid'");
        ?>

        <?php include '../template/customer-navbar.php'; ?>
        <!-- start profile -->
        <section id="profile">
            <!-- modal -->
            <?php include '../customer-profile/modal-edit-change.php'; ?>


            <div class="container">
                <div class="row" style="margin-top:50px">
                    <?php include '../customer-profile/list-icon.php'; ?>
                    <div class="col-md-8">
                        <!-- 4 element -->
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-2 templatemo-box fadeInUp" style="padding-right: 0;">
                                        <a href="/view/cus_customer_profile.php">
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/tracking_b_c.png" title="ตรวจสถานะสินค้า" onmouseover="this.src = '/assets/images/profile/menu_list/tracking_a_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/tracking_b_c.png';" style="margin: 0 0 0 15px">
                                            <p class="elt" style="margin: 0;padding: 0 0 0 2px;">ตรวจสถานะสินค้า</p>
                                        </a>
                                    </div>
                                    <div class="col-md-2 templatemo-box fadeInUp">
                                        <a href="/view/cus_customer_profile_history_order.php">
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/orderhis_a_c.png" title="ประวัติการสั่งซื้อ" onmouseover="this.src = '/assets/images/profile/menu_list/orderhis_b_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/orderhis_a_c.png';" style="margin: 0 0 0 20px">
                                            <p class="elt" style="margin:0 0 0 8px">ประวัติการซื้อ</p>
                                        </a>
                                    </div>
                                    <div class="col-md-2 templatemo-box fadeInUp">
                                        <a href="/view/cus_customer_profile_cart.php">
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/shoplist_b_c.png" title="ตะกร้า" onmouseover="this.src = '/assets/images/profile/menu_list/shoplist_a_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/shoplist_b_c.png';" style="margin: 0 0 0 10px">
                                            <p class="elt" style="margin: 0 0 0 20px">ตะกร้า</p>
                                        </a>
                                    </div>
                                    <div class="col-md-2 templatemo-box fadeInUp" style="padding:0;">
                                        <a href="/view/cus_customer_profile_favorite.php">
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/fav_b_c.png" title="ชื่นชอบ" onmouseover="this.src = '/assets/images/profile/menu_list/fav_a_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/fav_b_c.png';" style="margin: 0 0 0 15px">
                                            <p class="elt" style="margin: 0 0 0 20px">ชื่นชอบ</p>
                                        </a>       
                                    </div>
                                    <div class="col-md-2 templatemo-box fadeInUp" style="padding-left: 0;">
                                        <a href="/view/cus_customer_profile_shippingAddress.php">
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/shipadd_b_c.png" title="ที่อยู่การจัดส่ง" onmouseover="this.src = '/assets/images/profile/menu_list/shipadd_a_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/shipadd_b_c.png';" style="margin: 0 0 0 15px">
                                            <p class="elt" style="margin:0">ที่อยู่การจัดส่ง</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content" style="margin-top:-50px;">
                            <!-- order history -->
                            <div class="tab-pane fade active in" id="history">
                                <div class="content2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel" style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px;">
                                                            รายการทั้งหมด 
                                                        </div>
                                                        <!-- ตารางรายการติดตาม -->
                                                        <div class="row" id="showtable">
                                                            <div class="col-md-12">
                                                                <table class="table table-list-search  table table-striped table-bordered" id="historyOrderDataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <!--<th>ลำดับ</th>-->
                                                                            <th class="text-center">หมายเลขคำสั่งซื้อ</th>
                                                                            <th class="text-center">จำนวน(ชุด)</th>
                                                                            <th class="text-center">ร้านอาหาร</th>
                                                                            <th class="text-center">วัน/เวลาที่รับสินค้า</th>
                                                                          <!--  <th>ผู้ส่งสินค้า</th>-->
                                                                            <th class="text-center">รายละเอียด</th>
                                                                            <th class="text-center">รีวิว</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table table-condensed table-hover" id="showFastOrder">
                                                                        <?php
                                                                        $cusid = $_SESSION["userdata"]["id"];

                                                                        $orderNowAllRes = $con->query("SELECT concat('N') as orderType , id, updated_status_time, status "
                                                                                . "FROM normal_order WHERE status = 9 AND customer_id = '$cusid' "
                                                                                . "UNION "
                                                                                . "select concat('F') as orderType, id, updated_status_time, status "
                                                                                . "FROM fast_order WHERE status = 9 AND customer_id = '$cusid' "
                                                                                . "ORDER BY updated_status_time DESC, id");




                                                                        $orderRes = $con->query("SELECT fast_order.id as fast_id, order_status.description, order_status.id as status_id,"
                                                                                . " fast_order.quantity as qty, restaurant.name, fast_order.main_menu_id, fast_order.messenger_id, "
                                                                                . "fast_order.updated_status_time, fast_order.restaurant_id "
                                                                                . "FROM `fast_order` "
                                                                                . "LEFT JOIN order_status ON order_status.id = fast_order.status "
                                                                                . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
                                                                                . "WHERE fast_order.customer_id = '$cusid' "
                                                                                . "and fast_order.status = '9' "
                                                                                . "GROUP by fast_order.id ORDER BY fast_order.status ASC, fast_order.order_time DESC");


                                                                        $i = 1;
                                                                        while ($orderIdAllData = $orderNowAllRes->fetch_assoc()) {
                                                                            $order_type = $orderIdAllData["orderType"];
                                                                            $orderIdAll = $orderIdAllData["id"];

                                                                            if ($order_type == 'F') {

                                                                                $orderRes = $con->query("SELECT fast_order.id as fast_id, order_status.description, order_status.id as status_id,"
                                                                                        . " fast_order.quantity as qty, restaurant.name, fast_order.main_menu_id, fast_order.messenger_id, "
                                                                                        . "fast_order.updated_status_time, fast_order.restaurant_id, fast_order.order_no "
                                                                                        . "FROM `fast_order` "
                                                                                        . "LEFT JOIN order_status ON order_status.id = fast_order.status "
                                                                                        . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
                                                                                        . "WHERE fast_order.id = '$orderIdAll' "
                                                                                        . "GROUP by fast_order.id ORDER BY fast_order.status ASC, fast_order.order_time DESC");
                                                                                while ($orderData = $orderRes->fetch_assoc()) {

                                                                                    $messid = $orderData["messenger_id"];
                                                                                    $messengerNameRes = $con->query("select * from messenger where id = '$messid'");
                                                                                    $messData = $messengerNameRes->fetch_assoc();
                                                                                    $mesName = $messData["username"];
                                                                                    ?>
                                                                                    <tr>
                                                                                       <!-- <td><?= $i++; ?></td>-->
                                                                                        <td class="text-center"><?= $orderData["order_no"] ?></td>    
                                                                                        <td class="text-center"><?= $orderData["qty"] ?></td>
                                                                                        <td><?= $orderData["name"] ?></td>
                                                                                        <td class="text-center"><?= $orderData["updated_status_time"] ?>&nbsp;น.</td>
                                                                                        <!--<td class="text-center"><?= $mesName ?></td>-->
                                                                                        <td class="text-center">
                                                                                            <button class="btn btn-info btn-xs fastOrderView" data-id="<?= $orderData["fast_id"] ?>" data-no='<?= $orderData["order_no"] ?>' >
                                                                                                <span class="glyphicon glyphicon-eye-open"></span> 
                                                                                                แสดง
                                                                                            </button>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            <button class="btn btn-success btn-xs fastReview" data-id="<?= $orderData["restaurant_id"] ?>" data-name="<?= $orderData["name"] ?>">
                                                                                                <span class="glyphicon glyphicon-edit"></span> 
                                                                                                รีวิว
                                                                                            </button>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                            } else {
                                                                                $orderRes = $con->query(" SELECT normal_order.id as order_id, normal_order.updated_status_time, "
                                                                                        . "restaurant.name, SUM(order_detail.quantity) as qty , normal_order.messenger_id,"
                                                                                        . " normal_order.restaurant_id, normal_order.order_no "
                                                                                        . "FROM `normal_order` "
                                                                                        . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
                                                                                        . "LEFT JOIN customer ON customer.id = normal_order.customer_id"
                                                                                        . " LEFT JOIN order_status ON order_status.id = normal_order.status "
                                                                                        . "LEFT JOIN restaurant ON restaurant.id = normal_order.restaurant_id "
                                                                                        . "WHERE normal_order.id = '$orderIdAll' "
                                                                                        . "GROUP BY normal_order.id ORDER BY normal_order.status ASC, normal_order.order_time DESC");
                                                                                while ($orderData = $orderRes->fetch_assoc()) {

                                                                                    $messid = $orderData["messenger_id"];
                                                                                    $messengerNameRes = $con->query("select * from messenger where id = '$messid'");
                                                                                    $messData = $messengerNameRes->fetch_assoc();
                                                                                    $mesName = $messData["username"];
                                                                                    ?>
                                                                                    <tr>
                                                                                       <!-- <td><?= $i++; ?></td>-->
                                                                                        <td class="text-center"><?= $orderData["order_no"] ?></td>    
                                                                                        <td class="text-center"><?= $orderData["qty"] ?></td>
                                                                                        <td><?= $orderData["name"] ?></td>
                                                                                        <td class="text-center"><?= $orderData["updated_status_time"] ?>&nbsp;น.</td>
                                                                                        <!--<td><?= $mesName ?></td>-->
                                                                                        <td class="text-center">
                                                                                            <button class="btn btn-info btn-xs normalOrderView" data-id="<?= $orderData["order_id"] ?>" data-no='<?= $orderData["order_no"] ?>'>
                                                                                                <span class="glyphicon glyphicon-eye-open"></span> 
                                                                                                แสดง
                                                                                            </button>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            <button class="btn btn-success btn-xs normalReview" data-id="<?= $orderData["restaurant_id"] ?>" data-name="<?= $orderData["name"] ?>">
                                                                                                <span class="glyphicon glyphicon-edit"></span> 
                                                                                                รีวิว
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
                                                        <!-- จบตารางรายการติดตาม -->

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

                <!-- Detial fasttt   -->
                <div class="modal fade bs-example-modal-lg" id="detailFastOrderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
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
            </div>
        </section> 
        <!-- อัพโหลดหลักฐานการโอนเงิน -->
        <!-- tracking -->
        <div class="modal fade" id="reviewNormalModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <span class="modal-title" id="myModalLabel">
                            <span style="font-size: 20px; margin-top: 5px;">รีวิวและคะแนนความพึงพอใจต่อร้าน&nbsp; <span id="restaurantName"></span><span id="restId" style="display: none"></span> </span>     
                        </span>
                    </div>
                    <div class="modal-body">
                        <form id="ratingsForm">
                            <div class="stars">
                                <input type="radio" name="star[]" class="star-1" id="star-1" value="1"/>
                                <label class="star-1" for="star-1">1</label>
                                <input type="radio" name="star[]" class="star-2" id="star-2" value="2"/>
                                <label class="star-2" for="star-2">2</label>
                                <input type="radio" name="star[]" class="star-3" id="star-3" value="3"/>
                                <label class="star-3" for="star-3">3</label>
                                <input type="radio" name="star[]" class="star-4" id="star-4" value="4"/>
                                <label class="star-4" for="star-4">4</label>
                                <input type="radio" name="star[]" class="star-5" id="star-5" value="5" />
                                <label class="star-5" for="star-5">5</label>
                                <span></span>
                            </div>
                            <textarea style="margin-top: 20px; font-size: 16px" class="form-control input-sm " type="textarea" id="reviewinput" placeholder="เขียนข้อความของคุณที่นี่" rows="5"></textarea><br>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                            <button class="btn btn-primary" type="button"  id="saveReviewBtn">ส่งข้อความ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php include '../template/footer.php'; ?>
        <script src="/assets/js/cus_pro_search.js"></script>
        <script src="/assets/js/customer-profile-history.js"></script>
        <script src="/assets/js/customer-profile-change.js"></script>
        <script src="/assets/js/dataTables.js"></script>
        <script>
                                                     var table = $('#historyOrderDataTable').DataTable({
                                                         "oLanguage": {
                                                             "sLengthMenu": "แสดง _MENU_ แถว ",
                                                             "sZeroRecords": "ไม่พบข้อมูล",
                                                             "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ แถวทั้งหมด",
                                                             "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 แถวทั้งหมด",
                                                             "sInfoFiltered": "(จากแถวทั้งหมด _MAX_ แถว)",
                                                             "sSearch": "ค้นหา :"}, 
                                                         "aaSorting": [[0,'desc']] 
                                                     });

        </script>
    </body>
</html>
