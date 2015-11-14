<?php
//session_start();


if (isset($_SESSION["islogin"])) {
    $id = $_SESSION["userdata"]["id"];
    $res = $con->query("select * from customer where id = '$id'");
    $data = $res->fetch_assoc();
    ?>
    <!-- start preloader 
    <div class="preloader">
        <div class="loader"></div>
    </div>-->
    <!-- end preloader -->
    <!-- start navigation -->
    <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
        <div class="container" style="margin-left:100px;margin-right:40px;height:70px;width:auto;">
            <div class="navbar-header">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="/index.php">
                            <img src="/assets/images/bar/logo PXF.png" width="42px" height="42px">
                        </a>
                    </li>
                </ul>
                <a href="/index.php" class="navbar-brand" style="padding: 20px 15px 15px 15px;" >Pixup</a>
                <a href="/index.php" class="navbar-brand" style="color:rgba(0,0,32,1);padding: 20px 15px 15px 0;">Food</a>
                <div class="col-md-4" style="margin:7px 0 0 15%;">
                    <form action="/view/search_page.php" method="get">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" name="search" required  class="form-control input-lg" placeholder="ค้นหารายการอาหารที่นี่" />
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
                    <li><a href="/view/cus_customer_profile.php" class="nav-link"><?= $data["firstName"] . " " . $data["lastName"] ?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/assets/images/bar/user.png" style="width:40px;height:40px;"/>
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
                                                            <a href="/view/cus_customer_profile.php">
                                                                <img src="<?= ($data["img_path"] == "" ? '/assets/images/default-avatar.jpg' : $data["img_path"]) ?>" style="max-width: 110px; max-height: 110px">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <form class="form-horizontal">
                                                        <fieldset>
                                                            <br><br> <br><br>
                                                            <a href="/api/logout.php">
                                                                <button id="logoutbutton" type="button" class="btn btn-danger btn-sm pull-right" style="margin-left: 15px;">Logout</button>
                                                            </a>
                                                            <a href="/view/cus_customer_profile.php">
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
    <!-- start preloader
    <div class="preloader">
        <div class="loader"></div> 
    
    </div> -->
    <!-- end preloader -->
    <!-- start navigation -->
    <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
        <div class="container" style="margin-left:100px;margin-right:40px;height:70px;width:auto;">
            <div class="navbar-header">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="/index.php">
                            <img src="/assets/images/bar/logo PXF.png">
                        </a>
                    </li>
                </ul>
                <a href="/index.php" class="navbar-brand" style="padding: 20px 15px 15px 15px;" >Pixup</a>
                <a href="/index.php" class="navbar-brand" style="color:rgba(0,0,32,1);padding: 20px 15px 15px 0;">Food</a>
                <div class="col-md-4" style="margin:7px 0 0 15%;">
                    <form action="/view/search_page.php" method="get">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" name="search"  class="form-control input-lg" placeholder="ค้นหารายการอาหารที่นี่" />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>

                            </div>
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-nav navbar-right text-uppercase" id="logindiv">
                    <li><a href="#">สมัครสมาชิก | เข้าสู่ระบบ >></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <img src="/assets/images/bar/user.png" style="width:40px;height:40px;"/>
                        </a>
                        <ul class="dropdown-menu" style="padding: 0px">
                            <li>
                                <div class="middlePage">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">ลงชื่อเข้าใช้ / สมัครสมาชิก</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-5" >
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p class="text-uppercase" style="text-align: center;font-size: 20pt;">สมัครสมาชิกที่นี่</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5" style="margin-left: 20px">
                                                            <a href="/view/cus_register.php">
                                                                <img src="/assets/images/bar/userl.png" style="width:60px; height:60px;margin-top: 10px;">
                                                            </a>
                                                            <a href="/view/cus_register.php">
                                                                <p style="margin-left: 3px;font-size: 16px"> ผู้ใช้ทั่วไป </p>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <a href="/view/res_register.php">
                                                                <img src="/assets/images/bar/restaurant.png" style="width:60px; height:60px;margin-top: 10px;">
                                                            </a>
                                                            <a href="/view/res_register.php">
                                                                <p style="font-size: 14px"> ผู้ประกอบการ </p>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7" style="border-left:1px solid #ccc;height:160px">
                                                    <form class="form-horizontal" id="loginform" action="/api/loginsession.php" method="post">
                                                        <fieldset>
                                                            <input name="loginemail" id="loginemail" type="text" placeholder="อีเมล" class="form-control input-md">                                                                
                                                            <input name="password" id="password" type="password" placeholder="รหัสผ่าน" class="form-control input-md" style="margin: 10px 0 5px 0">
                                                    <!--         <div class="spacing"><input type="checkbox" name="checkboxes" id="checkboxes-0" value="1"><small> จำฉันไว้</small></div>-->
                                                            <div class="spacing spacing-height"><a href="/view/cus_begin_password_reset.php"><p style="font-size: 14px">ลืมรหัสผ่าน?</p></a><br/></div>
                                                            <div style="margin-top:10px; color:red; height:25px;" id="showerror"></div>
                                                            <button type="submit" id="submitbtn"  class="btn btn-info btn-sm pull-right" style="margin-top:-5px;">ลงชื่อเข้าใช้</button>
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