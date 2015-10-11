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
            <!-- modal -->
            <?php include '../customer-profile/modal-edit-change.php'; ?>
            
            
            <div class="container">
                <div class="row" style="margin-top:50px">
                   <?php include '../customer-profile/list-icon.php' ;?>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content" style="margin-top:-50px;">
                            <!-- shipping address -->
                            <div class="tab-pane fade active in" id="shipadd" style="margin:0 0 20px 0;">
                                <div class="content2" >

                                    <?php
                                    $result = $con->query("SELECT `id`, `type`, `address_naming`, `full_address` FROM `shippingAddress` WHERE customer_id = '$cusid'");
                                    $i = 2;
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel" style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
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
       
       
        <script src="/assets/js/customer-profile-shippingaddress.js"></script>
        <script src="/assets/js/customer-profile-change.js"></script>

    </body>
</html>
