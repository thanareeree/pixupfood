<?php
session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];

$bankRes = $con->query("select * from bank_account where restaurant_id = '$resid'");

if ($bankRes->num_rows == 0) {
    ?>
    <tr>
        <td colspan="3" class="warning">
            <p style="text-align: center;font-size: 20px">ยังไม่มีข้อมูล</p>
        </td>
    </tr>
    <?php
} else {
    while ($bankData = $bankRes->fetch_assoc()) {
        ?>
        <tr>
            <td>
                &nbsp;   <span style="font-size: 16px">ชื่อบัญชี: </span>
                <span style="font-size: 16px; color: orange;"> <?= $bankData["accname"] ?></span><br>
                &nbsp;   <span style="font-size: 16px">เลขที่บัญชี:</span>
                <span style="font-size: 16px; color: orange;"><?= $bankData["accNo"] ?> </span><br>
                &nbsp;   <span style="font-size: 16px">ธนาคาร: </span>
                <span style="font-size: 16px; color: orange;"><?= $bankData["bank"] ?></span><br>
            </td>
            <td class = "text-center">
                <p class = "remove" data-id = "<?= $bankData["id"] ?>" style = "color: red" data-toggle = "tooltip" data-placement = "top" title = "ลบรายการนี้?">
                    <i class = "glyphicon glyphicon-trash"></i>
                </p>
            </td>
        </tr>
        <?php
    }
}
?>
