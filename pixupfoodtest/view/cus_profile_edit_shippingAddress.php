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
        <link rel="stylesheet" href="/assets/css/regis_map.css">  
        <style>
            #map {
                width: 500px;
                height: 300px;
            }
        </style>
    </head>
    <body>
        <?php
        $cusid = $_SESSION["userdata"]["id"];
        $shipid = @$_GET["shipid"];
        $res2 = $con->query("select * from customer where id = '$cusid' ");
        $data2 = $res2->fetch_assoc();

        $res3 = $con->query("SELECT * FROM `shippingAddress` WHERE customer_id = '$cusid'");

        $res5 = $con->query("select * from shippingAddress where id = '$shipid'");
        $data5 = $res5->fetch_assoc();
        $latitude = $data5["latitude"];
        $longitude = $data5["longitude"];
        $type = $data5["type"];
        ?>

        <?php include '../template/customer-navbar.php'; ?>
        <!-- start profile -->
        <section id="profile">
            <!-- modal -->
            <?php include '../customer-profile/modal-edit-change.php'; ?>
            <input type="hidden" id="shipid" value="<?= $shipid?>">
          
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
                                    $result = $con->query("SELECT `id`, `type`, `address_naming`, `full_address` FROM `shippingAddress` WHERE customer_id = '$shipid'");
                                    $i = 1;
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel" style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            แก้ไขที่อยู่การจัดส่ง 
                                                        </div>
                                                        <!-- ตารางรายการติดตาม -->
                                                        <div class="row">
                                                            <div class="col-md-12">

                                                                <label for="addtype">ประเภทที่อยู่อาศัย:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
                                                                <div class="form-group" >
                                                                    <select name="addtype" id="addtype" class="col-sm-12" required>
                                                                        <option value="อพาร์ทเมนท์" <?php if ($type == "อพาร์ทเมนท์") echo 'selected="selected"'; ?>>อพาร์ทเมนท์</option>
                                                                        <option value="สถานที่ราชการ" <?php if ($type == "สถานที่ราชการ") echo 'selected="selected"'; ?>>สถานที่ราชการ</option>
                                                                        <option value="มหาวิทยาลัย" <?php if ($type == "มหาวิทยาลัย") echo 'selected="selected"'; ?>>มหาวิทยาลัย</option>
                                                                        <option value="โรงพยาบาล" <?php if ($type == "โรงพยาบาล") echo 'selected="selected"'; ?>>โรงพยาบาล</option>
                                                                        <option value="โรงแรม" <?php if ($type == "โรงแรม") echo 'selected="selected"'; ?>>โรงแรม</option>
                                                                        <option value="บ้าน" <?php if ($type == "บ้าน") echo 'selected="selected"'; ?>>บ้าน</option>
                                                                        <option value="ตลาด" <?php if ($type == "ตลาด") echo 'selected="selected"'; ?>>ตลาด</option>
                                                                        <option value="โรงเรียน"<?php if ($type == "โรงเรียน") echo 'selected="selected"'; ?>>โรงเรียน</option>
                                                                        <option value="ร้านค้า" <?php if ($type == "ร้านค้า") echo 'selected="selected"'; ?>>ร้านค้า</option>
                                                                        <option value="วัด" <?php if ($type == "วัด") echo 'selected="selected"'; ?>>วัด</option>
                                                                        <option value="อื่นๆ" <?php if ($type == "อื่นๆ") echo 'selected="selected"'; ?>>อื่นๆ</option>
                                                                    </select>
                                                                </div>
                                                                <label for="addnaming">กรุณาใส่ข้อมูลระบุที่จัดส่งเพื่อความรวดเร็ว:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
                                                                <div class="form-group">
                                                                    <input required class="form-control" placeholder="ชื่อเรียกที่จัดส่งเพื่อความรวดเร็ว"  name="addnaming" id="addnaming" value="<?= $data5["address_naming"] ?>">
                                                                    <input type="hidden" name="addid" value="<?= $data5["id"]; ?>">
                                                                </div>
                                                                
                                                                <label for="address">รายละเอียดที่จัดส่งสินค้า:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
                                                                <div class="form-group">
                                                                    <textarea required class="form-control" placeholder="ที่จัดส่งสินค้า" rows="3"  name="address" id="address"><?= $data5["full_address"] ?></textarea>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="address">
                                                                            <div id='showaddress' class='col-sm-8' style="font-size: 14px">
                                                                                ลากวางหมุดตรงที่อยู่ของคุณ
                                                                            </div>
                                                                            <div class='col-sm-4' style="text-align: right;">
                                                                                <button id="getlocationbtn" class="btn btn-warning">
                                                                                    <span class="glyphicon glyphicon-map-marker"></span>
                                                                                    ตำแหน่งปัจจุบัน
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12" style="padding: 0 0 20px 0;">
                                                                    <div id="map" style="width: 100%; height: 300px"></div>
                                                                </div>
                                                                 <div class="col-sm-12" style="margin-top: 20px">
                                                                     <a href="/view/cus_customer_profile_shippingAddress.php"><button type="button" class="btn btn-warning col-sm-2 " style="margin-left: 450px"  >ยกเลิก</button></a>
                                                                     
                                                                     <button type="button" class="btn btn-success col-sm-2 pull-right" id="updateaddbtn"  >บันทึก</button>
                                                                </div>
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

                        </div>
                    </div>
                </div>
            </div>
        </section> 
        <div class="col-sm-12" style="padding: 0 0 20px 0;">
            <div id="map" style="display: none"></div>
        </div>


        <?php include '../template/footer.php'; ?>


        <script src="/assets/js/edit-shippingAddress.js"></script>
        <script src="/assets/js/customer-profile-change.js"></script>

    </body>
</html>
