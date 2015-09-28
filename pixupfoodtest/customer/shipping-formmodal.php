<?php 
include '../dbconn.php';

$id = $_POST["id"];
$res5 = $con->query("select * from shippingAddress where id = '$id'");
$data5 = $res5->fetch_assoc();
$type = $data5["type"];
?>
<div class="modal-body">

    <label for="address">รายละเอียดที่จัดส่งสินค้า:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
    <div class="form-group">
        <textarea required class="form-control" placeholder="ที่จัดส่งสินค้า" rows="3"  name="address" id="address"><?= $data5["full_address"]?></textarea>
    </div>
    <label for="addtype">ประเภทที่อยู่อาศัย:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
    <div class="form-group" >
        <select name="addtype" id="addtype" class="col-sm-12" required>
            <option value="อพาร์ทเมนท์" <?php if($type=="อพาร์ทเมนท์") echo 'selected="selected"'; ?>>อพาร์ทเมนท์</option>
            <option value="สถานที่ราชการ" <?php if($type=="สถานที่ราชการ") echo 'selected="selected"'; ?>>สถานที่ราชการ</option>
            <option value="มหาวิทยาลัย" <?php if($type=="มหาวิทยาลัย") echo 'selected="selected"'; ?>>มหาวิทยาลัย</option>
            <option value="โรงพยาบาล" <?php if($type=="โรงพยาบาล") echo 'selected="selected"'; ?>>โรงพยาบาล</option>
            <option value="โรงแรม" <?php if($type=="โรงแรม") echo 'selected="selected"'; ?>>โรงแรม</option>
            <option value="บ้าน" <?php if($type=="บ้าน") echo 'selected="selected"'; ?>>บ้าน</option>
            <option value="ตลาด" <?php if($type=="ตลาด") echo 'selected="selected"'; ?>>ตลาด</option>
            <option value="โรงเรียน"<?php if($type=="โรงเรียน") echo 'selected="selected"'; ?>>โรงเรียน</option>
            <option value="ร้านค้า" <?php if($type=="ร้านค้า") echo 'selected="selected"'; ?>>ร้านค้า</option>
            <option value="วัด" <?php if($type=="วัด") echo 'selected="selected"'; ?>>วัด</option>
            <option value="อื่นๆ" <?php if($type=="อื่นๆ") echo 'selected="selected"'; ?>>อื่นๆ</option>
        </select>
    </div>
    <label for="addnaming">กรุณาใส่ข้อมูลระบุที่จัดส่งเพื่อความรวดเร็ว:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
    <div class="form-group">
        <input required class="form-control" placeholder="ชื่อเรียกที่จัดส่งเพื่อความรวดเร็ว"  name="addnaming" id="addnaming" value="<?= $data5["address_naming"]?>">
        <input type="hidden" name="addid" value="<?= $data5["id"];?>">
    </div>
</div>
