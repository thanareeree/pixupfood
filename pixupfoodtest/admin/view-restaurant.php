<?php
include '../dbconn.php';
$id = $_POST["id"];
$res = $con->query("SELECT * FROM restaurant where id = $id");
$data = $res->fetch_assoc();
$serid = $data["serviceplan_id"];
$res2 = $con->query("SELECT name FROM serviceplan where id = $serid");
$data2 = $res2->fetch_assoc();
$zoneid = $data["zone_id"];
$res3 = $con->query("SELECT * FROM zone where id = $zoneid");
$data3 = $res3->fetch_assoc();
?>

<div class="modal-body">
        <table>
            <tr>
            <td class="col-sm-4 col-md-4" style="text-align: right;font-weight: bold;font-size: 20px">
                Restaurant:
            </td>
            <td class="col-sm-6 col-md-6" style="font-size: 20px">
                <?= $data["name"] ?>
            </td>   
            </tr>
        <tr>
            <td class="col-sm-4 col-md-4" style="text-align: right;font-weight: bold;font-size: 20px">
                Owner's name:
            </td>
            <td class="col-sm-6 col-md-6" style="font-size: 20px">
                <?= $data["firstname"] ?>&nbsp;&nbsp;<?= $data["lastname"] ?>
            </td>         
        </tr>
        <tr>
            <td class="col-sm-4 col-md-4" style="text-align: right;font-weight: bold;font-size: 20px">
                Email:
            </td>
            <td class="col-sm-6 col-md-6" style="font-size: 20px">
                <?= $data["email"] ?>
            </td>         
        </tr>
        <tr>
            <td class="col-sm-4 col-md-4" style="text-align: right;font-weight: bold;font-size: 20px">
                Address:
            </td>
            <td class="col-sm-6 col-md-6" style="font-size: 20px">
                <?= ($data["address"]=="")?'-':$data["address"]."" ?>  
            </td>  
        </tr>
        <tr>
            <td class="col-sm-4 col-md-4" style="text-align: right;font-weight: bold;font-size: 20px">
                Province:
            </td>
            <td class="col-sm-6 col-md-6" style="font-size: 20px">
                <?= ($data["province"]=="กรุงเทพมหานคร")?'เขต'. $data3["name"].'&nbsp;':'' ?> <?= $data["province"] ?> 
            </td>  
        </tr>
        <tr>
            <td class="col-sm-4 col-md-4" style="text-align: right;font-weight: bold;font-size: 20px">
                Telephone Number:
            </td>
            <td class="col-sm-6 col-md-6" style="font-size: 20px">
                <?= $data["tel"] ?>
            </td>  
        </tr>    
        <tr>
            <td class="col-sm-4 col-md-4" style="text-align: right;font-weight: bold;font-size: 20px">
               Service Plan Name:
            </td>
            <td class="col-sm-6 col-md-6" style="font-size: 20px">
                <?= $data2["name"] ?>
            </td>  
        </tr>
        </table>
</div>

