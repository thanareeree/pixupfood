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
                            <!-- order history -->
                            <div class="tab-pane fade active in" id="history">
                                <div class="content2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel " style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
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

                        </div>
                    </div>
                </div>
            </div>
        </section> 


        <?php include '../template/footer.php'; ?>
        <script src="/assets/js/cus_pro_search.js"></script>
        <script src="/assets/js/customer-profile-history.js"></script>
         <script src="/assets/js/customer-profile-change.js"></script>

    </body>
</html>
