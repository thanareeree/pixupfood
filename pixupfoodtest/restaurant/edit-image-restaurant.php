<?php

include '../dbconn.php';
$id = @$_GET["id"];
$target_dir = "../upload/restaurant/images/";

$filename = @$_FILES["imagerest"]["name"];
$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext = substr($filename, strripos($filename, '.')); // get file name
$newfliename =  "img".$id."-". uniqid().$file_ext;
$target_file = $target_dir . $newfliename;




if ($filename !="") {
     move_uploaded_file(@$_FILES["imagerest"]["tmp_name"], $target_file);
    $con->query("UPDATE `restaurant` SET `img_path`='$target_file' WHERE id = '$id'");
    if ($con->error == "") {
        //$res = $con->query("select * from customer where id= '$id'");
         //$_SESSION["userdata"] = $res->fetch_assoc();
        ?>
        <script>
            document.location = "../view/res_restaurant_manage_edit.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }
} else {
        echo "อัพไม่ได้".$target_file."0000".$target_dir."000".$file_basename."000".$file_ext;
    
}



