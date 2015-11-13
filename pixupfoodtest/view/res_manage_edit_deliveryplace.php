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
                                <li class="active">
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
                                        <span style="font-size: 40px">เกี่ยวกับพื้นที่จัดส่งสินค้า</span>
                                    </div>
                                    <div class="card">
                                        <div class="card-content">
                                            <span style="font-size: 35px;">ตั้งค่าทั่วไป</span>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card card-content" id="showdat_bankaccount" >
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            เพิ่มข้อมูลพื้นที่จัดส่งสินค้า
                                                            <div class="pull-right">
                                                            </div>
                                                        </div>
                                                        <form id="deliveryplace" method="post" >
                                                            <input type="hidden" id="resIdvalue" name="resIdvalue" value="<?= $resid ?>">

                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">จังหวัด</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <select class="form-control"id="provincelist" name="provincelist" required="">
                                                                        <option value="0">-- เลือกจังหวัด --</option>
                                                                        <?php
                                                                        $res = $con->query("SELECT PROVINCE_ID, PROVINCE_NAME FROM `data_province` ");
                                                                        while ($data = $res->fetch_assoc()) {
                                                                            ?>
                                                                            <option value="<?= $data['PROVINCE_ID'] ?>"> <?= $data['PROVINCE_NAME'] ?> </option>
                                                                        <?php } ?>


                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">เขต/อำเภอ</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <select class="form-control"id="districtlist" name="districtlist" required="">
                                                                        <option value="0">-- เลือกเขต/อำเภอ --</option>
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
                                                    <div class="card card-content" id="showEditDelivery" >
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            ข้อมูลพื้นที่จัดส่งสินค้า
                                                        </div>
                                                        <table class="table table-striped table-bordered" id="task-table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">เขตพื้นที่จัดส่งสินค้า</th>
                                                                    <th class="text-center">ลบ</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="showPlace">
                                                                <?php
                                                                $placeRes2 = $con->query("SELECT data_district.district_name, delivery_place.id "
                                                                        . "FROM data_district "
                                                                        . "RIGHT JOIN delivery_place ON delivery_place.district_id = data_district.district_id "
                                                                        . "WHERE delivery_place.restaurant_id = '$resid'");
                                                                while ($placeData2 = $placeRes2->fetch_assoc()) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $placeData2["district_name"] ?></td>
                                                                        <td class="text-center">
                                                                            <p class="remove"  data-id="<?= $placeData2["id"] ?>" style="color: red" data-toggle="tooltip" data-placement="top" title="ลบรายการนี้?">
                                                                                <i class="glyphicon glyphicon-trash"></i>
                                                                            </p>
                                                                        </td>

                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                          <hr>
                                                    <div>**หากไม่ได้บันทึกข้อมูล ระบบจะถือว่า ท่านจัดส่งสินค้าทุกพื้นที่ที่ลูกค้ากำหนดในทุกรายการสั่งซื้อ</div>
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
            $('[data-toggle="tooltip"]').tooltip();
            $("#provincelist").change(function () {
                $.ajax({
                    url: "/restaurant-setting/districtList.php",
                    type: "POST",
                    data: {"province_id": $("#provincelist").val()},
                    dataType: "html",
                    success: function (data) {
                        $("#districtlist").html(data);
                    }
                });
            });
            $("#editbtn").click(function (e) {
                $("#showDelivery").hide();
                $("#showEditDelivery").show();
                e.preventDefault();
                return false;
            });

            $("#savebtn").on("click", function (e) {
                $.ajax({
                    url: "/restaurant-setting/add-delivery-place.php",
                    type: "POST",
                    data: {"province_id": $("#provincelist").val(), "district_id": $("#districtlist").val()},
                    dataType: "json",
                    success: function (data) {
                        if (data.result == 1) {
                            $("#noDelivery").hide();
                            $("#showEditDelivery").show();
                            $("#deliveryplace").trigger("reset");
                            $("#districtlist").html('<option value="0">-- เลือกเขต/อำเภอ --</option>');
                            $("#nodata").hide();
                            fetchData();
                            //$("#showdata").append(' <p style="font-size: 16px;font-weight: normal; color: orange;"">' + data.name + '</p>');
                        } else {
                            alert(data.error)
                        }
                    }
                });
                e.preventDefault();
                return false;
            });

            $(".remove").click(function (e) {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "/restaurant-setting/delete-deliveryplace.php?delid=" + id,
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

            function fetchData() {
                $.ajax({
                    url: "/restaurant-setting/fetch-deliveryplace.php",
                    dataType: "html",
                    success: function (data) {
                        $("#showPlace").html("");
                        $("#showPlace").html(data);
                        $('[data-toggle="tooltip"]').tooltip();
                        $(".remove").click(function (e) {
                            var id = $(this).attr("data-id");
                            $.ajax({
                                url: "/restaurant-setting/delete-deliveryplace.php?delid=" + id,
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
            }fetchData();

        });
    </script>


</body>
</html>
