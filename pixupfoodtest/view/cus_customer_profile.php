<?php
include '../api/islogin.php';
include '../dbconn.php';
?>




<html>
    <head>

        <title>Customer Profile</title>
        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/profile.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

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
                    <img align="left" class="fb-image-lg" src="/assets/images/pearhead.png" alt="Profile image example"/>
                    <img align="left" class="fb-image-profile thumbnail" src="<?= ($data2["img_path"] == "" ? '/assets/images/defaulf-profile.png' : $data2["img_path"]) ?>" id="imgprofile" style="max-width: 175px;" height="175px"/>
                    <div class="fb-profile-text">

                        <h1><?= $data2["firstName"] ?>  <?= $data2["lastName"] ?> | หมายเลขสมาชิก: <?= $data2["id"] ?></h1>
                        <span style="color: white"></span>
                        <a href="#" data-toggle="modal" data-target="#editprofilemodal"style="color:orange;">
                            <i class="fa fa-pencil"></i> แก้ไขข้อมูลส่วนตัว
                        </a>
                        <a href="#" data-toggle="modal" data-target="#chpassform" style="color:orange;margin: 0 0 0 30px;">
                            <i class="fa fa-asterisk"></i> เปลี่ยนรหัสผ่าน
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
                            <form action="/customer/update-profile.php?id=<?= $data2["id"] ?>" id="cuseditform" name="cuseditform" method="post" enctype="multipart/form-data">
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
                        <div class="card">
                            <div class="card-content">
                                <p style="font-weight:bold">ข้อมูลส่วนตัว</p>
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
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-2 templatemo-box fadeInUp" style="padding-right: 0;">
                                        <a href="#tracking" data-toggle="tab" id="navtracking">
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/tracking_b_c.png" title="ตรวจสถานะสินค้า" onmouseover="this.src = '/assets/images/profile/menu_list/tracking_a_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/tracking_b_c.png';" style="margin: 0 0 0 15px">
                                            <p class="elt" style="margin: 0;padding: 0 0 0 2px;">ตรวจสถานะสินค้า</p>
                                        </a>
                                    </div>
                                    <div class="col-md-2 templatemo-box fadeInUp">
                                        <a href="#history" data-toggle="tab" id="navhistory">
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/orderhis_b_c.png" title="ประวัติการสั่งซื้อ" onmouseover="this.src = '/assets/images/profile/menu_list/orderhis_a_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/orderhis_b_c.png';" style="margin: 0 0 0 20px">
                                            <p class="elt" style="margin:0 0 0 8px">ประวัติการซื้อ</p>
                                        </a>
                                    </div>
                                    <div class="col-md-2 templatemo-box fadeInUp">
                                        <a href="#shoplist" data-toggle="tab" id="navshoplist">
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/shoplist_b_c.png" title="ตะกร้า" onmouseover="this.src = '/assets/images/profile/menu_list/shoplist_a_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/shoplist_b_c.png';" style="margin: 0 0 0 10px">
                                            <p class="elt" style="margin: 0 0 0 20px">ตะกร้า</p>
                                        </a>
                                    </div>
                                    <div class="col-md-2 templatemo-box fadeInUp" style="padding:0;">
                                        <a href="#favlist" data-toggle="tab" id="navfavlist">
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/fav_b_c.png" title="ชื่นชอบ" onmouseover="this.src = '/assets/images/profile/menu_list/fav_a_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/fav_b_c.png';" style="margin: 0 0 0 15px">
                                            <p class="elt" style="margin: 0 0 0 20px">ชื่นชอบ</p>
                                        </a>       
                                    </div>
                                    <div class="col-md-2 templatemo-box fadeInUp" style="padding-left: 0;">
                                        <a href="#shipadd" data-toggle="tab" id="navshipadd">
                                            <img class="img-responsive imgsize" src="/assets/images/profile/menu_list/shipadd_b_c.png" title="ที่อยู่การจัดส่ง" onmouseover="this.src = '/assets/images/profile/menu_list/shipadd_a_c.png';"
                                                 onmouseout="this.src = '/assets/images/profile/menu_list/shipadd_b_c.png';" style="margin: 0 0 0 15px">
                                            <p class="elt" style="margin:0">ที่อยู่การจัดส่ง</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content" style="margin-top:-80px;">
                            <!-- shop list -->
                            <div class="tab-pane fade " id="shoplist">
                                <div class="content2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-success" style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">
                                                            รายการทั้งหมด 
                                                        </div>
                                                        <!-- ตารางรายการตะกร้า -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="#" method="get">
                                                                    <div class="input-group">
                                                                        <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                                                        <input class="form-control" id="system-search3" name="q" placeholder="ค้นหาข้อมูลในตารางนี้" required style="height: 34px;">
                                                                        <span class="input-group-btn">
                                                                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <table class="table table-list-search3">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>รายการอาหาร</th>
                                                                            <th>ร้านอาหาร</th>
                                                                            <th>จำนวน(ชุด)</th>
                                                                            <th>รายละเอียด</th>
                                                                            <th>ส่งออเดอร์</th>
                                                                            <th>นำออก</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table table-condensed table-hover">
                                                                        <tr>
                                                                            <td>1</td>                        
                                                                            <td>ข้าวกล้อง+ผัดกระเพาหมู+ไข่ดาว</td>
                                                                            <td>ร้านโฮมเรส</td>
                                                                            <td>50</td>
                                                                            <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#detail' href="#detail"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                            <td class="text-center"><a class="btn btn-success btn-xs" data-toggle="modal" data-target='#accept' href="#accept"><span class="glyphicon glyphicon-check"></span> สั่ง</a></td>
                                                                            <td class="text-center"><a class="btn btn-danger btn-xs" data-toggle="modal" data-target='#ignore' href="#ignore"><span class="glyphicon glyphicon-trash"></span> นำออก</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2</td>
                                                                            <td>ข้าวหอมมะลิ+หมูกระเทียม+ผัดผักรวม</td>
                                                                            <td>ร้านโฮมเรส</td>
                                                                            <td>50</td>
                                                                            <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#detail' href="#detail"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                            <td class="text-center"><a class="btn btn-success btn-xs" data-toggle="modal" data-target='#accept' href="#accept"><span class="glyphicon glyphicon-check"></span> สั่ง</a></td>
                                                                            <td class="text-center"><a class="btn btn-danger btn-xs" data-toggle="modal" data-target='#ignore' href="#ignore"><span class="glyphicon glyphicon-trash"></span> นำออก</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>3</td>
                                                                            <td>ข้าวหอมมะลิ+หมูผัดกะปิ+คั่วกลิ้ง</td>
                                                                            <td>ร้านโฮมเรส</td>
                                                                            <td>300</td>
                                                                            <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#detail' href="#detail"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                            <td class="text-center"><a class="btn btn-success btn-xs" data-toggle="modal" data-target='#accept' href="#accept"><span class="glyphicon glyphicon-check"></span> สั่ง</a></td>
                                                                            <td class="text-center"><a class="btn btn-danger btn-xs" data-toggle="modal" data-target='#ignore' href="#ignore"><span class="glyphicon glyphicon-trash"></span> นำออก</a></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>   
                                                            </div>
                                                        </div>
                                                        <!-- จบตารางรายการตะกร้า -->
                                                       
                                                        <!-- accept -->
                                                        <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px; color: red">เตือน!!</div></span>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <span style="font-size: 20px;">ต้องการยอมรับรายการ ? </span>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="button" class="btn btn-success">ยืนยัน</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End accept --> 
                                                        <!-- detail -->
                                                        <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <span class="modal-title" id="myModalLabel">
                                                                            <span style="font-size: 30px; margin-top: 5px;">ร้าน: </span>
                                                                            <span style="font-size: 30px; margin-top: 5px; color: orange">ร้านโฮมเรส </span>     
                                                                        </span>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row" style="margin-top: 0px;">
                                                                            <div class="col-md-12">
                                                                                <div class="col-md-7">
                                                                                    <div class="card">
                                                                                        <div class="card-content">
                                                                                            <span style="font-size: 20px">สถานที่ส่งสินค้า </span>
                                                                                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                                                            <span style="font-size: 17px">บริษัท นาดาว บางกอก จำกัด 92/14 ซอยสุขุมวิท 31 (สวัสดี) แขวงคลองตันเหนือ เขตวัฒนา กทม. 10110</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    <div class="card">
                                                                                        <div class="card-content">
                                                                                            <span style="font-size: 20px">ส่งวันที่: </span>
                                                                                            <span style="font-size: 20px; color: orange;"> 12-11-2015 </span><br>
                                                                                            <span style="font-size: 20px">เวลาประมาณ: </span>
                                                                                            <span style="font-size: 20px; color: orange;"> 12:30 </span><br>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row" style="margin-top: 5px;">
                                                                            <div class="col-md-12">
                                                                                <div class="col-md-12">
                                                                                    <div class="card">
                                                                                        <div class="card-content">
                                                                                            <span style="font-size: 20px">รายการสินค้า </span>
                                                                                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <table class="table table-list-search">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th>รายการ</th>
                                                                                                                <th>ราคาต่อหน่วย/บาท</th>
                                                                                                                <th>จำนวน</th>
                                                                                                                <th>ราคารวม/บาท</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody class="table table-condensed table-hover">
                                                                                                            <tr>                    
                                                                                                                <td>ข้าวกล้อง</td>
                                                                                                                <td style="text-align: center">10.00</td>
                                                                                                                <td style="text-align: center">50</td>
                                                                                                                <td style="text-align: center">500.00</td>

                                                                                                            </tr>
                                                                                                            <tr>                     
                                                                                                                <td>ผัดกระเพราหมู</td>
                                                                                                                <td style="text-align: center">15.00</td>
                                                                                                                <td style="text-align: center">50</td>
                                                                                                                <td style="text-align: center">750.00</td>
                                                                                                            </tr>
                                                                                                            <tr>                    
                                                                                                                <td>ไข่ดาว</td>
                                                                                                                <td style="text-align: center">5.00</td>
                                                                                                                <td style="text-align: center">50</td>
                                                                                                                <td style="text-align: center">250.00</td>
                                                                                                            </tr>
                                                                                                            <tr>                    
                                                                                                                <td>ค่าจัดส่ง</td>
                                                                                                                <td style="text-align: center">100.00</td>
                                                                                                                <td style="text-align: center">1</td>
                                                                                                                <td style="text-align: center">100.00</td>
                                                                                                            </tr>
                                                                                                            <tr class="success">                    
                                                                                                                <td>ราคารวม</td>
                                                                                                                <td style="text-align: center"></td>
                                                                                                                <td style="text-align: center"></td>
                                                                                                                <td style="text-align: center">1,600.00</td>
                                                                                                            </tr>
                                                                                                            <tr class="warning">                  
                                                                                                                <td>ส่วนลด10% 1D23A5</td>
                                                                                                                <td style="text-align: center"></td>
                                                                                                                <td style="text-align: center">1</td>
                                                                                                                <td style="text-align: center">-160.00</td>
                                                                                                            </tr>
                                                                                                            <tr class="danger">                  
                                                                                                                <td>ราคารวมหลังหักส่วนลด</td>
                                                                                                                <td style="text-align: center"></td>
                                                                                                                <td style="text-align: center"></td>
                                                                                                                <td style="text-align: center">1,440.00</td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>   
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" style="margin-top: 5px;">
                                                                            <div class="col-md-12">
                                                                                <div class="col-md-12">
                                                                                    <div class="card">
                                                                                        <div class="card-content">
                                                                                            <span style="font-size: 20px">เพิ่มเติม </span>
                                                                                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                                                            <span style="font-size: 15px; color: red;"> กระเพราไม่ใส่ถั่วฝักยาว </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- favorite list -->
                            <div class="tab-pane fade" id="favlist">
                                <div class="content2" style="padding:0 0 15px 0">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="page-header" style="font-size: 30px; margin-top: 5px">
                                                รายการทั้งหมด 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="media-list main-list">
                                                        <li class="media">
                                                            <a class="pull-left" href="#">
                                                                <img class="media-object" src="/assets/images/profile/fav list/ข้าวผัดกุ้ง.jpg" width="150px" >
                                                            </a>
                                                            <div class="media-body">
                                                                <h3 class="media-heading">ข้าวผัดกุ้ง</h3>
                                                                <p class="by-author">ร้านเจ๊พร</p>
                                                                <p><button class="btn btn-danger btn-xs" data-toggle="modal" data-target='#delfav' href="#delfav"><span class="glyphicon glyphicon-trash"></span> ลบออกจากรายการโปรด</button></p>
                                                            </div>
                                                        </li><hr>
                                                        <li class="media">
                                                            <a class="pull-left" href="#">
                                                                <img class="media-object" src="/assets/images/profile/fav list/ข้าวกระเพราไก่ไข่ดาว.jpg" width="150px">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="media-heading">ข้าวผัดกระเพราไก่+ไข่ดาว</h4>
                                                                <p class="by-author">ร้านโฮมเรส</p>
                                                                <p><button class="btn btn-danger btn-xs" data-toggle="modal" data-target='#delfav' href="#delfav"><span class="glyphicon glyphicon-trash"></span> ลบออกจากรายการโปรด</button></p>
                                                            </div>
                                                        </li><hr>
                                                        <li class="media">
                                                            <a class="pull-left" href="#">
                                                                <img class="media-object" src="/assets/images/profile/fav list/ข้าวปลาหมึกผัดพริก+ไข่ดาว.jpg" width="150px">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="media-heading">ข้าวปลาหมึกผัดพริก+ไข่ดาว</h4>
                                                                <p class="by-author">ร้านรสเด็ด ตลาดกลางเมือง</p>
                                                                <p><button class="btn btn-danger btn-xs" data-toggle="modal" data-target='#delfav' href="#delfav"><span class="glyphicon glyphicon-trash"></span> ลบออกจากรายการโปรด</button></p>
                                                            </div>
                                                        </li><hr>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="media-list main-list">
                                                        <li class="media">
                                                            <a class="pull-left" href="#">
                                                                <img class="media-object" src="/assets/images/profile/fav list/ข้าวหมูทอด.jpg" width="150px" >
                                                            </a>
                                                            <div class="media-body">
                                                                <h3 class="media-heading">ข้าวหมูทอด</h3>
                                                                <p class="by-author">ร้านป้านก</p>
                                                                <p><button class="btn btn-danger btn-xs" data-toggle="modal" data-target='#delfav' href="#delfav"><span class="glyphicon glyphicon-trash"></span> ลบออกจากรายการโปรด</button></p>
                                                            </div>
                                                        </li><hr>
                                                        <li class="media">
                                                            <a class="pull-left" href="#">
                                                                <img class="media-object" src="/assets/images/profile/fav list/ข้าวคลุกกะปิ.jpg" width="150px" >
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="media-heading">ข้าวคลุกกะปิ</h4>
                                                                <p class="by-author">ร้านอาหารกลางเมือง</p>
                                                                <p><button class="btn btn-danger btn-xs" data-toggle="modal" data-target='#delfav' href="#delfav"><span class="glyphicon glyphicon-trash"></span> ลบออกจากรายการโปรด</button></p>
                                                            </div>
                                                        </li><hr>
                                                        <li class="media">
                                                            <a class="pull-left" href="#">
                                                                <img class="media-object" src="http://placehold.it/150x90" alt=".">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                                                <p class="by-author">By Jhon Doe</p>
                                                                <p><button class="btn btn-danger btn-xs" data-toggle="modal" data-target='#delfav' href="#delfav"><span class="glyphicon glyphicon-trash"></span> ลบออกจากรายการโปรด</button></p>
                                                            </div>
                                                        </li><hr>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="delfav" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                                    <h3 class="modal-title custom_align" id="Heading">ลบรายการโปรดของคุณ</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> คุณต้องการลบรายการโปรดนี้ ?</div>
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
                                    <!-- end delete favorite list -->
                                </div>
                            </div>
                            <!-- end favorite list -->

                            <!-- order history -->
                            <div class="tab-pane fade" id="history">
                                <div class="content2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-success" style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">
                                                            รายการทั้งหมด 
                                                        </div>
                                                        <!-- ตารางรายการประวัติ -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="#" method="get">
                                                                    <div class="input-group">
                                                                        <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                                                        <input class="form-control" id="system-search2" name="q" placeholder="ค้นหาข้อมูลในตารางนี้" required style="height: 34px;">
                                                                        <span class="input-group-btn">
                                                                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <table class="table table-list-search2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>เลขที่รายการ</th>
                                                                            <th>รายการอาหาร</th>
                                                                            <th>จำนวน(ขุด)</th>
                                                                            <th>วัน/เวลาที่รับสินค้า</th>
                                                                            <th>ผู้ส่งสินค้า</th>
                                                                            <th>รายละเอียด</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table table-condensed table-hover">
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>102458</td>                         
                                                                            <td>ข้าวกล้อง+ผัดกระเพาหมู+ไข่ดาว</td>
                                                                            <td>50</td>
                                                                            <td>12-11-2015 12:40</td>
                                                                            <td>108suchart</td>
                                                                            <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#hisde' href="#hisde"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2</td>
                                                                            <td>158642</td>
                                                                            <td>ข้าวหอมมะลิ+หมูกระเทียม+ผัดผักรวม</td>
                                                                            <td>50</td>
                                                                            <td>12-11-2015 12:40</td>
                                                                            <td>108suchart</td>
                                                                            <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#hisde' href="#hisde"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>3</td>
                                                                            <td>101121</td>
                                                                            <td>ข้าวหอมมะลิ+หมูผัดกะปิ+คั่วกลิ้ง</td>
                                                                            <td>300</td>
                                                                            <td>30-10-2015 14:35</td>
                                                                            <td>108suchart</td>
                                                                            <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#hisde' href="#hisde"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>   
                                                            </div>
                                                        </div>
                                                        <!-- จบตารางรายการประวัติ -->
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- order tracking -->
                            <div class="tab-pane fade in active" id="tracking">
                                <div class="content2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-success" style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">
                                                            รายการทั้งหมด 
                                                        </div>
                                                        <!-- ตารางรายการติดตาม -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="#" method="get">
                                                                    <div class="input-group">
                                                                        <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                                                        <input class="form-control" id="system-search" name="q" placeholder="ค้นหาข้อมูลในตารางนี้" required style="height: 34px;">
                                                                        <span class="input-group-btn">
                                                                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <table class="table table-list-search">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>เลขที่รายการ</th>
                                                                            <th>รายการอาหาร</th>
                                                                            <th>จำนวน(ขุด)</th>
                                                                            <th>สถานะ</th>
                                                                            <th>รายละเอียด</th>
                                                                            <th>หลักฐานการโอนเงิน</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table table-condensed table-hover">
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>102458</td>                         
                                                                            <td>ข้าวกล้อง+ผัดกระเพาหมู+ไข่ดาว</td>
                                                                            <td>50</td>
                                                                            <td>ปรุงอาหาร</td>
                                                                            <td class="text-center"><button class="btn btn-info btn-xs" data-toggle="modal" data-target='#track' href="#track"><span class="glyphicon glyphicon-eye-open"></span> แสดง</button></td>
                                                                            <td class="text-center"><button class="btn btn-warning btn-xs" data-toggle="modal" data-target='#transf' href="#transf" disabled="disabled"><span class="glyphicon glyphicon-eye-open"></span> อัพโหลด</button></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2</td>
                                                                            <td>158642</td>
                                                                            <td>ข้าวหอมมะลิ+หมูกระเทียม+ผัดผักรวม</td>
                                                                            <td>50</td>
                                                                            <td>ปรุงอาหาร</td>
                                                                            <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#track' href="#track"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                            <td class="text-center"><a class="btn btn-warning btn-xs" data-toggle="modal" data-target='#transf' href="#transf" disabled="disabled"><span class="glyphicon glyphicon-eye-open"></span> อัพโหลด</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>3</td>
                                                                            <td>101121</td>
                                                                            <td>ข้าวหอมมะลิ+หมูผัดกะปิ+คั่วกลิ้ง</td>
                                                                            <td>300</td>
                                                                            <td>ตอบรับ</td>
                                                                            <td class="text-center"><a class="btn btn-info btn-xs" data-toggle="modal" data-target='#track' href="#track"><span class="glyphicon glyphicon-eye-open"></span> แสดง</a></td>
                                                                            <td class="text-center"><a class="btn btn-warning btn-xs" data-toggle="modal" data-target='#transf' href="#transf"><span class="glyphicon glyphicon-eye-open"></span> อัพโหลด</a></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>   
                                                            </div>
                                                        </div>
                                                        <!-- จบตารางรายการติดตาม -->


                                                        <!-- อัพโหลดหลักฐานการโอนเงิน -->
                                                        <!-- tracking -->
                                                        <div class="modal fade" id="transf" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <span class="modal-title" id="myModalLabel">
                                                                            <span style="font-size: 30px; margin-top: 5px;">หลักฐานการโอนเงิน </span>     
                                                                        </span>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row" style="margin-top: 0px;">
                                                                            <div class="col-md-12">
                                                                                <div class="card">
                                                                                    <div class="card-content"> 
                                                                                        <div class="thumbnails">
                                                                                            <div class="span4">

                                                                                                <div class="form-group" style="margin-bottom: 15px;">
                                                                                                    <label class="col-sm-3 control-label" for="textinput">แจ้งการโอนเงิน</label>
                                                                                                    <div class="col-sm-9" style="margin-bottom: 15px;">
                                                                                                        <textarea id="detailslip" rows="6"  name="detailslip" style="margin: 0px; width: 318px; height: 84px;"  placeholder="แจ้งหลักฐานการโอนเงิน ตัวอย่าง 25/05/2558 \nเวลาโอน\nธนาคาร\nและแจ้ง Order ID : xxxxx " ></textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group" >
                                                                                                    <span class="input-group" style="margin-left: 150px;">
                                                                                                        <button class="btn btn-success" id="savebtn" type="button" style="    margin-left: 260px;">บันทึก</button>
                                                                                                    </span>
                                                                                                </div><hr>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>   
                                                                                <div class="card">
                                                                                    <div class="card-content"> 
                                                                                        <div class="thumbnails">
                                                                                            <div class="span4">
                                                                                                <div class="thumbnail">
                                                                                                    <img src="/assets/images/default-img360.png" alt="ALT NAME">
                                                                                                    <div class="caption">
                                                                                                        <form action="/id=<?= $cusid ?>" method="post" enctype="multipart/form-data">
                                                                                                            <span id="uploadtext" ></span>
                                                                                                            <input value="<?= $cusid ?>" id="cusidvalue" type="hidden">
                                                                                                            <p align="center" ><button type="button" name="img" id="chooseimgbtn"  onClick="imagerest.click()" onMouseOut="uploadtext.value = imagerest.value" class="btn btn-primary btn-block" style="font-style:normal">เลือกรูป</button></p>
                                                                                                            <input type="file" id="imagerest" name="imagerest" style="display:none" accept="image/jpeg,image/pjpeg,image/png"  />
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- จบอัพโหลดหลักฐานการโอนเงิน -->
                                                        <!-- tracking -->
                                                        <div class="modal fade" id="track" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <span class="modal-title" id="myModalLabel">
                                                                            <span style="font-size: 30px; margin-top: 5px;">รายการหมายเลข: </span>
                                                                            <span style="font-size: 30px; margin-top: 5px; color: orange">102458 </span>     
                                                                        </span>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row" style="margin-top: 0px;">
                                                                            <div class="col-md-12">
                                                                                <div class="col-md-7">
                                                                                    <div class="card">
                                                                                        <div class="card-content">
                                                                                            <span style="font-size: 20px">สถานะของรายการ: </span>
                                                                                            <span style="font-size: 20px; color: orange;"> เสร็จสิ้น </span><br>
                                                                                            <span style="font-size: 20px">ตอบรับรายการโดย: </span>
                                                                                            <span style="font-size: 20px; color: orange;"> นายใหญ่โภชนา </span><br>
                                                                                            <span style="font-size: 20px">ตอบรับวันที่: </span>
                                                                                            <span style="font-size: 20px; color: orange;"> 12-11-2015 </span><br>
                                                                                            <span style="font-size: 20px">ตอบรับเวลา: </span>
                                                                                            <span style="font-size: 20px; color: orange;"> 12:30 </span><br>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="card">
                                                                                        <div class="card-content">
                                                                                            <span style="font-size: 20px">สถานที่ส่งสินค้า </span>
                                                                                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                                                            <span style="font-size: 17px">บริษัท นาดาว บางกอก จำกัด 92/14 ซอยสุขุมวิท 31 (สวัสดี) แขวงคลองตันเหนือ เขตวัฒนา กทม. 10110</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    <div class="card">
                                                                                        <div class="card-content">
                                                                                            <span style="font-size: 20px">จัดส่งสินค้าโดย: </span><br>
                                                                                            <span style="font-size: 20px; color: orange;"><!-- 108suchart สุชาติ ปานขำ --></span><br>
                                                                                            <span style="font-size: 20px">โทรศัพท์: </span><br>
                                                                                            <span style="font-size: 20px; color: orange;"><!--0812345678 --></span><br>
                                                                                            <span style="font-size: 20px">นัดส่งสินค้าวันที่: </span><br>
                                                                                            <span style="font-size: 20px; color: orange;"> 12-11-2015</span><br>
                                                                                            <span style="font-size: 20px">นัดส่งสินค้าเวลา: </span><br>
                                                                                            <span style="font-size: 20px; color: orange;"> 12:40 </span><br>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row" style="margin-top: 5px;">
                                                                            <div class="col-md-12">
                                                                                <div class="col-md-12">
                                                                                    <div class="card">
                                                                                        <div class="card-content">
                                                                                            <span style="font-size: 20px">รายการสินค้า </span>
                                                                                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <table class="table table-list-search">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th>รายการ</th>
                                                                                                                <th>ราคาต่อหน่วย/บาท</th>
                                                                                                                <th>จำนวน</th>
                                                                                                                <th>ราคารวม/บาท</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody class="table table-condensed table-hover">
                                                                                                            <tr>                    
                                                                                                                <td>ข้าวกล้อง</td>
                                                                                                                <td style="text-align: center">10.00</td>
                                                                                                                <td style="text-align: center">50</td>
                                                                                                                <td style="text-align: center">500.00</td>

                                                                                                            </tr>
                                                                                                            <tr>                     
                                                                                                                <td>ผัดกระเพราหมู</td>
                                                                                                                <td style="text-align: center">15.00</td>
                                                                                                                <td style="text-align: center">50</td>
                                                                                                                <td style="text-align: center">750.00</td>
                                                                                                            </tr>
                                                                                                            <tr>                    
                                                                                                                <td>ไข่ดาว</td>
                                                                                                                <td style="text-align: center">5.00</td>
                                                                                                                <td style="text-align: center">50</td>
                                                                                                                <td style="text-align: center">250.00</td>
                                                                                                            </tr>
                                                                                                            <tr>                    
                                                                                                                <td>ค่าจัดส่ง</td>
                                                                                                                <td style="text-align: center">100.00</td>
                                                                                                                <td style="text-align: center">1</td>
                                                                                                                <td style="text-align: center">100.00</td>
                                                                                                            </tr>
                                                                                                            <tr class="success">                    
                                                                                                                <td>ราคารวม</td>
                                                                                                                <td style="text-align: center"></td>
                                                                                                                <td style="text-align: center"></td>
                                                                                                                <td style="text-align: center">1,600.00</td>
                                                                                                            </tr>
                                                                                                            <tr class="warning">                  
                                                                                                                <td>ส่วนลด10% 1D23A5</td>
                                                                                                                <td style="text-align: center"></td>
                                                                                                                <td style="text-align: center">1</td>
                                                                                                                <td style="text-align: center">-160.00</td>
                                                                                                            </tr>
                                                                                                            <tr class="danger">                  
                                                                                                                <td>ราคารวมหลังหักส่วนลด</td>
                                                                                                                <td style="text-align: center"></td>
                                                                                                                <td style="text-align: center"></td>
                                                                                                                <td style="text-align: center">1,440.00</td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>   
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" style="margin-top: 5px;">
                                                                            <div class="col-md-12">
                                                                                <div class="col-md-6">
                                                                                    <div class="card">
                                                                                        <div class="card-content">
                                                                                            <span style="font-size: 20px">เพิ่มเติม </span>
                                                                                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                                                            <span style="font-size: 15px; color: red;"> กระเพราไม่ใส่ถั่วฝักยาว </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="card">
                                                                                        <div class="card-content">
                                                                                            <span style="font-size: 20px">การชำระเงิน </span>
                                                                                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                                                            <span style="font-size: 15px"> โอนเงินมัดจำผ่านธนาคาร: <br><span style="font-size: 15px; color: orange;"> กสิกรไทย เลขที่ 12-1231212-1 <br> 400.00 บาท</span> </span> &nbsp; 

                                                                                            <a href="#" class="btn btn-warning btn-xs "data-toggle="modal" data-target='.pop-up-2' href=".pop-up-2" style="margin-left: 90px;">แสดงสลิป</a><br>

                                                                                            <span style="font-size: 15px"> ชำระเงินด้วยเงินสด: <br><span style="font-size: 15px; color: red;"> 1040.00 บาท</span> </span> &nbsp; 
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- shipping address -->
                            <div class="tab-pane fade" id="shipadd" style="margin:0 0 20px 0;">
                                <div class="content2" >

                                    <?php
                                    $result = $con->query("SELECT `id`, `type`, `address_naming`, `full_address` FROM `shippingAddress` WHERE customer_id = '$cusid'");
                                    $i = 2;
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-success" style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">
                                                            รายการทั้งหมด 
                                                        </div>
                                                        <!-- ตารางรายการติดตาม -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>ที่อยู่</th>
                                                                            <th>แก้ไข</th>
                                                                            <th>ลบ</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table table-condensed table-hover">
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td><?= $data2['address'] ?></td>                       
                                                                            <td><button class="btn btn-success btn-xs" disabled="disabled"><span class="glyphicon glyphicon-check"></span> แก้ไข</button></td>
                                                                            <td><button class="btn btn-danger btn-xs" disabled="disabled"><span class="glyphicon glyphicon-trash"></span> ลบ</button></td>
                                                                        </tr>
                                                                        <?php while ($data4 = $result->fetch_assoc()) { ?>
                                                                            <tr>
                                                                                <td><?= $i++; ?></td>
                                                                                <td><?= $data4['full_address'] ?></td>
                                                                                <td>
                                                                                    <button class="btn btn-primary btn-xs editadd" id="editadd<?= $data4["id"] ?>"  >
                                                                                        <span class="glyphicon glyphicon-check"></span> แก้ไข
                                                                                    </button>              
                                                                                </td>
                                                                                <td>
                                                                                    <button class="btn btn-danger btn-xs deleteadd" id="deleteadd<?= $data4["id"] ?>" data-title="Delete"  >
                                                                                        <span class="glyphicon glyphicon-trash"></span> ลบ
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- จบตารางรายการติดตาม -->

                                    <!--<div class="row">
                                        <div id="inbox" style="margin:15% 0 0 0;">
                                            <div class="fab btn-group show-on-hover dropup" id="add_sa" data-toggle="modal" data-target="#add_address">
                                                <button type="button" class="btn btn-danger  btn-io">
                                                    <span class="fa-stack fa-2x">
                                                        <i class="fa fa-circle fa-stack-2x fab-backdrop"></i>
                                                        <i class="fa fa-plus fa-stack-1x fa-inverse fab-primary"></i>
                                                        <i class="fa fa-plus fa-stack-1x fa-inverse fab-secondary"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>-->

                                    <!-- Add Shipping address Modal -->
                                    <div class="modal fade" id="add_address" tabindex="-1" role="dialog" aria-labelledby="shipping_address">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="/customer/add-shipping-address.php?id=<?= $cusid ?>" id="addressform" name="addressform" method="post">
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
                                        <form action="/customer/edit-shipping-address.php?id=<?= $cusid ?>" method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                                                <h3 class="modal-title" id="shipping_address">เปลี่ยนแปลงข้อมูลที่จัดส่งสินค้า<span id="showadd_id"></span></h3>
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
                            <!-- end add shipping address -->

                            <div class="modal fade" id="delete-addmodal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                            <h3 class="modal-title custom_align" id="Heading">ลบข้อมูลที่จัดส่ง<span id="showadddel_id" ></span></h3>
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
                            <!-- end delete shipping add -->
                        </div>
                    </div>
                </div>
            </div>
        </section> 


        <?php include '../template/footer.php'; ?>
        <!-- ตารางรายการออเดอร์ -->
        <script src="/assets/js/cus_pro_search.js"></script>
        <script src="/assets/js/ui-bootstrap-tpls-0.13.4.min.js"></script>
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
                var textAreas = document.getElementsByTagName('textarea');

                Array.prototype.forEach.call(textAreas, function (elem) {
                    elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
                });


                $("#addshipbtn").click(function (evt) {
                    alert(cusid + "---23456");
                    //$("#add_address").modal('show');
                });

                $("#saveaddbtn").on("click", function (e) {
                    $.ajax({
                        url: "/customer/ajaxsave-address.php",
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
                        url: "/customer/shipaddresslist.php",
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
                        url: "/customer/shipping-formmodal.php",
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
                        url: "/customer/delete-shipping-address.php",
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
