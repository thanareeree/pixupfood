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
        <section id="head">
            <div id="myCarousel" class="carousel" style="margin-top:70px;">
                <!-- Indicators -->
                <div class="item">
                    <img src="/assets/images/slide/aa.png" class="img-responsive">
                    <div class="container">
                        <div class="carousel-caption-new">
                            <div class="RestaurantHeader">
                                <?= $resdata["name"] ?>
                            </div>
                        </div>
                    </div>
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
                                <li class="active">
                                    <a href="/view/res_restaurant_manage_order.php" > เกี่ยวกับรายการสั่งซื้อ</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_payment.php" >วิธีการชำระเงิน</a>
                                </li>
                                <li class="active">
                                    <a href="/view/res_manage_edit_messenger.php" > พนักงานจัดส่ง</a>
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
                                                        <form id="dataform_edit_bankaccount">
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">ชื่อ-สกุล</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="ชื่อ-สกุล" class="form-control">
                                                                </div>
                                                            </div>
                                                             <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">ชื่อ(English)*</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="ตัวอย่าง สมชาย-> Somchai" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">เบอร์โทรศัพท์</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="เบอร์โทรศัพท์" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" >
                                                                <span class="input-group" style="margin-left: 250px;">
                                                                    <button class="btn btn-success" id="savebtn" type="button" style="    margin-left: 260px;">บันทึก</button>
                                                                </span>
                                                            </div><hr>
                                                            <p>*ข้อมูลนี้จำเป็นเพราะจะต้องนำไปเป็น username ในการเข้าสู่ระบบตอนพนักงานนำสินค้าไปส่งลูกค้า </p><br>
                                                            <p>การใช้ Username ของพนักงานจัดส่ง คือ หมายเลขร้าน ตามด้วยชื่อ  </p><br>
                                                            <p>ตัวอย่าง Username คือ 12Somchai และ Password คือ เบอร์โทศัพท์ของพนักงานจัดส่ง </p>
                                                        </form>
                                                    </div>
                                                </div>
                                                 <div class="col-md-5">
                                                    <div class="card card-content" id="showdat_bankaccount">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            ข้อมูลข้อมูลของพนักงานจัดส่ง
                                                            
                                                        </div>
                                                        <p style="text-align: center;font-size: 20px">ยังไม่มีข้อมูล</p>
                                                        
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

           
        });
    </script>
</body>
</html>
