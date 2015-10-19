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
                                                            ข้อมูลโปรโมชั่นร้านทั้งหมด
                                                        </div>
                                                        <form id="showdata">
                                                            <?php
                                                            $bankRes = $con->query("select * from bank_account where restaurant_id = '$resid'");
                                                            if ($bankRes->num_rows == 0) {
                                                                ?>
                                                                <h4 style="    text-align: center;" id="nodata">ยังไม่ได้บัญทึกข้อมูล</h4>
                                                                <?php
                                                            } else {
                                                                while ($bankData = $bankRes->fetch_assoc()) {
                                                                    ?>
                                                                    &nbsp;   <span style="font-size: 20px">ชื่อบัญชี: </span>
                                                                    <span style="font-size: 20px; color: orange;"> <?= $bankData["accname"] ?></span><br>
                                                                    &nbsp;   <span style="font-size: 20px">เลขที่บัญชี:</span>
                                                                    <span style="font-size: 20px; color: orange;"><?= $bankData["accNo"] ?> </span><br>
                                                                    &nbsp;   <span style="font-size: 20px">ธนาคาร: </span>
                                                                    <span style="font-size: 20px; color: orange;"><?= $bankData["bank"] ?></span><br>
                                                                    <hr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </form>
                                                        
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

            $('#imagerest').on('change', function (e) {
                var filename = $('#imagerest').val();
                var fname = filename.substring(12);
                var name = "File: " + fname;
                $("#uploadtext").html(name);
                $("#chooseimgbtn").hide();
                $("#uploadimgbtn").show();
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
                            $("#showdata").append('&nbsp;   <span style="font-size: 20px">ชื่อบัญชี: </span>' +
                                    '<span style="font-size: 20px; color: orange;"> ' + data.accname + '</span><br>' +
                                    ' &nbsp;   <span style="font-size: 20px">เลขที่บัญชี:</span> ' +
                                    '<span style="font-size: 20px; color: orange;">' + data.accid + ' </span><br>' +
                                    '&nbsp;   <span style="font-size: 20px">ธนาคาร: </span>' +
                                    ' <span style="font-size: 20px; color: orange;">' + data.bankname + '</span><br><hr>');
                        } else {
                            $("#showerror").html(data.error);
                        }
                    }
                });
                e.preventDefault();
                return false;
            });
        });
    </script>

</body>
</html>
