<?php

include '../dbconn.php';

$id = $_GET["id"];

$target_dir = "../upload/restaurant/cofirm-image/";
$target_file = $target_dir . basename(@$_FILES["imgfile"]["name"]);

if (move_uploaded_file(@$_FILES["imgfile"]["tmp_name"], $target_file)) {
    $con->query("UPDATE `restaurant` SET `img_path`= '$target_file' WHERE id = '$id'");

    if ($con->error == "") {
        ?>
        <script> document.location = "../view/res_confirmform.php?success=1";</script>
        <?php

    }else{
        echo $con->error;
    }
} else {
    echo json_encode(array(
        "result" => 0,
        "error" => "Save Failed!"
    ));
}
