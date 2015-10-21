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
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/tracking_b_c.png" title="ตรวจสถานะสินค้า" onmouseover="this.src = '/assets/images/profile/menu_list/tracking_a_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/tracking_b_c.png';" style="margin: 0 0 0 15px">
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
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/shipadd_a_c.png" title="ที่อยู่การจัดส่ง" onmouseover="this.src = '/assets/images/profile/menu_list/shipadd_b_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/shipadd_a_c.png';" style="margin: 0 0 0 15px">
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
                            <!-- shipping address -->
                            <div class="tab-pane fade active in" id="shipadd" style="margin:0 0 20px 0;">
                                <div class="content2" >

                                    <?php
                                    $result = $con->query("SELECT `id`, `type`, `address_naming`, `full_address` FROM `shippingAddress` WHERE customer_id = '$cusid'");
                                    $i = 1;
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel" style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            รายการทั้งหมด 
                                                        </div>
                                                        <!-- ตารางรายการติดตาม -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>ที่อยู่</th>
                                                                            <th>แก้ไข</th>
                                                                            <th>ลบ</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table table-condensed table-hover">
                                                                        <!--<tr>
                                                                            <td>1</td>
                                                                            <td><?= $data2['address'] ?></td>                       
                                                                            <td><button class="btn btn-success btn-xs" disabled="disabled"><span class="glyphicon glyphicon-check"></span> แก้ไข</button></td>
                                                                            <td><button class="btn btn-danger btn-xs" disabled="disabled"><span class="glyphicon glyphicon-trash"></span> ลบ</button></td>
                                                                        </tr>-->
                                                                        <?php while ($data4 = $result->fetch_assoc()) { ?>
                                                                            <tr>
                                                                                <td><?= $i++; ?></td>
                                                                                <td><?= $data4['full_address'] ?></td>
                                                                                <td>
                                                                                    <button class="btn btn-primary btn-xs editadd" id="editadd<?= $data4["id"] ?>"  >
                                                                                        <span class="glyphicon glyphicon-check"></span> แก้ไข
                                                                                    </button>              
                                                                                </td>
                                                                                <td>
                                                                                    <button class="btn btn-danger btn-xs deleteadd" id="deleteadd<?= $data4["id"] ?>" data-title="Delete"  >
                                                                                        <span class="glyphicon glyphicon-trash"></span> ลบ
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- จบตารางรายการติดตาม -->

                                </div>
                            </div>

                            <div class="modal fade" id="edit_addshipmodal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/customer/edit-shipping-address.php?id=<?= $cusid ?>" method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                                                <h3 class="modal-title" id="shipping_address">เปลี่ยนแปลงข้อมูลที่จัดส่งสินค้า<span id="showadd_id" style="display: none"></span></h3>
                                            </div>
                                            <div id="formeditaddrsss">

                                            </div>
                                            <div class="modal-footer">
                                                <div>
                                                    <input type="button" class="btn btn-warning col-sm-3" style="margin-left: 270px" name="resetbtn" data-dismiss="modal" value="ยกเเลิก" >
                                                    <input type="submit" class="btn btn-success col-sm-3" name="updateaddbtn"  value="ตกลง" >
                                                </div>
                                            </div> 
                                        </form>
                                    </div>
                                    <!-- /.modal-content --> 
                                </div>
                                <!-- /.modal-dialog --> 
                            </div>
                            <!-- end add shipping address -->

                            <div class="modal fade" id="delete-addmodal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                            <h3 class="modal-title custom_align" id="Heading">ลบข้อมูลที่จัดส่ง<span id="showadddel_id" style="display: none" ></span></h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> คุณต้องการลบข้อมูลที่จัดส่งนี้ ?</div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> ยกเลิก</button>
                                            <button type="submit" class="btn btn-success" id="deleteaddyes"><span class="glyphicon glyphicon-ok-sign"></span> ตกลง</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content --> 
                                </div>
                                <!-- /.modal-dialog --> 
                            </div>
                            <!-- end delete shipping add -->
                        </div>
                    </div>
                </div>
            </div>
        </section> 


        <?php include '../template/footer.php'; ?>


        <script src="/assets/js/customer-profile-shippingaddress.js"></script>
        <script src="/assets/js/customer-profile-change.js"></script>

    </body>
</html>
