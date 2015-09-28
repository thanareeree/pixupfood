<?php
//session_start();
include '../dbconn.php';


if (isset($_SESSION["islogin"])) {
    $id = $_SESSION["restdata"]["id"];
    $res = $con->query("select * from restaurant where id = '$id'");
    $data = $res->fetch_assoc();
    ?>
    <!-- start preloader -->
    <!--<div class="preloader">
        <div class="loader"></div>
    </div>-->
    <!-- end preloader -->
    <!-- start navigation -->
    <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
        <div class="container-fluid" >
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="/index.php">
                            <img src="/assets/images/bar/logo PXF.png">
                        </a>
                    </li>
                </ul>
                <a href="/index.php" class="navbar-brand" style="padding: 20px 15px 15px 15px;" >Pixup</a>
                <a href="/index.php" class="navbar-brand" style="color:rgba(0,0,32,1);padding: 20px 15px 15px 0;">Food</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
                <ul class="nav navbar-nav navbar-right" id="navright-after" >
                    <li>
                        <a href="../view/res_restaurant_manage_order.php"  role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-align-left"></span></a> 
                    </li>
                    <li>
                        <a href="../view/res_restaurant_manage_today.php"  role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-comment"></span></a> 
                    </li>
                    <li>
                        <a href="../view/res_restaurant_manage_menulist.php"  role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span></a> 
                    </li>
                    <li>
                        <a href="../view/res_restaurant_manage_calendar.php"  role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-calendar"></span></a> 
                    </li>
                    <li class="dropdown" >
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" style="margin-left:10px; margin-right:20px"><?= $data["name"] ?>&nbsp;<i class="glyphicon glyphicon-menu-down" style="font-size: 10px;"></i></a>
                        <ul class="dropdown-menu" style=" margin-right:20px">
                            <li><a href="../view/res_restaurant_manage_edit.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;แก้ไขข้อมูลร้าน</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../api/logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;ออกจากระบบ</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </nav>
    <!-- end navigation -->


<?php }?>