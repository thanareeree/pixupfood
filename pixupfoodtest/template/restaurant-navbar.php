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
                <a href="#" class="navbar-brand" style="margin-left:100px;">Pixup</a>
                <a href="#" class="navbar-brand" style="color:rgba(0,0,32,1);padding-left: 0px;">Food</a>
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
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" style="margin-left:10px; margin-right:20px"><?= $data["name"] . " " . $id ?></a>
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


<?php } else { ?>
    <!-- start preloader -->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!-- end preloader -->
    <!-- start navigation -->
    <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
        <div class="container" style="margin-left:100px;margin-right:40px;height:70px;width:auto;">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                </button>
                <a href="#" style="color:rgba(255,127,0,1)" class="navbar-brand">Pixup</a>
                <a href="#" class="navbar-brand" style="color:black;padding-left: 0px;">Food</a>

                <ul class="nav navbar-nav navbar-right text-uppercase">
                    <li><a href="#">สมัครสมาชิก | เข้าสู่ระบบ >></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <img src="../assets/images/bar/user.png" style="width:40px;height:40px;"/>
                        </a>
                        <ul class="dropdown-menu" style="padding: 0px">
                            <li>
                                <div class="middlePage">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Already Account? >> Sign In or Sign Up here</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-5" >
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p class="text-uppercase" style="text-align: center;font-size: 20pt;">sign up here</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5" style="margin-left: 20px">
                                                            <a href="cus_register.php">
                                                                <img src="../assets/images/bar/userl.png" style="width:60px; height:60px;margin-top: 10px;">
                                                            </a>
                                                            <a href="cus_register.php">
                                                                <p style="font-weight:bold"> CUSTOMERS </p>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <a href="res_register.php">
                                                                <img src="../assets/images/bar/restaurant.png" style="width:60px; height:60px;margin-top: 10px;">
                                                            </a>
                                                            <a href="res_register.php">
                                                                <p style="font-weight:bold"> RESTAURANTS </p>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-7" style="border-left:1px solid #ccc;height:160px">
                                                    <form class="form-horizontal" action="../api/loginsession.php" method="post">
                                                        <fieldset>
                                                            <input id="textinput" name="loginemail" type="text" placeholder="Enter User Name" class="form-control input-md">                                                                
                                                            <input id="textinput" name="password" type="password" placeholder="Enter Password" class="form-control input-md" style="margin: 10px 0 5px 0">
                                                            <div class="spacing"><input type="checkbox" name="checkboxes" id="checkboxes-0" value="1"><small> Remember me</small></div>
                                                            <div class="spacing spacing-height"><a href="#"><p style="font-size: 14px">Forgot Password?</p></a><br/></div>
                                                            <button type="submit"  class="btn btn-info btn-sm pull-right">Sign In</button>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav><!-- end navigation -->
    <?php
}
?>



