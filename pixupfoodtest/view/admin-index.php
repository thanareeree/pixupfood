<?php

include '../admin/islogin.php';
include '../template/navbar-admin.php';
include '../dbconn.php';
?>


<html>
    <head>
        <meta charset="UTF-8">

        <?php addlink("Admin Management"); ?>
    </head>
    <body>
        <nav class="navbar navbar-default" >
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand" style="margin-left: 20px; ">Pixup</a>
                    <a href="#" class="navbar-brand" style="color:rgba(0,0,32,1);padding-left: 0px;">Food</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
                    <ul class="nav navbar-nav" id="nav-after-login" >
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Customer Management <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Restaurant Management <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Back Office<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right" id="navright-after"  > 
                        <li><a href="../admin/logout.php"><span class="glyphicon glyphicon-user" style="margin: 8px -5px;"></span></a></li>
                        <li><a href="../admin/logout.php"><span style="font-weight: bold;"><?= $_SESSION["userdata"]["username"] ?></span></a></li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <script src="../assets/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        
        <script>
            $(document).ready(function (e) {
                
                
            });
        </script>
    </body>
</html>
