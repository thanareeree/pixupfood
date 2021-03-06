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
        <link rel="stylesheet" href="/assets/css/check-radio.css">
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
                                <li class="active">
                                    <a href="/view/res_manage_edit_payment.php" >วิธีการชำระเงิน</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_deliveryplace.php" >พื้นที่จัดส่งสินค้า</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_messenger.php" > พนักงานจัดส่ง</a>
                                </li>
                                <li >
                                    <a href="/view/res_manage_edit_promotion.php" >โปรโมชั่น</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_3"><!--การชำระเงิน-->
                                    <div class="page-header"style="margin-top: 20px;">
                                        <span style="font-size: 40px">เกี่ยวกับวิธีการชำระเงิน</span>
                                    </div>
                                    <div class="card">
                                        <div class="card-content">
                                            <span style="font-size: 35px;">ตั้งค่าทั่วไป</span>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <?php
                                                    $resPaymentRes = $con->query("select payment_type.id, payment_type.description "
                                                            . "FROM mapping_payment_type "
                                                            . "LEFT JOIN payment_type ON mapping_payment_type.payment_type_id = payment_type.id "
                                                            . "where mapping_payment_type.restaurant_id = '$resid' ");


                                                    if ($resPaymentRes->num_rows == null) {
                                                        ?>
                                                        <div class="card card-content" >
                                                            <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                                รูปแบบการชำระเงิน
                                                            </div>
                                                            <form id="dataform_edit_payment" action="/restaurant/add-payment-type.php?resId=<?= $resid ?>" method="post">
                                                                <?php
                                                                $paymentRes = $con->query("SELECT payment_type.id, payment_type.description FROM payment_type ");
                                                                while ($paymentData = $paymentRes->fetch_assoc()) {
                                                                    ?>
                                                                    <div class="input-group col-md-8" style="margin: 10px 120px;"  >
                                                                        <label class="Form-label--tick">
                                                                            <input type="checkbox"  class=" Form-label-checkbox" name="paymentData[]" value="<?= $paymentData["id"] ?>">
                                                                            <span class="Form-label-text" style="font-size: 18px" >&nbsp;<?= $paymentData["description"] ?></span>
                                                                        </label>
                                                                    </div>
                                                                <?php } ?>
                                                                <span class="input-group" style="margin-left: 250px;">
                                                                    <button class="btn btn-success" id="savebtn" type="submit">บันทึก</button>
                                                                </span><hr>
                                                                *ค่ามัดจำ 20% ต่อรายยการสั่งซื้อนั้น จำเป็นต้องมีเพื่อรักษาผลประโยชน์ของท่านเอง
                                                            </form>
                                                        </div>


                                                    <?php } else { ?>
                                                        <div class="card card-content" id="paymentType">
                                                            <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                                รูปแบบการชำระเงิน
                                                                <div class="pull-right">
                                                                    <p class="text-center">
                                                                        <a  href="#" id="editbtn">
                                                                            <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                            <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                        </a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div id="dataform_foodbox">
                                                                <?php
                                                                while ($resPaymentData = $resPaymentRes->fetch_assoc()) {
                                                                    ?>
                                                                    <div class="input-group col-md-6" style="margin: 10px 120px;" id="foodboxtypeShow" >
                                                                        <ul>
                                                                            <li style="font-size: 18px"> <?= $resPaymentData["description"] ?></li>
                                                                        </ul>
                                                                    </div>
                                                                <?php } ?>

                                                            </div>
                                                            <hr>
                                                            *ค่ามัดจำ 20% ต่อรายยการสั่งซื้อนั้น จำเป็นต้องมีเพื่อรักษาผลประโยชน์ของท่านเอง
                                                        </div>
                                                        <div class="card card-content" id="editPaymentType" style="display: none">
                                                            <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                                แก้ไขรูปแบบการชำระเงิน
                                                            </div>
                                                            <div id="dataform_foodbox">
                                                                <form method="post" action="/restaurant-setting/edit-paymenttype.php">
                                                                    <?php
                                                                    $resPaymentRes2 = $con->query("select payment_type.id, payment_type.description "
                                                                            . "FROM mapping_payment_type "
                                                                            . "LEFT JOIN payment_type ON mapping_payment_type.payment_type_id = payment_type.id "
                                                                            . "where mapping_payment_type.restaurant_id = '$resid' order by  payment_type_id");

                                                                    $payRes = $con->query("SELECT payment_type.id, payment_type.description FROM payment_type order by  id");
                                                                    while ($resPaymentData2 = $resPaymentRes2->fetch_assoc()) {
                                                                        $resTypePayid = $resPaymentData2["id"];
                                                                        while ($payData = $payRes->fetch_assoc()) {
                                                                            $type = $payData["id"];
                                                                            if ($resPaymentRes2->num_rows == 2) {
                                                                                ?>
                                                                                <div class="input-group col-md-8" style="margin: 10px 120px;"  >
                                                                                    <label class="Form-label--tick">
                                                                                        <input type="checkbox" class=" Form-label-checkbox" name="paymentData[]" value="<?= $payData["id"] ?>" checked="">
                                                                                        <span class="Form-label-text" style="font-size: 18px" >&nbsp;<?= $payData["description"] ?></span>
                                                                                    </label>
                                                                                </div>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <div class="input-group col-md-8" style="margin: 10px 120px;"  >
                                                                                    <label class="Form-label--tick">
                                                                                        <input type="checkbox" class=" Form-label-checkbox" name="paymentData[]" value="<?= $payData["id"] ?>" <?= ($type == $resTypePayid) ? "checked" : "" ?>>
                                                                                        <span class="Form-label-text"style="font-size: 18px">&nbsp;<?= $payData["description"] ?></span>
                                                                                    </label>
                                                                                </div>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <button type="submit" class="btn btn-success" style="margin-left: 250px;" >บันทึก</button>
                                                                </form> 
                                                            </div>
                                                            <hr>
                                                            *ค่ามัดจำ 20% ต่อรายยการสั่งซื้อนั้น จำเป็นต้องมีเพื่อรักษาผลประโยชน์ของท่านเอง
                                                        </div>
                                                    <?php } ?>


                                                    <div class="card card-content" id="showdat_bankaccount" >
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            เพิ่มข้อมูลบัญชีธนาคาร
                                                            <div class="pull-right">
                                                            </div>
                                                        </div>
                                                        <form id="dataform_add_bankaccount" method="post" >
                                                            <input type="hidden" id="resIdvalue" name="resIdvalue" value="<?= $resid ?>">

                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">ชื่อบัญชี</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="ชื่อบัญชี" class="form-control" id="accountname" name="accountname" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" >
                                                                <label class="col-sm-2 control-label" for="textinput">เลขที่บัญชี</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="เลขที่บัญชี xxx-xxxxxx-x" class="form-control" id="accountid" name="accountid" maxlength="10" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">ธนาคาร</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <select class="form-control"id="bankname" name="bankname" required="">
                                                                        <option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
                                                                        <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
                                                                        <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
                                                                        <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
                                                                        <option value="ธนาคารกรุงศรีอยุธยา">ธนาคารกรุงศรีอยุธยา</option>
                                                                        <option value="ธนาคารธนชาต">ธนาคารธนชาต</option>
                                                                        <option value="ธนาคารทหารไทย">ธนาคารทหารไทย </option>

                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="form-group" >
                                                                <label class="col-sm-2 control-label" for="textinput">
                                                                    <p style="color:  red;font-size: 20px" id="showerror"></p>
                                                                </label>
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
                                                            ข้อมูลบัญชีธนาคาร

                                                        </div>
                                                        <table class="table table-striped table-bordered" id="task-table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">รายละเอียด</th>
                                                                    <th class="text-center">ลบ</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="showPlace">
                                                                <?php
                                                                $bankRes = $con->query("select * from bank_account where restaurant_id = '$resid'");
                                                                while ($bankData = $bankRes->fetch_assoc()) {
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            &nbsp;   <span style="font-size: 16px">ชื่อบัญชี: </span>
                                                                            <span style="font-size: 16px; color: orange;"> <?= $bankData["accname"] ?></span><br>
                                                                            &nbsp;   <span style="font-size: 16px">เลขที่บัญชี:</span>
                                                                            <span style="font-size: 16px; color: orange;"><?= $bankData["accNo"] ?> </span><br>
                                                                            &nbsp;   <span style="font-size: 16px">ธนาคาร: </span>
                                                                            <span style="font-size: 16px; color: orange;"><?= $bankData["bank"] ?></span><br>
                                                                        </td>
                                                                        <td class = "text-center">
                                                                            <p class = "remove" data-id = "<?= $bankData["id"] ?>" style = "color: red" data-toggle = "tooltip" data-placement = "top" title = "ลบรายการนี้?">
                                                                                <i class = "glyphicon glyphicon-trash"></i>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table><hr>
                                                        <span id="showinfo">*เพื่อเป็นประโยชน์สำหรับการชำระค่าสินค้า</span>
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

            $("#editbtn").click(function (e) {
                $("#editPaymentType").show();
                $("#paymentType").hide();
                e.preventDefault();
                return false;
            });

            $("#dataform_add_bankaccount").on('submit', function (e) {
                $.ajax({
                    url: "/restaurant/add-bankaccount.php",
                    type: "POST",
                    data: $("#dataform_add_bankaccount").serializeArray(),
                    dataType: "json",
                    success: function (data) {
                        if (data.result == 1) {
                            $("#dataform_add_bankaccount").trigger("reset");
                            $("#nodata").hide();
                            fetchData();

                        } else {
                            $("#showerror").html(data.error);
                        }
                    }
                });
                e.preventDefault();
                return false;
            });

            function fetchData() {
                $.ajax({
                    url: "/restaurant-setting/fetch-bankaccount.php",
                    dataType: "html",
                    success: function (data) {
                        $("#showPlace").html("");
                        $("#showPlace").html(data);
                        $('[data-toggle="tooltip"]').tooltip();
                        $(".remove").click(function (e) {
                            var id = $(this).attr("data-id");
                            $.ajax({
                                url: "/restaurant-setting/delete-bankaccount.php?delid=" + id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    if (data.result == '1') {
                                        fetchData();
                                        // document.location.reload();
                                    } else {
                                        alert(data.error);
                                    }
                                }
                            });
                        });

                    }
                });
            }
            fetchData();


            $(".remove").click(function (e) {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "/restaurant-setting/delete-bankaccount.php?delid=" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.result == '1') {
                            fetchData();
                            // document.location.reload();
                        } else {
                            alert(data.error);
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>
