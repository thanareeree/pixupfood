<?php
include '../dbconn.php';
$order_id = @$_POST["order_id"];

$orderRes = $con->query("");
$orderData = $orderRes->fetch_assoc();
$status = $orderData["status"];


$statusDetail = "";
if ($status == "1") {
    $statusDetail = "รอตอบรับ";
}  else if($status == "2"){
     $statusDetail = "เตรียมวัตถุดิบ";
}else if($status == "3"){
     $statusDetail = "บรรจุสินค้า";
}else if($status == "4"){
     $statusDetail = "เตรียมจัดส่ง";
}else if($status == "5"){
     $statusDetail = "ปฏิเสธรายการ";
}  else {
    $statusDetail = "เสร็จสิ้น";
}
?>


<div class="modal-body">
    <div class="row" style="margin-top: 0px;">
        <div class="col-md-12">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">สถานะของรายการ: </span>
                        <span style="font-size: 20px; color: orange;"><?= $statusDetail?></span><br>
                        <span style="font-size: 20px">ตอบรับรายการโดย: </span>
                        <span style="font-size: 20px; color: orange;"> <?= $dataOrder["resname"]?> </span><br>
                        <span style="font-size: 20px">ตอบรับรายการเมื่อ: </span>
                        <span style="font-size: 20px; color: orange;"> <?= $orderData["updated_status_time"]?> </span><br>
                    </div>
                </div>
                <!-- ถ้าเป็นสถานะปฏิเสธ <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">สถานะของรายการ: </span>
                        <span style="font-size: 20px; color: orange;"> ปฏิเสธรายการ </span><br>
                        <span style="font-size: 20px">ปฏิเสธรายการโดย: </span>
                        <span style="font-size: 20px; color: orange;"> นายใหญ่โภชนา </span><br>
                        <span style="font-size: 20px">ปฏิเสธรายวันที่: </span>
                        <span style="font-size: 20px; color: orange;"> 12-11-2015 </span><br>
                        <span style="font-size: 20px">ปฏิเสธรายวันที่: </span>
                        <span style="font-size: 20px; color: orange;"> 12:30 </span><br>
                    </div>
                </div> -->
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">หมายเลขสมาชิกลูกค้า: </span>
                        <span style="font-size: 20px; color: orange;"> <?= $cusData["cusid"]?> </span><br>

                        <span style="font-size: 20px">ชื่อ: </span>
                        <span style="font-size: 20px; color: orange;"> <?= $orderData["recive_name"]?> </span><br>

                        <span style="font-size: 20px">โทรศัพท์: </span>
                        <span style="font-size: 20px; color: orange;"> <?= $cusData["tel"]?> </span><br>

                        <span style="font-size: 20px">อีเมล: </span>
                        <span style="font-size: 20px; color: orange;"><?= $cusData["email"]?> </span><br>


                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">จัดส่งสินค้าโดย: </span><br>
                        <span style="font-size: 20px; color: orange;">108suchart สุชาติ ปานขำ</span><br>
                        <span style="font-size: 20px">โทรศัพท์: </span><br>
                        <span style="font-size: 20px; color: orange;">0812345678</span><br>

                        <span style="font-size: 20px">ส่งสินค้าถึงวันที่: </span><br>
                        <span style="font-size: 20px; color: orange;"> <?= $orderData["delivery_date"]?></span><br>

                        <span style="font-size: 20px">ส่งสินค้าถึงเวลา: </span><br>
                        <span style="font-size: 20px; color: orange;">  <?= $orderData["delivery_date"]?> </span><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">

                        <span style="font-size: 20px">วันที่ลูกค้านัดรับสินค้า: </span><br>
                        <span style="font-size: 20px; color: orange;"> <?= $orderData["delivery_date"]?></span><br>

                        <span style="font-size: 20px">เวลาที่ลูกค้านัดรับสินค้า: </span><br>
                        <span style="font-size: 20px; color: orange;">  <?= $orderData["delivery_time"]?> </span><br>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">สถานที่ส่งสินค้า </span>
                        <hr style="margin-top: 5px;margin-bottom: 10px;">
                        <span style="font-size: 17px"><?= $orderData["full_address"]?></span>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">รายการสินค้า </span>
                        <hr style="margin-top: 5px;margin-bottom: 10px;">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-list-search">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>รายการ</th>
                                            <th>ราคาต่อหน่วย/บาท</th>
                                            <th>จำนวน</th>
                                            <th>ราคารวม/บาท</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table table-condensed table-hover">
                                        <tr>
                                            <td>1</td>                     
                                            <td>ข้าวกล้อง</td>
                                            <td style="text-align: center">10.00</td>
                                            <td style="text-align: center">50</td>
                                            <td style="text-align: center">500.00</td>

                                        </tr>
                                        <tr>
                                            <td>4</td>                     
                                            <td>ค่าจัดส่ง</td>
                                            <td style="text-align: center">100.00</td>
                                            <td style="text-align: center">1</td>
                                            <td style="text-align: center">100.00</td>
                                        </tr>
                                        <tr class="success">
                                            <td></td>                     
                                            <td>ราคารวม</td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center">1,600.00</td>
                                        </tr>
                                        <tr class="warning">
                                            <td></td>                     
                                            <td>ส่วนลด10% 1D23A5</td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center">1</td>
                                            <td style="text-align: center">-160.00</td>
                                        </tr>
                                        <tr class="danger">
                                            <td></td>                     
                                            <td>ราคารวมหลังหักส่วนลด</td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center">1,440.00</td>
                                        </tr>
                                    </tbody>
                                </table>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">เพิ่มเติม </span>
                        <hr style="margin-top: 5px;margin-bottom: 10px;">
                        <span style="font-size: 15px; color: red;">- </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">การชำระเงิน </span>
                        <hr style="margin-top: 5px;margin-bottom: 10px;">
                        <span style="font-size: 15px"> โอนเงินมัดจำผ่านธนาคาร: <br><span style="font-size: 15px; color: orange;"> กสิกรไทย เลขที่ 12-1231212-1 <br> 400.00 บาท</span> </span> &nbsp; 

                        <a href="#" class="btn btn-warning btn-xs "data-toggle="modal" data-target='.pop-up-2' href=".pop-up-2" style="margin-left: 90px;">แสดงสลิป</a><br>

                        <span style="font-size: 15px"> ชำระเงินด้วยเงินสด: <br><span style="font-size: 15px; color: red;"> ต้องชำระเพิ่ม ณ ที่รับสินค้า 1040.00 บาท </span> </span> &nbsp; 


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>