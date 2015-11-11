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
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/fav_a_c.png" title="ชื่นชอบ" onmouseover="this.src = '/assets/images/profile/menu_list/fav_b_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/fav_a_c.png';" style="margin: 0 0 0 15px">
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
                            <!-- favorite list -->
                            <div class="tab-pane fade active in" id="favlist">
                                <div class="content2" style="padding:0 0 15px 0">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                รายการทั้งหมด 
                                            </div>
                                            <div class="row">
                                                <?php
                                                $countRes = $con->query("SELECT * FROM `favorite_menu` WHERE customer_id = '$cusid'");

                                                if ($countRes->num_rows == 0) {
                                                    ?>
                                                <div class="col-md-12">
                                                        <div class="alert alert-warning " role="alert">
                                                            <h4 class="text-center">ยังไม่มีรายการ</h4>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } else {
                                                    while ($favData = $countRes->fetch_assoc()) {
                                                        $menuid = $favData["menu_id"];
                                                        $menuRes = $con->query("SELECT restaurant.name, menu.img_path, main_menu.img_path as main_img, "
                                                                . "menu.id, restaurant.id as resid, main_menu.name as menuname "
                                                                . "FROM `menu` "
                                                                . "LEFT JOIN main_menu ON menu.main_menu_id = main_menu.id "
                                                                . "LEFT JOIN restaurant ON restaurant.id = menu.restaurant_id "
                                                                . "WHERE menu.id = '$menuid'");
                                                        while ($menuData = $menuRes->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-md-6">
                                                                <ul class="media-list main-list">

                                                                    <li class="media">
                                                                        <a class="pull-left" href="/view/cus_restaurant_view.php?menuId=<?= $menuData["id"] ?>&resId=<?= $menuData["resid"] ?>">
                                                                            <img class="media-object" src="<?= ($menuData["img_path"] == "") ? $menuData["main_img"] : $menuData["img_path"] ?>" style="max-width: 160px;max-height: 100px">
                                                                        </a>
                                                                        <div class="media-body">
                                                                            <h3 class="media-heading"><?= $menuData["menuname"] ?></h3>
                                                                            <p class="by-author"><?= $menuData["name"] ?></p>
                                                                            <p><button type="button" class="btn btn-danger btn-xs unfav" data-id="<?= $favData["id"] ?>"><span class="glyphicon glyphicon-trash"></span> ลบออกจากรายการโปรด</button></p>
                                                                        </div>
                                                                    </li><hr>
                                                                </ul>
                                                            </div>
                                                        <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="delfav" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                                    <h3 class="modal-title custom_align" id="Heading">ลบรายการโปรดของคุณ</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> คุณต้องการลบรายการโปรดนี้ ?</div>
                                                </div>
                                                <div class="modal-footer ">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                                                    <button type="submit" class="btn btn-success" id="deleteaddyes"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content --> 
                                        </div>
                                        <!-- /.modal-dialog --> 
                                    </div>
                                    <!-- end delete favorite list -->
                                </div>
                            </div>
                            <!-- end favorite list -->

                        </div>
                    </div>
                </div>
            </div>
        </section> 


<?php include '../template/footer.php'; ?>


        <script src="/assets/js/customer-profile-favorite.js"></script>
        <script src="/assets/js/customer-profile-change.js"></script>

    </body>
</html>
