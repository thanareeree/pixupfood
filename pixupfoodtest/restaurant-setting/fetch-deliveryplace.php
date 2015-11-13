<?php
session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];

$placeRes2 = $con->query("SELECT data_district.district_name, delivery_place.id "
        . "FROM data_district "
        . "RIGHT JOIN delivery_place ON delivery_place.district_id = data_district.district_id "
        . "WHERE delivery_place.restaurant_id = '$resid'");
if ($placeRes2->num_rows == 0) {
    ?>
    <tr>
        <td colspan="3" class="warning">
            <p style="text-align: center;font-size: 20px">ยังไม่มีข้อมูล</p>
        </td>
    </tr>
    <?php
} else {
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
}
?>
