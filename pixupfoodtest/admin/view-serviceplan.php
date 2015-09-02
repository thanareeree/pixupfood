<?php
include '../dbconn.php';
$id = $_POST["id"];
$res = $con->query("SELECT * FROM serviceplan where id = $id");
$data = $res->fetch_assoc();
?>

<div class="modal-body">
    <table>
        <tr>
            <td class="col-sm-4 col-md-4" style="text-align: right;font-weight: bold;font-size: 20px">
                Service Name:
            </td>
            <td class="col-sm-6 col-md-6" style="font-size: 20px">
                <?= $data["name"] ?>
            </td>         
        </tr>
        <tr>
            <td class="col-sm-4 col-md-4" style="text-align: right;font-weight: bold;font-size: 20px">
                Description:
            </td>
            <td class="col-sm-6 col-md-6" style="font-size: 20px">
                <?= $data["description"] ?>
            </td>  
        </tr>
    </table>
</div>

