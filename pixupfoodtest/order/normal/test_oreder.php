<?php
session_start();
include '../../dbconn.php';

$orderDetailRes = $con->query("SELECT * FROM `request_fast_order` WHERE request_fast_order.fast_id = '7' and restaurant_id = '16'");
        $orderDetailData = $orderDetailRes->fetch_assoc();
        $coin = round($orderDetailData["total"]/500);
        $prepay = $orderDetailData["prepay"];
        
        echo $coin."\n";
        echo $prepay;