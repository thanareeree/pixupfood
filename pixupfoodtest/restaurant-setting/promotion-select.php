<?php

$type = $_POST["promotionid"];

if ($type == '1') {
    ?>
    <p style="font-size: 25px; margin-top: 30px;margin-bottom: -10px;">รายละเอียดโปรโมชั่นของท่าน</p><hr>
    <div class="form-group" style="margin-bottom: 15px;">
        <label class="col-sm-3 control-label" for="textinput">รายละเอียด</label>
        <div class="col-sm-9" style="margin-bottom: 15px;">
            <input type="text" placeholder="ตัวอย่าง ฟรีค่าจัดส่ง เฉพาะเดือนตุลามคมเท่านั้น" class="form-control" id="detail" name="detail" required="">
        </div>
    </div>
    <div class="form-group" style="margin-bottom: 15px;">
        <label class="col-sm-3 control-label" for="textinput">วันที่เริ่ม</label>
        <div class="col-sm-9" style="margin-bottom: 15px;">
            <input type="date" class="form-control" id="start_date" name="start_date" required="">
        </div>
    </div>
    <div class="form-group" style="margin-bottom: 15px;">
        <label class="col-sm-3 control-label" for="textinput">หมดเขต</label>
        <div class="col-sm-9" style="margin-bottom: 15px;">
            <input type="date" class="form-control" id="end_date" name="end_date" required="">
        </div>
    </div>
    <?php

}