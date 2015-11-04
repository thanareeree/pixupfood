<?php

$toEmail = "peepolike@gmail.com";
$mailHeaders = "From: " . $_POST["nameinput"] . "<" . $_POST["emailinput"] . ">\r\n";
if (mail($toEmail, $_POST["subjectinput"], $_POST["contentinput"], $mailHeaders)) {
    echo json_encode(array(
        "result" => 1
    ));
} else {
    echo json_encode(array(
        "result" => 0,
        "error" => "ส่งอีเมลไม่ได้"
    ));
}
?>