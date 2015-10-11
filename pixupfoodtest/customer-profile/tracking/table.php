<?php

session_start();
include '../../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];
$orderRes = $con->query("SELECT * FROM `normal_order` WHERE customer_id = '$cusid'");
if ($orderRes->num_rows == 0) {
    ?>
    <tr>
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการสั่งซื้อ</h4></td></tr>                  
    </tr>
    <?php

} else {
    $i = 1;
    while ($orderData = $orderRes->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $i++;?></td>
            <td>102458</td>                         
            <td>ข้าวกล้อง+ผัดกระเพาหมู+ไข่ดาว</td>
            <td>50</td>
            <td>ปรุงอาหาร</td>
            <td class="text-center"><button class="btn btn-info btn-xs" data-toggle="modal" data-target='#track' href="#track"><span class="glyphicon glyphicon-eye-open"></span> แสดง</button></td>
            <td class="text-center"><button class="btn btn-warning btn-xs" data-toggle="modal" data-target='#transf' href="#transf" disabled="disabled"><span class="glyphicon glyphicon-eye-open"></span> อัพโหลด</button></td>
        </tr>
        <?php

    }
}
?>

