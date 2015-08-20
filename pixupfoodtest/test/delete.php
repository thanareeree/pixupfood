<?php
include '../dbconn.php';

$id = $_GET["id"];

$con->query("delete from test where register_id='$id'");
?>

<script>
    document.location='showAll.php';
</script>