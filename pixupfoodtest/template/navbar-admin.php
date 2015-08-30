<?php

function addlink($title) { ?>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/search.css">
    <!--<link rel="stylesheet" type="text/css" href="../assets/css/simple-sidebar.css" />-->
    <link rel="stylesheet" href="../assets/Supermarket/stylesheet.css">
    <link rel="stylesheet" href="../assets/css/fresh-bootstrap-table.css">

<?php } ?>

<?php

function navAdminAfterLogin() { ?>
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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Restaurant Management  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../view/admin-index.php">New Restaurant</a></li>
                            <li><a href="../view/admin-restaurant-showall.php">All Restaurant</a></li>
                            <li><a href="../view/admin-restaurant-promotion.php">All Promotion</a></li>
                            <li><a href="../view/admin-restaurant-editmenu.php">Edit Menu</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../view/admin-restaurant-serviceplan.php">Service Plan</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="../view/admin-cutomer-showall.php"  role="button" aria-haspopup="true" aria-expanded="false">Customer Management </a>
                    </li>
                    <li>
                        <a href="../view/admin-backoffice.php"  role="button" aria-haspopup="true" aria-expanded="false">Back Office</a> 
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right" id="navright-after"  > 
                    <li><a href="../admin/logout.php"><span class="glyphicon glyphicon-user" style="margin: 8px -5px;"></span></a></li>
                    <li><a href="../admin/logout.php"><span style="font-weight: bold;"><?= $_SESSION["userdata"]["username"] ?></span></a></li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
<?php } ?>





