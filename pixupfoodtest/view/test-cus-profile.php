<?php
include '../api/islogin.php';
include '../view/navbar.php';
include '../api/function.php';
include '../dbconn.php';
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

        <?php
        addlink();
        iconscript();
        ?>

    </head>
    <body>

        <?php cusnavbar(); ?>

 <div class="container">
        <!-- start profile -->
        <section id="profile" >
           
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
                        <img class="img-circle img-responsive"  src="../assets/images/profile/1.jpg">
                    </div>
                    <div class="col-lg-8 fadeInRight wow">
                        <p>
                            <span> <?= $_SESSION["userdata"]["firstName"] ?>  <?= $_SESSION["userdata"]["lastName"] ?> </span><br>
                            <img src="../assets/images/profile/3/phone_w.png" width="30" height="30"> &nbsp; <span> <?= $_SESSION["userdata"]["tel"] ?> </span><br>
                            <img src="../assets/images/profile/3/email_w.png" width="30" height="30"> &nbsp; <span> <?= $_SESSION["userdata"]["email"] ?></span> <br>
                            <img src="../assets/images/profile/3/map_w.png" width="30" height="30"> &nbsp;  <span><?= $_SESSION["userdata"]["email"] ?></span>
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
           
        </section>

        <!-- Modal show data customer -->
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
                                        <input type="text" name="cusefname" id="cusefname" class="form-control input-lg" placeholder="First Name" tabindex="1" value="<?= $_SESSION["userdata"]["firstName"] ?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="cuselname" id="cuselname" class="form-control input-lg" placeholder="Last Name" tabindex="2" value="<?= $_SESSION["userdata"]["lastName"] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="cusephone" type="text" class="form-control input-lg" id="cusphone" placeholder="Phone Number" tabindex="3" onKeyPress="return chkNumber(this)" maxlength="10" value="<?= $_SESSION["userdata"]["tel"] ?>">
                            </div>
                            <div class="form-group">
                                <input type="email" name="cuseemail" id="cuseemail" class="form-control input-lg" placeholder="Email Address" tabindex="4" value="<?= $_SESSION["userdata"]["email"] ?>">
                            </div>
                            <div class="form-group">
                                <input name="address" type="text" class="form-control input-lg" id="address" placeholder="Address" tabindex="7">
                            </div>
                            <div class="modal-footer form-group">
                                <input type="submit" class="btn btn-primary" name="updateprofilebtn" id="updateprofilebtn" value="Update" >
                                <input type="hidden" id="cusid" value="<?= $_SESSION["userdata"]["id"] ?>">
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
                               
                            </tbody>
                        </table>

                        <div class="row">
                            <div id="inbox">
                                <div class="fab btn-group show-on-hover dropup" id="shipmodal" data-toggle="modal" data-target="#add_address">
                                    <button type="button" class="btn btn-danger btn-io" id="addshipbtn">
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
                        <div class="modal fade addshipmodal" id="add_address" data-backdrop="static" data-keyboard="false" >
                            <div class="modal-dialog" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="shipping_address">Add Other Address</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="addressform" name="addressform" method="post">
                                            <div class="form-group">
                                                <label for="addressinput">Address:</label>
                                                <textarea class="form-control" rows="3" id="addressinput"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="sel1">Select list:</label>
                                                <select class="form-control prolist" id="sel1">
                                                    <?php
        
                                                    $res = $con->query("SELECT `id`, `name` FROM `province`");
                                                    while ($data = $res->fetch_assoc()) {
                                                        ?>

                                                        <option value="<?= $data['id'] ?>"> <?= $data['name'] ?> </option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input name="address" type="text" required class="form-control input-lg" id="addressnaming" placeholder="Address Naming">
                                                <input type="hidden" id="shipcusid" value="<?= $_SESSION["userdata"]["id"] ?>">
                                            </div>

                                            <div class="modal-footer form-group">
                                                <button type="button" id="saveaddbtn" class="btn btn-success">Save</button>
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

       

        <?php
        show_footer();
        ?>

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
            });
        </script>
        <script>
            $('.fab').hover(function () {
                $(this).toggleClass('active');
            });
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <script>
            $("#").on("click", function (e) {
                //alert("มาล่ะ แต่ modal ไม่มา");
                $("#deletemodal").modal('show');
            });

            $("#saveaddbtn").on("click", function (e) {
                $.ajax({
                    url: "../customer/ajaxsave-address.php",
                    type: "POST",
                    data: {"address": $("#addressinput").val(),
                        "proid": $(".prolist").val(),
                        "addnaming": $("#addressnaming").val(),
                        "cusid": $("#shipcusid").val()},
                    dataType: "html",
                    success: function (returndata) {
                        //$("#textinput").val("");
                        if (returndata == "ok") {
                            $("#add_address").modal('hide');
                            // fetchdata();
                        } else {
                            alert("start" + returndata + "พัง");
                        }
                    }
                    //
                });
            });
            function fetchdata() {
                $.ajax({
                    url: "../customer/shipaddresslist.php",
                    type: "POST",
                    dataType: "html",
                    success: function (returndata) {
                        $(".shiplist").html(returndata);
                    }
                });
            }
            fetchdata();


        </script>

    </body>
</html>
