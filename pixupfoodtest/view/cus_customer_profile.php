<?php
include '../api/islogin.php';
?>




<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
        <title>PixupFood - Login and Register Page</title>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">

        <!-- animate css -->
        <link rel="stylesheet" href="../assets/css/animate.min.css">
        <!-- bootstrap css -->
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <!-- font-awesome -->
        <!--<link rel="stylesheet" href="../assets/css/font-awesome.min.css"> -->


        <!-- custom css -->
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/search.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/simple-sidebar.css" />
        <script>
            $(document).ready(function () {
                $("#navshoplist").click(function () {
                    $("#shoplist").fadeIn(5000);
                    $("#favlist").hide();
                    $("#history").hide();
                    $("#shipadd").hide();
                })

                $("#navfavlist").click(function () {
                    $("#shoplist").hide();
                    $("#favlist").fadeIn(5000);
                    $("#history").hide();
                    $("#shipadd").hide();
                })

                $("#navhistory").click(function () {
                    $("#shoplist").hide();
                    $("#favlist").hide();
                    $("#history").fadeIn(5000);
                    $("#shipadd").hide();
                })

                $("#navshipadd").click(function () {
                    $("#shoplist").hide();
                    $("#favlist").hide();
                    $("#history").hide();
                    $("#shipadd").fadeIn(5000);
                })
            })
        </script> 

    </head>
    <body>
        <!-- start preloader -->
        <div class="preloader">
            <div class="loader"></div>
        </div>
        <!-- end preloader -->
        <!-- start navigation -->
        <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
            <div class="navbar-header" style="padding-left:10px;" >
                <a href="#menu-toggle" id="menu-toggle">
                    <img src="../assets/images/bar/menu.png" width="50" height="50" style="margin-top:8px;"/>
                </a>
            </div>
            <div id="wrapper" class="toggled menubox">
                <div id="sidebar-wrapper">
                    <ul style="padding-left:0;font-weight:bold;">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#feature">Features</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#download">Download</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="container" style="margin-left:100px;margin-right:40px;height:70px;width:auto;">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                    </button>
                    <a href="index.php" class="navbar-brand">Pixup</a>
                    <a href="index.php" class="navbar-brand" style="color:rgba(0,0,32,1);padding-left: 0px;">Food</a>
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
                        <li><a href="#home">Home</a></li>
                        <li>
                            <img src="../assets/images/bar/user.png" style="width:40px; height:40px; margin-top:15px;margin-left:30px;">
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end navigation -->

        <!-- start profile -->
        <section id="profile" >
            <div class="container">
                <div class="row fadeInUp wow">
                    <div class="col-lg-3 col-md-3" style="padding-top:4%;">
                        <hr style="size:10px;">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h3 class="text-uppercase" style="color:white;">p r o f i l e</h3>
                    </div>
                    <div class="col-lg-3 col-md-3" style="padding-top:4%;">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 fadeInLeft wow" align="center">
                        <img class="img-circle img-responsive" src="../assets/images/profile/1.jpg">
                    </div>
                    <div class="col-lg-8 fadeInRight wow">
                        <p>
                            <span> <?=$_SESSION["userdata"]["firstName"]?>  <?=$_SESSION["userdata"]["lastName"]?> </span><br>
                            <img src="../assets/images/profile/3/phone_w.png" width="30" height="30"> &nbsp; <span> <?=$_SESSION["userdata"]["tel"]?> </span><br>
                            <img src="../assets/images/profile/3/email_w.png" width="30" height="30"> &nbsp; <span> <?=$_SESSION["userdata"]["email"]?></span> <br>
                            <img src="../assets/images/profile/3/map_w.png" width="30" height="30"> &nbsp;  <span><?=$_SESSION["userdata"]["email"]?></span>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 fadeInRight wow" style="text-align:right">
                        <a href="#" data-toggle="modal" data-target="#editprofile" class="text-uppercase" style="padding-top:90%">edit</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 fadeInUp wow">
                        <hr>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Modal customer -->
        <div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="ModalCusLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="ModalCusLabel">Edit Profile</h4>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="cuseditform" name="cuseditform" method="post">
                        <div class="form-group">
                                <input type="file" name="imgpro" id="imgpro">
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="cusefname" id="cusefname" class="form-control input-lg" placeholder="First Name" tabindex="1">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="cuselname" id="cuselname" class="form-control input-lg" placeholder="Last Name" tabindex="2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="cusephone" type="text" class="form-control input-lg" id="cusphone" placeholder="Phone Number" tabindex="3" onKeyPress="return chkNumber(this)" maxlength="10">
                            </div>
                            <div class="form-group">
                                <input type="email" name="cuseemail" id="cuseemail" class="form-control input-lg" placeholder="Email Address" tabindex="4">
                            </div>
                            <div class="form-group">
                                <input name="address" type="text" class="form-control input-lg" id="address" placeholder="Address" tabindex="7">
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="oldecuspwd" id="oldecuspwd" class="form-control input-lg" placeholder="Old Password" tabindex="5">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="newecuspwd" id="newecuspwd" class="form-control input-lg" placeholder="New Password" tabindex="6">
                                        <input type="hidden" value="0" id="available" name="available">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer form-group">
                                <input type="submit" class="btn btn-primary" name="nextbutton" id="nextbutton" value="Update" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end profile-->
        <!-- 4 element -->

        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2 templatemo-box fadeInUp">
                    <a href="#shoplist" data-toggle="tab" id="navshoplist">
                        <img class="img-responsive" src="../assets/images/profile/menu_list/shoplist_b_c.png">
                        <h3 class="text-uppercase elt">shop list</h3>
                    </a>
                </div>
                <div class="col-md-2 templatemo-box fadeInUp">
                    <a href="#favlist" data-toggle="tab" id="navfavlist">
                        <img class="img-responsive" src="../assets/images/profile/menu_list/fav_b_c.png">
                        <h3 class="text-uppercase elt">favorite</h3>
                    </a>       
                </div>
                <div class="col-md-2 templatemo-box fadeInUp">
                    <a href="#history" data-toggle="tab" id="navhistory">
                        <img class="img-responsive" src="../assets/images/profile/menu_list/orderhis_b_c.png">
                        <h3 class="text-uppercase elt">order history</h3>
                    </a>
                </div>
                <div class="col-md-2 templatemo-box fadeInUp">
                    <a href="#shipadd" data-toggle="tab" id="navshipadd">
                        <img class="img-responsive" src="../assets/images/profile/menu_list/shipadd_b_c.png">
                        <h3 class="text-uppercase elt">shipping address</h3>
                    </a>
                </div>
                <div class="col-md-2"></div>
            </div>
            <!-- end 4 element -->
            <div class="tab-content">
                <!-- shop list -->
                <div class="tab-pane fadeIn active" id="shoplist">
                    <div class="content2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-success" style="margin:10px 0 10px 0;">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Tasks</h3>
                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <input type="text" class="form-control" id="task-table-filter" data-action="filter" data-filters="#task-table" placeholder="Filter Tasks" />
                                    </div>
                                    <table class="table table-hover" id="task-table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>List</th>
                                                <th>Restaurant</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                                <th>Confirm</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Site Wireframes</td>
                                                <td>John Smith</td>
                                                <td>4</td>
                                                <td>40</td>
                                                <td>160</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Confirm"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Confirm" ><span class="glyphicon glyphicon-ok"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Mobile Landing Page</td>
                                                <td>Kilgore Trout</td>
                                                <td>4</td>
                                                <td>40</td>
                                                <td>160</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Confirm"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Confirm" ><span class="glyphicon glyphicon-ok"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Add SEO tags</td>
                                                <td>Bob Loblaw</td>
                                                <td>4</td>
                                                <td>40</td>
                                                <td>160</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Confirm"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Confirm" ><span class="glyphicon glyphicon-ok"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Migrate to Bootstrap 3</td>
                                                <td>Emily Hoenikker</td>
                                                <td>4</td>
                                                <td>40</td>
                                                <td>160</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Confirm"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Confirm" ><span class="glyphicon glyphicon-ok"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Update jQuery library</td>
                                                <td>Holden Caulfield</td>
                                                <td>4</td>
                                                <td>40</td>
                                                <td>160</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Confirm"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Confirm" ><span class="glyphicon glyphicon-ok"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Issues in IE7</td>
                                                <td>Jane Doe</td>
                                                <td>4</td>
                                                <td>40</td>
                                                <td>160</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Confirm"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Confirm" ><span class="glyphicon glyphicon-ok"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Bugs from Sprint 14</td>
                                                <td>Kilgore Trout</td>
                                                <td>4</td>
                                                <td>40</td>
                                                <td>160</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Confirm"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Confirm" ><span class="glyphicon glyphicon-ok"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="Confirm" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Success</h4>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-success"><span class="glyphicon glyphicon-warning-sign"></span> Order Success =)</div>

                            </div>
                        </div>
                        <!-- /.modal-content --> 
                    </div>
                    <!-- /.modal-dialog --> 
                </div>

                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                            </div>
                        </div>
                        <!-- /.modal-content --> 
                    </div>
                    <!-- /.modal-dialog --> 
                </div>
                <!-- end shop list -->

                <!-- favorite list -->
                <div class="tab-pane fade" id="favlist">
                    <div class="content2" style="padding-bottom:15px">
                        <ul class="media-list main-list">
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/150x90" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                    <p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p>
                                </div>
                            </li><hr>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/150x90" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                    <p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p>
                                </div>
                            </li><hr>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/150x90" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                    <p class="by-author">By Jhon Doe</p>
                                    <p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p>
                                </div>
                            </li><hr>
                        </ul>
                    </div>
                </div>
                <!-- end favorite list -->

                <!-- order history -->
                <div class="tab-pane fade" id="history">
                    <div class="content2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-success" style="margin:10px 0 10px 0;">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Tasks</h3>
                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <input type="text" class="form-control" id="task-table-filter" data-action="filter" data-filters="#task-table" placeholder="Filter Tasks" />
                                    </div>
                                    <table class="table table-hover" id="task-table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>List</th>
                                                <th>Restaurant</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>View</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Site Wireframes</td>
                                                <td>John Smith</td>
                                                <td>160</td>
                                                <td>Waiting</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="View"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#View" ><span class="glyphicon glyphicon-list-alt"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Mobile Landing Page</td>
                                                <td>Kilgore Trout</td>
                                                <td>160</td>
                                                <td>Waiting</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="View"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#View" ><span class="glyphicon glyphicon-list-alt"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Add SEO tags</td>
                                                <td>Bob Loblaw</td>
                                                <td>160</td>
                                                <td>Finished</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="View"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#View" ><span class="glyphicon glyphicon-list-alt"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Migrate to Bootstrap 3</td>
                                                <td>Emily Hoenikker</td>
                                                <td>160</td>
                                                <td>Finished</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="View"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#View" ><span class="glyphicon glyphicon-list-alt"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Update jQuery library</td>
                                                <td>Holden Caulfield</td>
                                                <td>160</td>
                                                <td>Finished</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="View"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#View" ><span class="glyphicon glyphicon-list-alt"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Issues in IE7</td>
                                                <td>Jane Doe</td>
                                                <td>160</td>
                                                <td>Finished</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="View"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#View" ><span class="glyphicon glyphicon-list-alt"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Bugs from Sprint 14</td>
                                                <td>Kilgore Trout</td>
                                                <td>160</td>
                                                <td>Finished</td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="View"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#View" ><span class="glyphicon glyphicon-list-alt"></span></button></p></td>
                                                <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="Confirm" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Success</h4>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-success"><span class="glyphicon glyphicon-warning-sign"></span> Order Success =)</div>

                            </div>
                        </div>
                        <!-- /.modal-content --> 
                    </div>
                    <!-- /.modal-dialog --> 
                </div>
                <!-- end order history -->

                <!-- shipping address -->
                <div class="tab-pane fade" id="shipadd">
                    <div class="content2">
                        <table class="table table-hover" id="task-table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Address</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>123 ม.4 ต.ยยยยยยยย</td>
                                                <td><p><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit" disabled="disabled"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                                                <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>3848 ม.บางมด</td>
                                                <td><p><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                                                <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                            </tr>
                                            </tbody>
                                            </table>
                                            	<div class="row">
		        <div id="inbox">
          <div class="fab btn-group show-on-hover dropup" id="add_sa" data-toggle="modal" data-target="#add_address">
          <button type="button" class="btn btn-danger btn-io">
          <span class="fa-stack fa-2x">
                <i class="fa fa-circle fa-stack-2x fab-backdrop"></i>
                <i class="fa fa-plus fa-stack-1x fa-inverse fab-primary"></i>
                <i class="fa fa-pencil fa-stack-1x fa-inverse fab-secondary"></i>
            </span>
          </button>
        </div>
        </div>
	</div>
    
    <!-- Add Shipping address Modal -->
        <div class="modal fade" id="add_address" tabindex="-1" role="dialog" aria-labelledby="shipping_address">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="shipping_address">Add Other Address</h4>
                    </div>
                        <div class="modal-body">
                        <form action="#" id="addressform" name="addressform" method="post">
                            
                            <div class="form-group">
                                <input name="address" type="text" required class="form-control input-lg" id="address" placeholder="Address">
                            </div>
                           
                            <div class="modal-footer form-group">
                                <input type="submit" class="btn btn-primary" name="nextbutton" id="nextbutton" value="Update" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    
                    </div>
                </div>
                
                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your Shipping Address</h4>
      </div>
          <div class="modal-body">
        <div class="form-group">
        <textarea rows="2" class="form-control" placeholder="Address เก่า"></textarea>
        
        </div>
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
                <!-- end shipping address -->
            </div>
        </div>
        <!-- start footer -->
        <footer>
            <div class="container" style="margin-top:90px">
                <div class="row">
                    <p>Copyright © 2015 PixupFood</p>
                    <p>School of Information Technology</p>
                    <p>King Mongkut’s University of Technology Thonburi</p>
                </div>
            </div>
        </footer>
        <!-- end footer -->
        <!-- script references -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/scripts.js"></script>
        <script>
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
        <script src="../assets/js/jquery.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/jquery.singlePageNav.min.js"></script>
        <script src="../assets/js/custom.js"></script>
        <script>
            (function () {
                'use strict';
                var $ = jQuery;
                $.fn.extend({
                    filterTable: function () {
                        return this.each(function () {
                            $(this).on('keyup', function (e) {
                                $('.filterTable_no_results').remove();
                                var $this = $(this),
                                        search = $this.val().toLowerCase(),
                                        target = $this.attr('data-filters'),
                                        $target = $(target),
                                        $rows = $target.find('tbody tr');

                                if (search == '') {
                                    $rows.show();
                                } else {
                                    $rows.each(function () {
                                        var $this = $(this);
                                        $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                                    })
                                    if ($target.find('tbody tr:visible').size() === 0) {
                                        var col_count = $target.find('tr').first().find('td').size();
                                        var no_results = $('<tr class="filterTable_no_results"><td colspan="' + col_count + '">No results found</td></tr>')
                                        $target.find('tbody').append(no_results);
                                    }
                                }
                            });
                        });
                    }
                });
                $('[data-action="filter"]').filterTable();
            })(jQuery);

            $(function () {
                // attach table filter plugin to inputs
                $('[data-action="filter"]').filterTable();

                $('.container').on('click', '.panel-heading span.filter', function (e) {
                    var $this = $(this),
                            $panel = $this.parents('.panel');

                    $panel.find('.panel-body').slideToggle();
                    if ($this.css('display') != 'none') {
                        $panel.find('.panel-body input').focus();
                    }
                });
                $('[data-toggle="tooltip"]').tooltip();
            })
        </script>
		<script>
        $('.fab').hover(function () {
    $(this).toggleClass('active');
});
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
        </script>
    </body>
</html>
