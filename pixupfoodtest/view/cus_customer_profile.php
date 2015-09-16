<?php
include '../api/islogin.php';
include '../dbconn.php';
?>




<html>
    <head>

        <title>Customer Profile</title>
        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/profile.css">


    </head>
    <body>
        <?php
        $cusid = $_SESSION["userdata"]["id"];
        $res2 = $con->query("select * from customer where id = '$cusid' ");
        $data2 = $res2->fetch_assoc();

        $res3 = $con->query("SELECT * FROM `shippingAddress` WHERE customer_id = '$cusid'");
        ?>

        <?php include '../template/customer-navbar.php'; ?>
        <!-- start profile -->
        <section id="profile">
            <div class="profilecontainer">
                <div class="headprofile"> 
                    <img align="left" class="fb-image-lg" src="../assets/images/pearhead.png" alt="Profile image example"/>
                    <img align="left" class="fb-image-profile thumbnail" src="<?= $data2["img_path"] ?>" id="imgprofile"/>
                        <div class="fb-profile-text">

                            <h1><?= $data2["firstName"] ?>  <?= $data2["lastName"] ?></h1>
                            <span style="color: white"></span>
                            <a href="#" data-toggle="modal" data-target="#editprofilemodal"style="color:orange;">
                                <i class="fa fa-pencil"></i> Edit Profile
                            </a>
                            <a href="#" data-toggle="modal" data-target="#chpassform" style="color:orange;margin: 0 0 0 30px;">
                                <i class="fa fa-asterisk"></i> Change password
                            </a>
                        </div>
                </div>
            </div> <!-- /container -->
            <!-- edit profile -->

            <!-- Modal customer -->
            <div class="modal fade" id="editprofilemodal" tabindex="-1" role="dialog" aria-labelledby="ModalCusLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="ModalCusLabel">Edit Profile<span id="cusidedit" style="display: none"></span></h4>
                        </div>
                        <div class="modal-body">
                            <form action="../customer/update-profile.php?id=<?= $data2["id"] ?>" id="cuseditform" name="cuseditform" method="post" enctype="multipart/form-data">
                                <h4>Select Your New Profile Picture</h4>

                                <div class="form-group">
                                    <input type="file" name="imgpro" id="imgpro" >
                                    <p id="output" style="color: red"></p>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <input type="email" class="form-control" placeholder="Email" id="ecemail" name="ecemail" value="<?= $data2["email"] ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" placeholder="FirstName" id="ecfname" name="ecfname" value="<?= $data2["firstName"] ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" placeholder="LastName" id="eclname" name="eclname" value="<?= $data2["lastName"] ?>">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <textarea class="form-control" placeholder="Address" rows="3" id="ecadd" name="ecadd" > <?= $data2["address"] ?></textarea>
                                    </div> 
                                    <div class="col-md-12 form-group">
                                        <input type="tel" class="form-control" placeholder="Phone" id="ecphone" name="ecphone" value="<?= $data2["tel"] ?>">
                                    </div><br>
                                    <div class="col-md-3 pull-right form-group">
                                        <input type="submit" class="form-control text-uppercase" id="updateprobtn" value="Update">
                                    </div>
                                    <div class="col-md-3 pull-right form-group">
                                        <input type="button"  class="form-control btn-danger text-uppercase"  id="canceleditpro" value="Cancel">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end edit profile-->
            <!-- ch pass form -->
            <div class="modal fade" id="chpassform" tabindex="-1" role="dialog" aria-labelledby="chpassform">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="chpassform">Change password</h4>
                        </div>
                        <div class="modal-body">
                            <form action="#" id="chpassform" name="chpassform" method="post">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <input required type="password" class="form-control" placeholder="Old Password" id="crpass">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input required type="password" class="form-control" placeholder="New Password" id="ncrcpass">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input required type="password" class="form-control" placeholder="Confirm New Password" id="cncrcpass">
                                    </div>
                                    <div class="col-md-6 pull-right form-group">
                                        <input type="submit" class="form-control text-uppercase" value="Confirm">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end change password -->
            <div class="container">
                <div class="row" style="margin-top:50px">
                    <div class="col-md-3">
                        <div class="container_field">
                            <div class="showbio">
                                <p style="font-weight:bold">Biography</p>
                                <p><span class="glyphicon glyphicon-home"></span>&nbsp;<?= $data2["address"] ?></p>
                                <p><span class="glyphicon glyphicon-earphone"></span>&nbsp;<?= $data2["tel"] ?></p>
                                <p><span class="glyphicon glyphicon-envelope"></span>&nbsp;<?= $data2["email"] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-8">
                        <!-- 4 element -->
                        <div class="row">
                            <div class="col-md-2 templatemo-box fadeInUp webfont">
                                <a href="#shoplist" data-toggle="tab" id="navshoplist">
                                    <img class="img-responsive imgsize" src="../assets/images/profile/menu_list/shoplist_b_c.png" title="ตะกร้า" onmouseover="this.src = '../assets/images/profile/menu_list/shoplist_a_c.png';"
                                         onmouseout="this.src = '../assets/images/profile/menu_list/shoplist_b_c.png';" style="margin: 0 0 0 10px">
                                    <p class="elt" style="margin: 0 0 0 20px">ตะกร้า</p>
                                </a>
                            </div>
                            <div class="col-md-2 templatemo-box fadeInUp">
                                <a href="#favlist" data-toggle="tab" id="navfavlist">
                                    <img class="img-responsive imgsize" src="../assets/images/profile/menu_list/fav_b_c.png" title="ชื่นชอบ" onmouseover="this.src = '../assets/images/profile/menu_list/fav_a_c.png';"
                                         onmouseout="this.src = '../assets/images/profile/menu_list/fav_b_c.png';" style="margin: 0 0 0 15px">
                                    <p class="elt" style="margin: 0 0 0 20px">ชื่นชอบ</p>
                                </a>       
                            </div>
                            <div class="col-md-2 templatemo-box fadeInUp">
                                <a href="#history" data-toggle="tab" id="navhistory">
                                    <img class="img-responsive imgsize" src="../assets/images/profile/menu_list/orderhis_b_c.png" title="ประวัติการสั่งซื้อ" onmouseover="this.src = '../assets/images/profile/menu_list/orderhis_a_c.png';"
                                         onmouseout="this.src = '../assets/images/profile/menu_list/orderhis_b_c.png';" style="margin: 0 0 0 20px">
                                    <p class="elt" style="margin:0">ประวัติการสั่งซ้อ</p>
                                </a>
                            </div>
                            <div class="col-md-2 templatemo-box fadeInUp">
                                <a href="#shipadd" data-toggle="tab" id="navshipadd">
                                    <img class="img-responsive imgsize" src="../assets/images/profile/menu_list/shipadd_b_c.png" title="ที่อยู่การจัดส่ง" onmouseover="this.src = '../assets/images/profile/menu_list/shipadd_a_c.png';"
                                         onmouseout="this.src = '../assets/images/profile/menu_list/shipadd_b_c.png';" style="margin: 0 0 0 15px">
                                    <p class="elt" style="margin:0">ที่อยู่การจัดส่ง</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content" style="margin-top:-50px;">
                            <!-- shop list -->
                            <div class="tab-pane fade in active" id="shoplist">
                                <div class="content2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-success" style="margin:10px 0 10px 0;">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Tasks</h3>
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
                                <div class="content2" id="">
                                    <?php
                                    $result = $con->query("SELECT * FROM `shippingAddress` where customer_id = '$cusid'");
                                    $i = 2;
                                    ?>

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
                                                <td><?= $data2['address'] ?></td>
                                                <td>
                                                    <p>
                                                        <button class="btn btn-primary btn-xs"  disabled="disabled">
                                                            <span class="glyphicon glyphicon-pencil"></span>
                                                        </button>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p>
                                                        <button class="btn btn-danger btn-xs" data-title="Delete" disabled="disabled">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </button>
                                                    </p>
                                                </td>
                                            </tr>
                                            <?php while ($data4 = $result->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $data4['address'] ?></td>
                                                    <td>
                                                        <p>
                                                            <button class="btn btn-primary btn-xs editadd" id="editadd<?= $data4["id"] ?>"  >
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </button>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            <button class="btn btn-danger btn-xs deleteadd" id="deleteadd<?= $data4["id"] ?>" data-title="Delete"  >
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                            </button>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div id="inbox" style="margin:15% 0 0 0;">
                                            <div class="fab btn-group show-on-hover dropup" id="add_sa" data-toggle="modal" data-target="#add_address">
                                                <button type="button" class="btn btn-danger glyphicon glyphicon-plus btn-io">
                                                    <span class="fa-stack fa-2x">
                                                        <i class="fa fa-circle fa-stack-2x fab-backdrop"></i>
                                                        <i class="fa fa-plus fa-stack-1x fa-inverse fab-primary"></i>
                                                        <i class="fa fa-plus fa-stack-1x fa-inverse fab-secondary"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add Shipping address Modal -->
                                    <div class="modal fade" id="add_address" tabindex="-1" role="dialog" aria-labelledby="shipping_address">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="../customer/add-shipping-address.php?id=<?= $cusid ?>" id="addressform" name="addressform" method="post">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="shipping_address">เพิ่มที่จัดส่งสินค้า</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        <label for="address">รายละเอียดที่จัดส่งสินค้า:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
                                                        <div class="form-group">
                                                            <textarea required class="form-control" placeholder="ที่จัดส่งสินค้า" rows="3"  name="address" id="address"></textarea>
                                                        </div>
                                                        <label for="addtype">ประเภทที่อยู่อาศัย:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
                                                        <div class="form-group" >
                                                            <select name="addtype" id="addtype" class="col-sm-12" required>
                                                                <option value="อพาร์ทเมนท์">อพาร์ทเมนท์</option>
                                                                <option value="สถานที่ราชการ">สถานที่ราชการ</option>
                                                                <option value="มหาวิทยาลัย">มหาวิทยาลัย</option>
                                                                <option value="โรงพยาบาล">โรงพยาบาล</option>
                                                                <option value="โรงแรม">โรงแรม</option>
                                                                <option value="บ้าน">บ้าน</option>
                                                                <option value="ตลาด">ตลาด</option>
                                                                <option value="โรงเรียน">โรงเรียน</option>
                                                                <option value="ร้านค้า">ร้านค้า</option>
                                                                <option value="วัด">วัด</option>
                                                                <option value="อื่นๆ">อื่นๆ</option>
                                                            </select>
                                                        </div>
                                                        <label for="addnaming">กรุณาใส่ข้อมูลระบุที่จัดส่งเพื่อความรวดเร็ว:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
                                                        <div class="form-group">
                                                            <input required class="form-control" placeholder="ชื่อเรียกที่จัดส่งเพื่อความรวดเร็ว"  name="addnaming" id="addnaming">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div>
                                                            <input type="reset" class="btn btn-warning col-sm-3" name="resetbtn" value="Reset" >
                                                            <input type="submit" class="btn btn-primary col-sm-3" name="addbtn"  value="Add" >
                                                        </div>
                                                    </div> 
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="modal fade" id="edit_addshipmodal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="../customer/edit-shipping-address.php?id=<?= $cusid ?>" method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="shipping_address">เปลี่ยนแปลงข้อมูลที่จัดส่งสินค้า<span id="showadd_id"></span></h4>
                                            </div>
                                            <div id="formeditaddrsss">

                                            </div>
                                            <div class="modal-footer">
                                                <div>
                                                    <input type="reset" class="btn btn-warning col-sm-3" name="resetbtn" value="Reset" >
                                                    <input type="submit" class="btn btn-primary col-sm-3" name="updateaddbtn"  value="Update" >
                                                </div>
                                            </div> 
                                        </form>
                                    </div>
                                    <!-- /.modal-content --> 
                                </div>
                                <!-- /.modal-dialog --> 
                            </div>
                            <!-- end shipping address -->

                            <div class="modal fade" id="delete-addmodal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                            <h4 class="modal-title custom_align" id="Heading">ลบข้อมูลที่จัดส่ง<span id="showadddel_id" ></span></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> คุณต้องการลบข้อมูลที่จัดส่งนี้ ?</div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                                            <button type="submit" class="btn btn-success" id="deleteaddyes"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content --> 
                                </div>
                                <!-- /.modal-dialog --> 
                            </div>
                            <!-- end shop list -->



                        </div>
                    </div>
                </div>
            </div>
        </section> 


        <?php include '../template/footer.php'; ?>

        <script>
            (function () {
                'use strict';
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
            $(document).ready(function () {



                $("#addshipbtn").click(function (evt) {
                    alert(cusid + "---23456");
                    //$("#add_address").modal('show');
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




                $("#imgpro").on("change", function (e) {
                    var imgsize = $("#imgpro")[0].files[0].size;
                    var imgtype = $("#imgpro")[0].files[0].type;
                    switch (imgtype) {
                        case 'image/png':
                        case 'image/pjpeg':
                        case 'image/jpeg':
                            break;
                        default :
                            $("#output").html("Error: <b>" + imgtype + "</b>  Unsupport file type!! <br>");
                            $("#sendbtn").attr("disabled", "disabled");
                    }
                    if (imgsize > 1048576) {
                        $("#output").html("Size: <b>" + imgsize + "</b> too big file!!");
                        $("#updateprobtn").attr("disabled", "disabled");
                    } else {
                        $("#output").html(" ");
                        $("#updateprobtn").removeAttr("disabled");
                    }
                });

                $("#canceleditpro").on("click", function (e) {
                    alert($("#ecfname").val() + "" + $("#ecemail").val() + "" + $("#ecphone").val() + "" + $("#ecadd").val() + "" + $("#eclname").val());
                    //$("#editprofile").find('input:text, input:password, input:file, select, textarea').val('');
                    //$("#editprofile").find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');


                });

                $(".editadd").click(function (e) {
                    var editid = $(this).attr("id");
                    var add_id = editid.replace("editadd", "");
                    $("#showadd_id").html(add_id);
                    $.ajax({
                        url: "../customer/shipping-formmodal.php",
                        type: "POST",
                        data: {"id": add_id},
                        dataType: "html",
                        success: function (returndata) {
                            $("#formeditaddrsss").html(returndata);
                            $("#edit_addshipmodal").modal('show');
                        }
                    });
                });

                $(".deleteadd").click(function (e) {
                    var delid = $(this).attr("id");
                    var add_id = delid.replace("deleteadd", "");
                    $("#showadddel_id").html(add_id);
                    $("#delete-addmodal").modal('show');

                });

                $("#deleteaddyes").click(function (e) {
                    $("#deleteaddyes").attr("disabled", "disabled");
                    $.ajax({
                        url: "../customer/delete-shipping-address.php",
                        type: "POST",
                        data: {"id": $("#showadddel_id").html()},
                        dataType: "html",
                        success: function (returndata) {
                            if (returndata == "ok") {
                                $("#delete-addmodal").modal('hide');
                                document.location.reload();
                                //fetchdataShowall();

                            } else {
                                alert(returndata);
                            }

                        }
                    });
                });



            });

        </script>

    </body>
</html>
