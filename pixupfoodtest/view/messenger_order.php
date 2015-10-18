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
        <?php $messid = $_SESSION["messengerdata"]["id"]?>
        <!-- start navigation -->
        <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" style="width: 360px;">
            <div class="container" style="height:60px;width:90%;">
                <div class="navbar-header">
                    <a href="/index.php" style="color:rgba(255,127,0,1);padding:20px 0 15px 0;" class="navbar-brand">Pixup</a>
                    <a href="/index.php" class="navbar-brand" style="color:black;padding:20px 15px 15px 0;">Food</a>
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
                    <img align="left" class="fb-image-lg" src="/assets/images/city-restaurant-lunch-outside.png" alt="Profile image example"/>
                    <div class="container_status">
                        <h3>แบบสั่งด่วน </h3><hr class="hrs">

                        <table class="table table-hover" id="task-table">
                            <thead>

                                <tr>
                                    <th>เลขที่รายการ</th>
                                    <th>ชื่อลูกค้า</th>
                                    <th>จำนวน</th>
                                    <th>จัดส่ง</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                 
                                $res = $con->query("SELECT fast_order.id, customer.firstName, customer.lastName, "
                                        . "fast_order.quantity as qty FROM `fast_order` "
                                        . "JOIN customer ON customer.id = fast_order.customer_id"
                                        . " WHERE messenger_id = '$messid' and fast_order.status = '5'");
                                if ($res->num_rows === 0) {
                                    ?>
                                    <tr>
                                        <td colspan="4" class="text-center">ยังไม่มีรายการ</td>
                                    </tr>
                                    <?php
                                } else {
                                    while ($data = $res->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?= $data["id"]?></td>
                                            <td><?= $data["firstName"]."&nbsp;".$data["lastName"]?></td>

                                            <td><?= $data["qty"]?></td>
                                            <td>
                                                <a href="/view/messenger_confirm_fast.php?orderid=<?= $data["id"]?>">
                                                    <button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-ok"></span></button>
                                                </a> 
                                            </td>
                                        </tr>
                                    <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                        <h3>แบบปกติ </h3><hr class="hrs">
                        <table class="table table-hover" id="task-table">
                            <thead>
                                <tr>
                                    <th>เลขที่รายการ</th>
                                    <th>ชื่อลูกค้า</th>
                                    <th>จำนวน</th>
                                    <th>จัดส่ง</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res = $con->query("SELECT normal_order.id, customer.firstName, customer.lastName, "
                                        . "SUM(order_detail.quantity) as qty "
                                        . "FROM `normal_order` "
                                        . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
                                        . "JOIN customer ON customer.id = normal_order.customer_id "
                                        . "WHERE messenger_id = '$messid' and normal_order.status = '5'"
                                        . " GROUP BY order_detail.order_id");
                                if ($res->num_rows === 0) {
                                    ?>
                                    <tr>
                                        <td colspan="4" class="text-center">ยังไม่มีรายการ</td>

                                    </tr>
                                    <?php
                                } else {
                                    while ($data = $res->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?= $data["id"]?></td>
                                            <td><?= $data["firstName"]."&nbsp;".$data["lastName"]?></td>

                                            <td><?= $data["qty"]?></td>
                                            <td>
                                                <a href="/view/messenger_confirm.php?orderid=<?= $data["id"]?>">
                                                    <button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-ok"></span></button>
                                                </a> 
                                            </td>
                                        </tr>
                                    <?php }
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- /container -->
            <!-- edit profile -->

            <div class="container">

            </div>
        </section> 


<?php include '../template/footer.php'; ?>


    </body>
</html>
