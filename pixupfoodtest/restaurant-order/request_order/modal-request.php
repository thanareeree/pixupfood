<?php 
include '../dbconn.php';
$fast_orderid = $_POST["fast_orderid"];
$con->query("");

?>

<div class="modal-body">
    <div class="row" style="margin-top: 0px;">
        <div class="col-md-12">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">หมายเลขสมาชิกลูกค้า: </span>
                        <span style="font-size: 20px; color: orange;"> 26143 </span><br>

                        <span style="font-size: 20px">ชื่อ: </span>
                        <span style="font-size: 20px; color: orange;"> คุณธิติ มหาโยธารักษ์ </span><br>

                        <span style="font-size: 20px">โทรศัพท์: </span>
                        <span style="font-size: 20px; color: orange;"> 0812345678 </span><br>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-content">

                        <span style="font-size: 20px">วันเวลาที่ลูกค้านัดรับสินค้า: </span><br>
                        <span style="font-size: 20px; color: orange;"> 12-11-2015</span><br>


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
                        <span style="font-size: 17px">บริษัท นาดาว บางกอก จำกัด 92/14 ซอยสุขุมวิท 31 (สวัสดี) แขวงคลองตันเหนือ เขตวัฒนา กทม. 10110</span>
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
                                            <td>ข้าวกล้อง+กระเพรา</td>
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
                                        <!--<tr class="warning">
                                            <td></td>                     
                                            <td>ส่วนลด10% 1D23A5</td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center">1</td>
                                            <td style="text-align: center">-160.00</td>
                                        </tr>-->
                                        <!--<tr class="danger">
                                            <td></td>                     
                                            <td>ราคารวมหลังหักส่วนลด</td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center">1,440.00</td>
                                        </tr>-->
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
                        <span style="font-size: 15px; color: red;"> กระเพราไม่ใส่ถั่วฝักยาว </span>
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
