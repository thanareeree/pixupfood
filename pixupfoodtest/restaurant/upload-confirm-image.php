<?php

include '../dbconn.php';

$id = $_GET["id"];

$target_dir = "../upload/restaurant/cofirm-image/";

$filename = $_FILES["imgpro"]["name"];
$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext = substr($filename, strripos($filename, '.')); // get file name
$newfliename =  "img".$id."-". uniqid().$file_ext;
$target_file = $target_dir . $newfliename;

if (move_uploaded_file(@$_FILES["imgfile"]["tmp_name"], $target_file)) {
    $con->query("UPDATE `restaurant` SET `img_path_confirm`= '$target_file' WHERE id = '$id'");

    if ($con->error == "") {
        ?>
        <script> document.location = "../view/res_register_success.php";</script>
        <?php

    } else {
        ?>
        <script> document.location = "../view/res_confirmform.php?success=0";</script>
        <?php

    }
} else {
    echo json_encode(array(
        "result" => 0,
        "error" => "Save Failed!"
    ));
}
