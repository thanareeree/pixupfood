<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "pixupfood";
/*
$servername = "db.chakree.me";
$db_username = "pixupfood";
$db_password = "pixupfood";
$dbname = "pixupfood";
*/



$con = new mysqli($servername, $db_username, $db_password, $dbname);
$con->set_charset("utf8");


if ($con == FALSE ) {
    die("Error : Connection failed: " . mysql_error());
}
?>
