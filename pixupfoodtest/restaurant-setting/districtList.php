<?php
include '../dbconn.php';

$province_id = $_POST["province_id"];

$res = $con->query("SELECT data_district.district_id, data_district.district_name "
        . "FROM `data_province` "
        . "JOIN data_district ON  data_district.PROVINCE_ID = data_province.PROVINCE_ID "
        . "WHERE data_province.PROVINCE_ID = '$province_id'");

while ($data = $res->fetch_assoc()) {
    ?>
    <option value="<?= $data['district_id'] ?>"> <?= $data['district_name'] ?> </option>
    <?php
}

