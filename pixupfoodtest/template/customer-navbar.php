<?php
//session_start();
include '../dbconn.php';


if (isset($_SESSION["islogin"])) {
    $id = $_SESSION["userdata"]["id"];
    $res = $con->query("select * from customer where id = '$id'");
    $data = $res->fetch_assoc();
    ?>
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

                <a href="../index.php" class="navbar-brand">Pixup</a>
                <a href="../index.php" class="navbar-brand" style="color:rgba(0,0,32,1);padding-left: 0px;">Food</a>
                <div class="col-md-4" style="margin:7px 0 0 15%;">
                    <form action="../view/search_page.php" method="get">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" name="search" value="<?= @$_GET["search"] ?>" class="form-control input-lg" placeholder="Search.." />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>

                            </div>
                        </div>
                    </form>
                </div>

                <ul class="nav navbar-nav navbar-right text-uppercase">
                    <li><a href="../api/logout.php" class="nav-link"><?= $data["firstName"] . " " . $data["lastName"] . " " . $id ?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../assets/images/bar/user.png" style="width:40px;height:40px;"/>
                        </a>
                        <ul class="dropdown-menu" style="padding: 0px">
                            <li>
                                <div class="middlePage1">
                                    <div class="panel panel-info">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-5" style="border-right:1px solid #ccc;height:auto;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <a href="cus_customer_profile.php">
                                                                <img src="<?= ($data["img_path"]=="" ? '../assets/images/defaulf-profile.png':$data["img_path"]) ?>" style="max-width: 110px; max-height: 110px">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <form class="form-horizontal">
                                                        <fieldset>
                                                           <br><br> <br><br>
                                                            <a href="../api/logout.php">
                                                                <button id="logoutbutton" type="button" class="btn btn-danger btn-sm pull-right" style="margin-left: 15px;">Logout</button>
                                                            </a>
                                                            <a href="cus_customer_profile.php">
                                                                <button id="profilebutton" class="btn btn-info btn-sm pull-right" type="button">Profile</button>
                                                            </a>
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
                <a href="../index.php" style="color:rgba(255,127,0,1)" class="navbar-brand">Pixup</a>
                <a href="../index.php" class="navbar-brand" style="color:black;padding-left: 0px;">Food</a>
                <div class="col-md-4" style="margin:7px 0 0 15%;">
                    <form action="../view/search_page.php" method="get">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" name="search" value="<?= @$_GET["search"] ?>" class="form-control input-lg" placeholder="Search.." />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>

                            </div>
                        </div>
                    </form>
                </div>
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
                                                <?php
                                                $pageURL = 'http';
                                                $pageURL .= "://";
                                                if ($_SERVER["SERVER_PORT"] != "80") {
                                                    $pageURL .=$_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
                                                } else {
                                                    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
                                                }
                                                ?>
                                                <div class="col-md-7" style="border-left:1px solid #ccc;height:160px">
                                                    <form class="form-horizontal" action="../api/loginsession.php" method="post">
                                                        <fieldset>
                                                            <input type="hidden" name="current_url" value="<?= $pageURL ?>">
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


