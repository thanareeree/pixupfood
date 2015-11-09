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
                        <div class="hidden-xs">ตารางการจัดส่งสินค้า</div>
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
                                <li >
                                    <a href="/view/res_manage_edit_payment.php" >วิธีการชำระเงิน</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_deliveryplace.php" >พื้นที่จัดส่งสินค้า</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_messenger.php" > พนักงานจัดส่ง</a>
                                </li>
                                <li class="active">
                                    <a href="/view/res_manage_edit_promotion.php" >โปรโมชั่น</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_3"><!--การชำระเงิน-->
                                    <div class="page-header"style="margin-top: 20px;">
                                        <span style="font-size: 40px">เกี่ยวกับโปรโมชั่น</span>
                                    </div>
                                    <div class="card">
                                        <div class="card-content">
                                            <span style="font-size: 35px;">ตั้งค่าทั่วไป</span>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card card-content" id="showdat_bankaccount" >
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            เพิ่มโปรโมชั่นร้าน
                                                            <div class="pull-right">
                                                            </div>
                                                        </div>
                                                        <form id="promotion" method="post" action="/restaurant/add-promotion.php">
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">โปรโมชั่น</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <select class="form-control"id="promotionselect" name="promotionselect" required="">
                                                                        <option value="0">--ตัวเลือก--</option>
                                                                        <?php
                                                                        $promotionRes = $con->query("select * from promotion_main ");

                                                                        while ($promotionData = $promotionRes->fetch_assoc()) {
                                                                            ?>
                                                                            <option value="<?= $promotionData["id"] ?>"><?= $promotionData["name"] ?> </option>
                                                                            <?php
                                                                        }
                                                                        ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" >
                                                                <label class="col-sm-2 control-label" for="textinput">
                                                                    <p style="color:  red;font-size: 20px" id="showerror"></p>
                                                                </label>
                                                            </div>

                                                            <div class="col-md-12" id="showdetailpromotion">

                                                            </div>

                                                            <div class="form-group" >
                                                                <span class="input-group" style="margin-left: 250px;">
                                                                    <button class="btn btn-success" id="savebtn" type="submit" style="    margin-left: 175px;">บันทึก</button>
                                                                </span>

                                                            </div>
                                                        </form>
                                                    </div>



                                                </div>




                                                <div class="col-md-6">
                                                    <div class="card card-content" id="showdat_bankaccount">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            ข้อมูลโปรโมชั่นร้านทั้งหมด
                                                        </div>
                                                        <table class="table" id="task-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>ชื่อโปรโมชั่น</th>
                                                                    <th>รายละเอียด</th>
                                                                    <th>ลบ</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $res = $con->query("select * from promotion where restaurant_id = '$resid'");
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
                                                                            <td>
                                                                                <?php
                                                                                $id = $data["promotion_main_id"];
                                                                                $resName = $con->query("select * from promotion_main where id = '$id'");
                                                                                while ($dataName = $resName->fetch_assoc()) {
                                                                                    echo $dataName["name"];
                                                                                }
                                                                                ?> 
                                                                            </td>
                                                                            <td>
                                                                                <ul style="list-style: none; padding: 0;">
                                                                                    <?php
                                                                                    echo '<li>'. $data["description"] . '</li>';
                                                                                    echo '<li>เริ่ม:&nbsp;' . $data["start_time"] . '</li>';
                                                                                      echo '<li>หมดเขต:&nbsp;' . $data["end_time"] . '</li>';
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
    <script src="/assets/js/restaurant_promotion.js"></script>

</body>
</html>
