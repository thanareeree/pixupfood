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
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/tracking_a_c.png" title="ตรวจสถานะสินค้า" onmouseover="this.src = '/assets/images/profile/menu_list/tracking_b_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/tracking_a_c.png';" style="margin: 0 0 0 15px">
                                            <p class="elt" style="margin: 0;padding: 0 0 0 2px;">ตรวจสถานะสินค้า</p>
                                        </a>
                                    </div>
                                    <div class="col-md-2 templatemo-box fadeInUp">
                                        <a href="/view/cus_customer_profile_history_order.php">
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/orderhis_b_c.png" title="ประวัติการสั่งซื้อ" onmouseover="this.src = '/assets/images/profile/menu_list/orderhis_a_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/orderhis_b_c.png';" style="margin: 0 0 0 20px">
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
                            <!-- order tracking -->
                            <div class="tab-pane fade  active in" id="tracking">
                                <div class="content2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel" style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px;">
                                                            รายการสั่งด่วน 
                                                        </div>
                                                        <!-- ตารางรายการติดตาม -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="#" method="get">
                                                                    <div class="input-group">
                                                                        <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                                                        <input class="form-control" id="system-search" name="q" placeholder="ค้นหาข้อมูลในตารางนี้" required style="height: 34px;">
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
                                                                            <th>รายการอาหาร</th>
                                                                            <th>จำนวน(ขุด)</th>
                                                                            <th>สถานะ</th>
                                                                            <th>รายละเอียด</th>
                                                                            <th>หลักฐานการโอนเงิน</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table table-condensed table-hover" id="showFastOrder">


                                                                    </tbody>
                                                                </table>   
                                                            </div>
                                                        </div>
                                                        <!-- จบตารางรายการติดตาม -->

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel" style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            รายการสั่งปกติ 
                                                        </div>
                                                        <!-- ตารางรายการติดตาม -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="#" method="get">
                                                                    <div class="input-group">
                                                                        <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                                                        <input class="form-control" id="system-search2" name="q" placeholder="ค้นหาข้อมูลในตารางนี้" required style="height: 34px;">
                                                                        <span class="input-group-btn">
                                                                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <table class="table table-list-search2  table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>เลขที่รายการ</th>
                                                                            <th>จำนวน(ชุด)</th>
                                                                            <th>ร้านอาหาร</th>
                                                                            <th>สถานะ</th>
                                                                            <th>รายละเอียด</th>
                                                                            <th>หลักฐานการโอนเงิน</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table table-condensed table-hover" id="showNormalOrder">


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


                <!-- อัพโหลดหลักฐานการโอนเงิน -->
                <!-- tracking -->
                <div class="modal fade" id="transfSlip1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <span class="modal-title" id="myModalLabel">
                                    <span style="font-size: 20px; margin-top: 5px;">แจ้งหลักฐานการโอนเงินของเลขที่รายการ: &nbsp;<span id="uploadOrderId"></span> </span>     
                                </span>
                            </div>
                            <div id="upload"></div>
                        </div>
                    </div>
                </div>
                <!-- จบอัพโหลดหลักฐานการโอนเงิน -->

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


        <?php include '../template/footer.php'; ?>
        <!-- ตารางรายการออเดอร์ -->
        <script src="/assets/js/OrderSearch.js"></script>
        <script src="/assets/js/customer-profile-change.js"></script>
        <script src="/assets/js/customer-profile.js"></script>

    </body>
</html>
