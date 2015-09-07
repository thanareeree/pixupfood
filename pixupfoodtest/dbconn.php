<?php
/*$servername = "db.pixupfood.com";
$db_username = "pixupfood";
$db_password = "administrator";
$dbname = "pixupfood";
$con = new mysqli($servername, $db_username, $db_password, $dbname);
$con->set_charset("utf8");*/
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "pixupfood";
$con = new mysqli($servername, $db_username, $db_password, $dbname);
$con->set_charset("utf8");

if ($con == FALSE ) {
    die("Error : Connection failed: " . mysql_error());
}
?>
