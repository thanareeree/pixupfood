<?php
include '../dbconn.php';
$name = $_POST["name"];
$res = $con->query("SELECT * FROM restaurant where name = '$name'");
$data = $res->fetch_assoc();
?>

<div class="modal-body">
    <div class="row">
        <div class="col-lg-6">
            <?= $data["name"]?>
        </div>
    </div>
</div>


