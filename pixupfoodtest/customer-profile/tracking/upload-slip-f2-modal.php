<?php 
include '../../dbconn.php';
session_start();
$order_id = $_POST["id"];
$cusid = $_SESSION["userdata"];

?>

<div class="modal-body">
    <form action="/customer-profile/tracking/upload-fast-slip2.php" method="post" enctype="multipart/form-data">
        <div class="form-group" style="margin-bottom: 15px;">
            <label class="col-sm-3 control-label" for="textinput">โอนเงินวันที่</label>
            <div class="col-sm-9" style="margin-bottom: 15px;">
                <input type="date" class="form-control" name="date" required="" placeholder="ตัวอย่าง 2015-10-15">
                <input type="hidden" value="<?= $order_id?>" name="orderid">
            </div>
        </div>
        <div class="form-group" style="margin-bottom: 15px;">
            <label class="col-sm-3 control-label" for="textinput">เวลา</label>
            <div class="col-sm-9" style="margin-bottom: 15px;">
                <input type="time" class="form-control" name="time" required="">
            </div>
        </div>
        <div class="form-group" style="margin-bottom: 15px;">
            <label class="col-sm-3 control-label" for="textinput">ธนาคาร</label>
            <div class="col-sm-9" style="margin-bottom: 15px;">
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
        <div class="form-group" style="margin-bottom: 15px;">
            <label class="col-sm-3 control-label" for="textinput">รูปสลิป</label>
            <div class="col-sm-9" style="margin-bottom: 15px;">
                <input type="file" required="" name="slip_path" accept="image/jpeg,image/pjpeg,image/png">
            </div>
        </div>

        <div class="form-group" >
            <span class="input-group" style="margin-left: 150px;">
                <button class="btn btn-success" id="savebtn" type="submit" style="    margin-left: 350px;">บันทึก</button>
            </span>
        </div><hr>
    </form>
</div>
