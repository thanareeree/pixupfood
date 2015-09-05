<?php
include '../api/islogin.php';
include '../view/navbar.php';
include '../api/function.php';
include '../dbconn.php';
?>




<html>
    <head>
        <meta charset="UTF-8">


        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->

        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">

        <?php
        addlink("Test Title");
        ?>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/profile.css">

    </head>
    <body>

        <?php cusnavbar(); ?>


        <!-- start profile -->
        <section id="profile">
            <div class="profilecontainer">
                <div class="headprofile">
                    <img align="left" class="fb-image-lg" src="../assets/images/pearhead.png" alt="Profile image example"/>
                    <img align="left" class="fb-image-profile thumbnail" src="http://lorempixel.com/180/180/people/9/" alt="Profile image example"/>
                    <div class="fb-profile-text">
                        <h1><?= $_SESSION["userdata"]["firstName"] ?>  <?= $_SESSION["userdata"]["lastName"] ?></h1>
                        <a href="#" data-toggle="modal" data-target="#editprofile" style="color:orange;">
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
            <div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="ModalCusLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="ModalCusLabel">Edit Profile</h4>
                        </div>
                        <div class="modal-body">
                            <form action="#" id="cuseditform" name="cuseditform" method="post">
                                <h4>Select Your Profile Picture</h4>
                                <div class="form-group">
                                    <input type="file" name="imgpro" id="imgpro">
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <input type="email" class="form-control" placeholder="Email" id="ecemail">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" placeholder="FirstName" id="ecfname">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" class="form-control" placeholder="LastName" id="eclname">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <textarea class="form-control" placeholder="Address" rows="3" id="ecadd"></textarea>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" placeholder="Zip Code" id="eczip">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <select class="form-control prolist" id="sel1">
                                            <?php
                                            $res = $con->query("SELECT `id`, `name` FROM `province`");
                                            while ($data = $res->fetch_assoc()) {
                                                ?>

                                                <option value="<?= $data['id'] ?>"> <?= $data['name'] ?> </option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="tel" class="form-control" placeholder="Phone" id="ecphone">
                                    </div><br>
                                    <div class="col-md-6 pull-right form-group">
                                        <input type="submit" class="form-control text-uppercase" value="Update">
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
                                        <input type="email" class="form-control" placeholder="Email" id="ecemail">
                                    </div>
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
                        <div class="container">
                            <p style="font-weight:bold">Biography</p>
                            <p> My name's <?= $_SESSION["userdata"]["firstName"] ?>  <?= $_SESSION["userdata"]["lastName"] ?></p>
                            <p> address: <?= $_SESSION["userdata"]["email"] ?></p>
                            <p> Tel: <?= $_SESSION["userdata"]["tel"] ?></p>
                            <p> Email: <?= $_SESSION["userdata"]["email"] ?></p>
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
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div id="inbox" style="margin:15% 0 0 0;">
                                            <div class="fab btn-group show-on-hover dropup" id="add_sa" data-toggle="modal" data-target="#add_address">
                                                <button type="button" class="btn btn-danger btn-io">
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
                </div>
            </div>
        </section> 


        <?php
        show_footer();
        iconscript();
        ?>

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
            $("#addshipbtn").click(function (evt) {
                //alert("มาล่ะ แต่ modal ไม่มา");
                $("#add_address").modal('show');
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

            $("#changeprofile").on("click", "#editprofilebtn", function (e) {
                $("#editprofilemodal").modal('show');

            });

            $("#imgpro").on("change", function (e) {
                var imgsize = $("#imgpro")[0].files[0].size;
                var imgtype = $("#imgpro")[0].files[0].type;
                switch (imgtype) {
                    case 'image/png':
                    case 'image/pjpeg':
                    case 'image/jpeg':
                        break;
                    default :
                        $("#output").html("<b>" + imgtype + "</b>  Unsupport file type!! <br>");
                }
                if (imgsize > 1048576) {
                    $("#output").html("Size: <b>" + imgsize + "</b> too big file!!");
                } else {
                    $("#output").html(" ");
                }
            });

            $("#updateprofilebtn").on("click", function (e) {
                $("#updateprofilebtn").attr("disabled", "disabled");
                $("#updateprofilebtn").html("<img src='../assets/images/loader.gif' style='width:25px; margin:0 auto;'>");
                $.ajax({
                    url: "../customer/update-profile.php",
                    type: "POST",
                    data: new FormData(this),
                    dataType: "html",
                    success: function (returndata) {
                        if (returndata !== "ok") {
                            $("#editprofilemodal").modal('hide');
                            alert(returndata);
                        } else if (returndata == "ok") {
                            alert("start" + returndata + "พัง");
                        }
                    }
                });
            });

        </script>

    </body>
</html>
