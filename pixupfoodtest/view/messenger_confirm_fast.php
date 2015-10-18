<?php
include '../api/islogin.php';
include '../dbconn.php';
?>


<html>
    <head>
        <title>Pixupfood - Restaurant Messenger</title>
        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/messenger.css">

    </head>
    <body>
        <?php
        $orderid = @$_GET["orderid"];
        $res = $con->query("SELECT fast_order.id, customer.firstName, customer.lastName, customer.tel, "
                . "shippingAddress.full_address, fast_order.payment_id FROM `fast_order` "
                . "JOIN customer ON customer.id = fast_order.customer_id "
                . "JOIN shippingAddress ON shippingAddress.id = fast_order.shippingAddress_id"
                . " WHERE fast_order.id = '$orderid'");
        $data = $res->fetch_assoc();
        $pay = $data["payment_id"];
        $payment = "";
        if ($pay == 1) {
            $payment = "เงินสด";
        } else {
            $payment = "ชำระเงินเรียบร้อยเเล้ว";
        }
        ?>
        <input type="hidden" value="<?= $orderid?>" id="getOrderId">
        <!-- start navigation -->
        <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" style="width: 360px;">
            <div class="container" style="height:60px;width:90%;">
                <div class="navbar-header">
                    <a href="#" style="color:rgba(255,127,0,1);padding:20px 0 15px 0;" class="navbar-brand">Pixup</a>
                    <a href="#" class="navbar-brand" style="color:black;padding:20px 15px 15px 0;">Food</a>
                    <ul class="nav navbar-nav navbar-right text-uppercase pull-right">
                        <li>
                            <a href="/api/logout.php"><?= $_SESSION["messengerdata"]["username"] ?>&nbsp;| &nbsp;<i class="glyphicon glyphicon-log-out"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <!-- start profile -->
        <section id="messenger">
            <div class="profilecontainer">
                <div class="headprofile">
                    <img align="left" class="fb-image-lg" src="../assets/images/city-restaurant-lunch-outside.png" alt="Profile image example"/>
                    <div class="container_status">
                        <form action="#">                           
                            <h4>ชื่อผู้รับ: </h4><span><?= $data["firstName"] . "&nbsp;" . $data["lastName"] ?></span>
                            <h4>รหัสรายการ: </h4><span><?= $data["id"] ?></span>
                            <h4>ที่อยู่จัดส่ง: </h4><span><?= $data["full_address"] ?></span>
                            <h4>โทร:</h4><span><?= $data["tel"] ?></span>
                            <h4>วิธีชำระเงิน:</h4><span><?= $payment ?></span>
                            <h4>รหัสยืนยัน:&nbsp;<span id="error" style="color: red"></span></h4>
                            <input type="text" name="shipcode" id="shipcode" >
                            <button type="button" class="btn btn-primary checkShipping" data-id ="<?= $data["id"] ?>" >confirm</button>
                        </form>
                    </div>
                </div>
            </div> <!-- /container -->
            <!-- edit profile -->

            <div class="container">
            </div>
        </section> 
      
        <?php include '../template/footer.php'; ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".checkShipping").on("click", function (e) {
                    $.ajax({
                        url: "/messenger/checkShipping-fast.php",
                        type: "POST",
                        dataType: "json",
                        data: {"orderid": $("#getOrderId").val(), "shipcode": $('#shipcode').val()},
                        success: function (data) {
                            if (data.result == "1") {
                                 $("#error").html("");
                                document.location = "/view/messenger_order.php";
                            } else {
                                $("#error").html(data.error);
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>