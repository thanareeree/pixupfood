<?php
include '../dbconn.php';
$resid = @$_POST["resid"];
$normalOrderRes = $con->query("SELECT * FROM `normal_order` where restaurant_id = '$resid'");
$i = 1;

if ($normalOrderRes->num_rows == 0) {
    ?>
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการใหม่</h4></td></tr>
    <?php
} else {
    while ($normalOrderData = $normalOrderRes->fetch_assoc()) {
        ?>
        <tr class="warning">
            <td style="text-align: center">$i++;</td>
            <td><?= $normalOrderData["id"] ?></td>                         
            <td><?= $normalOrderData["cusname"] ?></td>
            <td><?= $fastOrderData["foodsetname"] ?></td>
            <td style="text-align: center"><?= $fastOrderData["amountbox"] ?></td>
            <td><?= $normalOrderData["delivery_date"] ?>&nbsp;<?= $normalOrderData["delivery_time"] ?> </td>
            <td style="text-align: center">----- </td>
            <td class="text-center">
                <button class="btn btn-info btn-xs normalOrderView" id="normalOrderView<?= $normalOrderData["id"] ?>" >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>
            <td class="text-center">
                <button class="btn btn-success btn-xs acceptNormalOrder" id="acceptNormalOrder<?= $normalOrderData["id"] ?>">
                    <span class="glyphicon glyphicon-check"></span> 
                    รับ
                </button>
            </td>
            <td class="text-center">
                <button class="btn btn-danger btn-xs ignoreNormalData" id="ignoreNormalData<?= $normalOrderData["id"] ?>">
                    <span class="glyphicon glyphicon-trash"></span> 
                    ปฏิเสธ
                </button>
            </td>
        </tr>
    <?php
    }
}
?>