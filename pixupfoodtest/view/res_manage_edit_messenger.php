<?php
include '../api/islogin.php';
include '../dbconn.php';
?>




<html>
    <head>
        <title>Pixupfood - Restaurant Setting Management</title>
        <?php include '../template/customer-title.php'; ?>

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
        <form>
            <input type="hidden" id="resIdvalue" value="<?= $resid ?>">
        </form>
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
                    <button type="button" id="orders" class="btn btn-default" >
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
                    <button type="button" id="editres" class="btn btn-warning">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        <div class="hidden-xs">การตั้งค่า</div>
                    </button>
                </a>
            </div>
        </div>
    </scetion>
    <!--End Menu Item-->


    <section>
        <div class="container" style="margin-top: 50px;margin-bottom: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li >
                                    <a href="/view/res_restaurant_manage_edit.php" >ทั่วไป </a>
                                </li>
                                <li >
                                    <a href="/view/res_manage_edit_order.php" > เกี่ยวกับรายการสั่งซื้อ</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_payment.php" >วิธีการชำระเงิน</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_deliveryplace.php" >พื้นที่จัดส่งสินค้า</a>
                                </li>
                                <li class="active">
                                    <a href="/view/res_manage_edit_messenger.php" > พนักงานจัดส่ง</a>
                                </li>
                                <li >
                                    <a href="/view/res_manage_edit_promotion.php" >โปรโมชั่น</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_4"><!--พนักงานส่ง-->
                                    <div class="page-header"style="margin-top: 20px;">
                                        <span style="font-size: 40px">ข้อมูลเกี่ยวกับพนักงานจัดส่ง</span>
                                    </div>
                                    <div class="card">
                                        <div class="card-content">
                                            <span style="font-size: 35px;">ตั้งค่าทั่วไป</span>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="card card-content" id="showdat_bankaccount">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            เพิ่มข้อมูลของพนักงานจัดส่ง

                                                        </div>
                                                        <form action="/restaurant/add-messenger.php" method="post">
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">ชื่อผู้ใช้ *,**</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="ชื่อผู้ใช้" class="form-control" name="username">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">รหัสผ่าน *</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="password" placeholder="กรุณาใส่ตัวเลข 6-8 หลัก" class="form-control" name="password">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">ชื่อ-นามสกุล *</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="กรุณาระบุชื่อ-นามสกุล ตัวอย่าง สมชาย ขายอาหาร" class="form-control" name="name">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">หมายเลขโทรศัพท์ *</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="กรุณาระบุหมายเลขโทรศัพท์" class="form-control" name="tel">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" >
                                                                <span class="input-group" style="margin-left: 250px;">
                                                                    <button class="btn btn-success" id="savebtn" type="submit" style="    margin-left: 260px;">บันทึก</button>
                                                                </span>
                                                            </div><hr>
                                                            <p style="color: red">* จำเป็นต้องระบุข้อมูลในช่องนั้นๆ </p><br>
                                                            <p>** ชื่อผู้ใช้จะถูกกำหนดด้วยหมายเลขร้านค้านำหน้าชื่อผู้ใช้ที่ตั้งเสมอ เช่น ตั้งชื่อผู้ใช้ว่า "somchai" และหมายเลขร้านค้าคือ 999</p><br>
                                                            <p>&nbsp;&nbsp;&nbsp;&nbsp;จะได้ชื่อผู้ใช้คือ "999somchai" </p>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card card-content" id="showdat_bankaccount">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            ข้อมูลข้อมูลของพนักงานจัดส่ง

                                                        </div>

                                                        <table class="table" id="task-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>ชื่อผู้ใช้</th>
                                                                    <th>รายละเอียด</th>
                                                                    <th>ลบ</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $res = $con->query("select * from messenger where restaurant_id = '$resid'");
                                                                if ($res->num_rows == 0) {
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="3" class="warning">
                                                                            <p style="text-align: center;font-size: 20px">ยังไม่มีข้อมูล</p>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                } else {
                                                                    while ($data = $res->fetch_assoc()) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $data["username"] ?></td>
                                                                            <td>
                                                                                <ul style="list-style: none; padding: 0;">
                                                                                    <?php
                                                                                    $id = $data["id"];
                                                                                    $resName = $con->query("select * from messenger where id = '$id'");

                                                                                    while ($dataName = $resName->fetch_assoc()) {

                                                                                        echo '<li>ชื่อ:&nbsp;' . $dataName["name"] . '</li>';
                                                                                        echo '<li>เบอร์:&nbsp;' . $dataName["tel"] . '</li>';
                                                                                    }
                                                                                    ?> 
                                                                                </ul>
                                                                            </td>
                                                                            <td>
                                                                                <p class="remove"  data-id="<?= $data["id"] ?>" style="color: red" data-toggle="tooltip" data-placement="top" title="ลบรายการนี้?">
                                                                                    <i class="glyphicon glyphicon-trash"></i>
                                                                                </p>
                                                                            </td>

                                                                        </tr>
                                                                        <?php
                                                                    }
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- start footer -->
    <?php include '../template/footer.php'; ?>

    <script>
        $(document).ready(function () {
            $(".btn-pref .btn").click(function () {
                $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
                $(".tab").addClass("active"); // instead of this do the below 
                $(this).removeClass("btn-default").addClass("btn-warning");
            });
            $(".remove").click(function (e) {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "/restaurant-setting/delete-messnger.php?messid=" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if(data.result == '1'){
                            document.location.reload();
                        }else{
                            alert(data.error);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
