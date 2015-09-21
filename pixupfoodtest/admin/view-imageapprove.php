<?php
include '../dbconn.php';

$name = $_POST["name"];
$res = $con->query("SELECT * FROM restaurant where name = '$name'");
$data = $res->fetch_assoc();
?>

<div class="modal-body"> 
    <?php
    if ($data["img_path_confirm"] == null) {
        ?>
        <span style="color: red;font-size:18px" id="imgnull">**ทางร้านยังไม่ได้อัพโหลดรูปภาพ**</span><br><img  src="../assets/images/default-img482.png">
    
            <?php
        } else {
        ?>
        <img  src="<?= $data["img_path_confirm"] ?>" >

        <?php
    }
    ?>
</div>


