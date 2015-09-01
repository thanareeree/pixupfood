<?php
include '../dbconn.php';
$id = $_POST["id"];
$res = $con->query("SELECT * FROM customer where id = $id");
$data = $res->fetch_assoc();
?>

<div class="modal-body">
    <table>
        <tr>
            <td class="col-sm-4 col-md-4" style="text-align: right;font-weight: bold;font-size: 20px">
                Customer Name:
            </td>
            <td class="col-sm-6 col-md-6" style="font-size: 20px">
                <?= $data["firstName"] ?>&nbsp;&nbsp;<?= $data["lastName"] ?>
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
                Telephone Number:
            </td>
            <td class="col-sm-6 col-md-6" style="font-size: 20px">
                <?= $data["tel"] ?>
            </td>  
        </tr>
    </table>
</div>

