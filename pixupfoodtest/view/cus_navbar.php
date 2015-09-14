<?php
//session_start();
include '../dbconn.php';
$id = $_SESSION["userdata"]["id"];
$res = $con->query("select * from customer where id = '$id'");
$data = $res->fetch_assoc();

function cusnavbar() { ?>
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
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control input-lg" placeholder="Search.." />
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="button">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <ul class="nav navbar-nav navbar-right text-uppercase">
                    <li><a href="../api/logout.php" class="nav-link"><?= $data["firstName"] . " " . $data["lastName"] ?></a></li>
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
                                                <div class="col-md-4" style="border-right:1px solid #ccc;height:auto;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <a href="cus_customer_profile.php">
                                                                <img src="../assets/images/profile/1.jpg" width="160px" height="160px">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <form class="form-horizontal">
                                                        <fieldset>
                                                            <input id="textinput" name="textinput" type="text" placeholder="Enter User Name" class="form-control input-md"><br>
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


<?php } ?>

 
