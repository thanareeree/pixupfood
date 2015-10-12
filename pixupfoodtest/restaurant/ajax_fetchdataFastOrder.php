<?php
include '../dbconn.php';
$resid = @$_POST["resid"];

$fastOrderRes = $con->query("SELECT * FROM `normal_order` where restaurant_id = '$resid'");
$i = 1;
if ($fastOrderRes->num_rows == 0) {
    ?>
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการใหม่</h4></td></tr>
    <?php
} else {
    while ($fastOrderData = $fastOrderRes->fetch_assoc()) {

        /* if(){
          ถ้าเพิ่งมา count > 0 ให้ tr เป็น class danger'
          <tr class="danger">
          <td style="text-align: center">$i++;</td>
          <td><?= $fastOrderData["id"] ?></td>
          <td><?= $$fastOrderData["cusname"] ?></td>
          <td><?= $fastOrderData["foodsetname"] ?></td>
          <td style="text-align: center"><?= $fastOrderData["amountbox"] ?></td>
          <td><?= $fastOrderData["delivery_date"] ?>&nbsp;<?= $fastOrderData["delivery_time"] ?> </td>
          <td style="text-align: center">----- </td>
          <td class="text-center">
          <button class="btn btn-info btn-xs fastOrderView" id="fastOrderView<?= $fastOrderData["id"] ?>" >
          <span class="glyphicon glyphicon-eye-open"></span>
          แสดง
          </button>
          </td>
          <td class="text-center">
          <button class="btn btn-success btn-xs acceptFastOrder" id="acceptFastOrder<?= $fastOrderData["id"] ?>">
          <span class="glyphicon glyphicon-check"></span>
          รับ
          </button>
          </td>
          <td class="text-center">
          <button class="btn btn-danger btn-xs ignoreFastOrder" id="ignoreFastOrder<?= $fastOrderData["id"] ?>">
          <span class="glyphicon glyphicon-trash"></span>
          ปฏิเสธ
          </button>
          </td>
          </tr>


          } */
        ?>
        <tr >
            <td style="text-align: center"><?=$i++;?></td>
            <td><?= $fastOrderData["id"] ?></td>                         
            <td><?= $fastOrderData["id"] ?></td>
            <td><?= $fastOrderData["id"] ?></td>
            <td style="text-align: center"><?= $fastOrderData["id"] ?></td>
            <td><?= $fastOrderData["delivery_date"] ?>&nbsp;<?= $fastOrderData["delivery_time"] ?> </td>
            <td style="text-align: center">----- </td>
            <td class="text-center">
                <button class="btn btn-info btn-xs fastOrderView" id="fastOrderView<?= $fastOrderData["id"] ?>" >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>
            <td class="text-center">
                <button class="btn btn-success btn-xs acceptFastOrder" id="acceptFastOrder<?= $fastOrderData["id"] ?>">
                    <span class="glyphicon glyphicon-check"></span> 
                    รับ
                </button>
            </td>
            <td class="text-center">
                <button class="btn btn-danger btn-xs ignoreFastOrder" id="ignoreFastOrder<?= $fastOrderData["id"] ?>">
                    <span class="glyphicon glyphicon-trash"></span> 
                    ปฏิเสธ
                </button>
            </td>
        </tr>
    <?php }
} ?>
