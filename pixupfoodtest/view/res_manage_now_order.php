<?php
include '../api/islogin.php';
include '../view/navbar.php';
include '../dbconn.php';
?>


<html>
    <head>
        <title>Pixupfood - Restaurant Order Management</title>

        <?php
        include '../template/customer-title.php';
        ?>
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

        <!-- start profile -->
        <section id="RestaurantHeader">
            <div class="overlay">
                <div class="container text-center">
                    <h1><i class="glyphicon glyphicon-cutlery"></i>&nbsp;<?= $resdata["name"] ?></h1>
                </div>
            </div>
        </section>

        <!-- Menu Bar-->
        <!--Menu Item-->
    <scetion id="menu">
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_order.php">
                    <button type="button" id="orders" class="btn btn-warning" >
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
                    <button type="button" id="editres" class="btn btn-default">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        <div class="hidden-xs">การตั้งค่า</div>
                    </button>
                </a>
            </div>
        </div>
    </scetion>
    <!--End Menu Item-->
    <div class="well white">
        <div class="tab-content">
            <!-- Start Content in Order List--> 
            <div class="tab-pane fade in active" id="tab2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">


                            <div class="tabbable-panel">
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs ">
                                        <li >
                                            <a href="/view/res_restaurant_manage_order.php" >รายการสั่งซื้อใหม่ </a>
                                        </li>
                                        <li class="active">
                                            <a href="/view/res_manage_now_order.php" >รายการสั่งซื้ออยู่ระหว่างการดำเนินการ </a>
                                        </li>
                                        <li>
                                            <a href="/view/res_manage_history_order.php" >รายการสั่งซื้อเสร็จสมบูรณ์ </a>
                                        </li>
                                    </ul>
                                    <!-- Tab 1 -->
                                    <div class="tab-content">

                                        <!-- Tab รายการอยู่ระหว่างดำเนินการ -->
                                        <div class="tab-pane active" id="tab_default_2_2">
                                            <div class="page-header" style="font-size: 40px; margin-top: 5px">
                                                รายการสั่งซื้ออยู่ระหว่างดำเนินการ  

                                            </div>
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header" style="font-size: 30px; margin-top: 5px">รายการทั้งหมด 
                                                        <div class="pull-right">
                                                            <p class="text-center">
                                                                <span style="font-size: 20px; color: red">1 การเตือน</span></p>
                                                        </div>
                                                    </div>
                                                    <!-- ตารางรายการอยู่ระหว่างดำเนินการ -->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <form action="#" method="get">
                                                                <div class="input-group">
                                                                    <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                                                    <input class="form-control" id="system-search3" name="q" placeholder="ค้นหาข้อมูลในตารางนี้" required>
                                                                    <span class="input-group-btn">
                                                                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table class="table table-list-search3">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ลำดับ</th>
                                                                        <th>เลขที่รายการ</th>
                                                                        <th>ชื่อลูกค้า</th>
                                                                        <th>ชนิดอาหาร</th>
                                                                        <th>จำนวน(ขุด)</th>
                                                                        <th>วัน/เวลาที่ลูกค้านัดรับ</th>
                                                                        <th>สถานะ</th>
                                                                        <th>รายละเอียด</th>
                                                                        <th>เปลี่ยนสถานะ</th>
                                                                        <th>หมายเหตุ</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="table table-condensed table-hover" >
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>102458</td>                         
                                                                        <td>คุณธิติ มหาโยธารักษ์</td>
                                                                        <td>ข้าวกล้อง+ผัดกระเพาหมู+ไข่ดาว</td>
                                                                        <td>50</td>
                                                                        <td>12-11-2015 12:30</td>
                                                                        <td>เตรียมวัตถุดิบ</td>
                                                                        <td class="text-center"><a class="btn btn-info btn-xs" ><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                        <td class="text-center"><a class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-refresh"></span> เปลี่ยน</a></td>
                                                                        <td>-</td>
                                                                    </tr>
                                                                    <tr class="danger">
                                                                        <td>2</td>
                                                                        <td>158642</td>
                                                                        <td>คุณเอนก อนงค์พงศ์ไพร</td>
                                                                        <td>ข้าวหอมมะลิ+หมูกระเทียม+ผัดผักรวม</td>
                                                                        <td>30</td>
                                                                        <td>30-9-2015 13:30</td>
                                                                        <td>ปรุงอาหาร</td>
                                                                        <td class="text-center"><a class="btn btn-info btn-xs nowOrderView" id="nowOrderView"  ><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                        <td class="text-center"><a class="btn btn-warning btn-xs" ><span class="glyphicon glyphicon-refresh"></span> เปลี่ยน</a></td>

                                                                        <td>ขอยกเลิกรายการ</td>
                                                                    </tr>
                                                                   
                                                                </tbody>
                                                            </table>   
                                                        </div>
                                                    </div>
                                                    <!-- จบตารางรายการอยู่ระหว่างดำเนินการ -->


                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Tab 2 -->

                                        <!-- modal ตารางนะยูวว  -->
                                      



                                        <!-- Detial -->
                                        <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel">

                                                            <span style="font-size: 30px; margin-top: 5px;">รายละเอียดของรายการหมายเลข: </span>
                                                            <span style="font-size: 30px; margin-top: 5px; color: orange">102458 </span>     

                                                        </span>
                                                    </div>
                                                    <div id="showModalDetail">
                                                        
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- รูปสลิป -->
                                        <div class="modal fade pop-up-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-2" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <span class="modal-title" id="myLargeModalLabel-2" style="font-size: 30px">สลิปประกอบรายการเลขที่</span>  <span style="font-size: 30px; color: orange"> 102458</span>
                                                    </div>
                                                    <div class="modal-body">           
                                                        <span style="font-size: 15px; color: red;">ยอดเงินที่ปรากฎในระบบเป็นเพียงการคำนวณจากเงื่อนไขต่างๆในระบบอาจไม่ใช่ยอดเงินจริง กรุณาตรวจสอบข้อมูลภายในสลิปอีกครั้ง อย่างไรก็ตามหากพบปัญหากรุณาติดต่อ </span>  
                                                        <a href="#" data-toggle="modal" data-target='#text' style="color: blue;" >support@pixupfood.com </a> 
                                                        <hr>
                                                        <span style="font-size: 20px"> โอนเงินมัดจำผ่านธนาคาร: </span>
                                                        <span style="font-size: 15px; color: orange;"> กสิกรไทย เลขที่ 12-1231212-1</span>  <br> 
                                                        <span style="font-size: 20px"> จำนวนเงิน:</span> <span style="font-size: 15px; color: orange;">400.00 บาท</span>  <br>
                                                        <span style="font-size: 20px"> วัน/เวลาที่ระบบบันทึกสลิป:</span> <span style="font-size: 15px; color: orange;">12-10-2015 14:30</span>  <br>
                                                        <hr>
                                                        <img src="../assets/images/sample slip.jpg" class="img-responsive img-rounded center-block" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- จบรูปสลิบ -->
                                        <div class="modal fade" id="text" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel"><div style="font-size: 30px;">รายงาน</div></span>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span style="font-size: 15px;">ส่งถึง: support@pixupfood.com </span><br>
                                                        <span style="font-size: 15px;">เรื่อง: สลิปประกอบรายการเลขที่ 102458 </span>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-12">

                                                                <textarea name="message" placeholder="พิมพ์ข้อความของคุณที่นี่..." rows="5" style=" width: 100%"></textarea>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                        <button type="button" class="btn btn-primary" >ส่ง</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Detail --> 


                                        <!-- change status -->
                                        <div class="modal fade" id="changestatus" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px;">เปลี่ยนแปลงสถานะ</div></span>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                                                            <div class="btn-group" role="group">
                                                                <button type="button" id="acceptlist" class="btn btn-warning" >รับรายการ</button>
                                                            </div>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" id="ingredentOrder" class="btn btn-default" >เตรียมวัตถุดิบ</button>
                                                            </div>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" id="packageOrder" class="btn btn-default" >บรรจุสินค้า</button>
                                                            </div>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" id="deliveryOrder" class="btn btn-default" >เตรียมจัดส่ง</button>
                                                            </div>
                                                        </div>


                                                        <div class="tab-content">
                                                            <div class="tab-pane fade in" id="5">
                                                                <div class="page-header" style="font-size: 20pt; margin-top: 20px;">เลือกผู้จัดส่ง</div>
                                                                <div class="row" style="margin-top: 0px;">
                                                                    <div class="col-md-12"style="margin-top: 0px;">
                                                                        <span class="form-group">
                                                                            <select class="form-control" id="sel1"style="width: 100%">
                                                                                <option>108Suchart</option>
                                                                                <option>108Arnong</option>
                                                                            </select>
                                                                        </span>   
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row" style="margin-top: 0px;">
                                                                    <div class="col-md-12" style="margin-top: 0px;">
                                                                        <div class="card">
                                                                            <div class="card-content">
                                                                                <span style="font-size: 20px">ชื่อผู้ใช้ของผู้จัดส่ง: </span>
                                                                                <span style="font-size: 20px; color: orange;"> 108Suchart </span><br>

                                                                                <span style="font-size: 20px">ชื่อ: </span>
                                                                                <span style="font-size: 20px; color: orange;"> คุณสุชาติ ปานขำ </span><br>

                                                                                <span style="font-size: 20px">โทรศัพท์: </span>
                                                                                <span style="font-size: 20px; color: orange;"> 0812345678 </span><br>

                                                                                <span style="font-size: 20px">อื่นๆ: </span>
                                                                                <span style="font-size: 20px; color: orange;">วินหน้าปากซอย </span><br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                        <button type="button" class="btn btn-primary" id="sendOrderSave">บันทึก</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- change status -->



                                        <!-- จบ modal ตารางนะยูวว -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- start footer -->
    <?php include '../template/footer.php'; ?>


    <!-- ตารางรายการออเดอร์ -->
    <script src="/assets/js/OrderSearch.js"></script>
  <!--  <script src="/assets/js/ui-bootstrap-tpls-0.13.4.min.js"></script>-->

    <script>
    
    $(document).ready(function () {
    $(".btn-pref .btn").click(function () {
        $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
        $(this).removeClass("btn-default").addClass("btn-warning");
    });

    function fetchdataShowNowOrder() {
        $.ajax({
            url: "/restaurant/.php",
            type: "POST",
            data: {"resid": $('#residValue').val()},
            dataType: "html",
            success: function (returndata) {
                $("#showdataNowOrder").html(returndata);
            }
        });
    }
    fetchdataShowNowOrder();



    $('#nowOrderView').on("click", function (e) {
        /*var viewid = $(this).attr("id");
        var id = viewid.replace("nowOrderView", "");
        $("#showorderid").html(id);*/

        $.ajax({
            url: "/restuarant/order-detail-now-modal.php",
            type: "POST",
            data: {"id": id},
            dataType: "html",
            success: function (returndata) {
                $("#showModalDetail").html(returndata);
                $("#detail").modal("show");
            }
        });
    });

    


});

</script>


</body>
</html>