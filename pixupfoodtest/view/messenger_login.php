<?php
include './navbar.php';
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
        <meta charset="UTF-8">
        <title>PixupFood - Login and Register Page</title>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">


        <link rel="stylesheet" href="../assets/css/animate.min.css">
        <link rel="stylesheet" href="../assets/Supermarket/stylesheet.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/search.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/simple-sidebar.css" />

    </head>
    <body>
        <!-- start preloader -->
        <div class="preloader">
            <div class="loader"></div>
        </div>
        <!-- end preloader -->
        <!-- start navigation -->
        <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a href="../index.php" style="color:rgba(255,127,0,1);padding-right: 0px;" class="navbar-brand">Pixup</a>
                    <a href="../index.php" class="navbar-brand" style="color:black;padding-left: 0px;">Food</a>
                    <ul class="nav navbar-nav navbar-right text-uppercase pull-right">
                        <li><a <?= (!isset($_SESSION["islogin"])) ? 'href="#"' : 'href="../api/logout.php" class="nav-link"' ?> ><?= (!isset($_SESSION["islogin"])) ? ' สวัสดี ' : $_SESSION["userdata"]["firstName"] . " " . $_SESSION["userdata"]["lastName"] ?>
                                <img src="../assets/images/bar/user.png" style="width:30px;height:30px;margin-right: 20px"/> 
                            </a>
                        </li>                                                 
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end navigation -->

        <!-- start contact -->
        <section id="loreg">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 wow fadeInRight" data-wow-delay="0.6s">
                            <h2 class="text-uppercase">เข้าสู่ระบบ</h2>
                            <div class="contact-formmessenger">
                                <form action="../api/loginsession.php" method="post">
                                    <div class="col-md-4" style="margin-top:13px;font-weight:bold;font-size:18px;">
                                        USERNAME &nbsp; &nbsp;:
                                    </div>
                                    <div class="col-md-8">
                                        <input required type="text" class="form-control" name="loginemail" placeholder="อีเมล">
                                    </div>
                                    <div class="col-md-4" style="margin-top:13px;font-weight:bold;font-size:18px;">
                                        PASSWORD &nbsp; &nbsp;:
                                    </div>
                                    <div class="col-md-8">
                                        <input required type="password" class="form-control" name="password" placeholder="รหัสผ่าน" >
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <input type="submit" class="form-control text-uppercase" value="เข้าสู่ระบบ">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end contact -->

        <!-- Modal customer -->
        <div class="modal fade" id="ModalCus" tabindex="-1" role="dialog" aria-labelledby="ModalCusLabel" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="ModalCusLabel">Customer Register</h4>
                    </div>
                    <div class="modal-body">
                        <form action="../register/customer-save.php" id="cusregisterform" name="cusregisterform" method="post" >
                            <script language="JavaScript">
                                function chkNumber(ele) {
                                    var vchar = String.fromCharCode(event.keyCode);
                                    if ((vchar < '0' || vchar > '9') && (vchar != '.'))
                                        return false;
                                    ele.onKeyPress = vchar;
                                }
                            </script>
                            <script>
                                function checkCheckBox(f) {
                                    if (f.tc.checked == false) {
                                        alert('Please check the box to continue.');
                                        return false;
                                    } else
                                        return true;

                                }
                            </script>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input required type="text" name="cusfname" id="cusfname" class="form-control input-lg" placeholder="First Name" tabindex="1">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input required type="text" name="cuslname" id="cuslname" class="form-control input-lg" placeholder="Last Name" tabindex="2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="cusphone" type="text" required class="form-control input-lg" id="cusphone" placeholder="Phone Number" tabindex="3" onKeyPress="return chkNumber(this)" maxlength="10">
                            </div>
                            <div class="form-group">
                                <input required type="email" name="cusemail" id="cusemail" class="form-control input-lg" placeholder="Email Address" tabindex="4">
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input required type="password" name="cuspwd" id="cuspwd" class="form-control input-lg" placeholder="Password" tabindex="5">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input required type="password" name="cuspwdconfirm" id="cuspwdconfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-sm-3 col-md-3 form-group">
                                    <span class="button-checkbox">

                                        <input type="checkbox" name="tcr" id="tcr" class="hidden" value="1">
                                    </span>
                                </div>
                                <div class="col-xs-8 col-sm-9 col-md-9">
                                    โปรดอ่าน&nbsp; <a href="#" data-toggle="modal" data-target="#t_and_c_m" style="color:rgba(0,0,0,1)">ข้อกำหนด</a> &nbsp;ก่อนลงทะเบียน
                                </div>
                            </div>
                            <div class="modal-footer form-group">
                                <input type="submit" class="btn btn-danger" name="cancelbtn" id="cancelbtn" value="ยกเลิก" >  
                                <input type="submit" class="btn btn-success" name="submitbtn" id="submitbtn" value="ส่งข้อมูล" >                 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal customer -->

        <!-- Modal -->
        <div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="ModalCusLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="ModalCusLabel">ข้อกำหนด</h4>
                    </div>
                    <div class="modal-body">
                        <p>ระบบได้ส่งรหัส OTP ทาง SMS ดพื่อให้ท่านนำมาบันทึกเพื่อยืนยันตัวตนในการเข้าสู่ระบบครั้งแรก โปรดนำรหัสดังกล่าวมาบันทึกภายใน 30 วันหลังจากวันลงทะเบียน มิเช่นนั้นการลงทะเบียนครั้งนี้ถือว่าไม่สำเร็จ</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">ฉันยอมรับ</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Modal restaurant -->
        <div class="modal fade" id="ModalRes" tabindex="-1" role="dialog" aria-labelledby="ModalResLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="ModalResLabel">Restaurant Register</h4>
                    </div>
                    <div class="modal-body">
                        <form action="../restaurant/res_save.php" id="resregisterform" method="post"  onsubmit="return checkCheckBox(this)"   >
                            <script>
                                function checkCheckBox(f) {
                                    if (f.tcr.checked == false) {
                                        alert('Please check the box to continue.');
                                        return false;
                                    } else
                                        return true;
                                }
                            </script>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input required type="text" id="resname"  name="resname" class="form-control input-lg" placeholder="First Name" tabindex="1">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input required type="text" id="reslname" name="reslname" class="form-control input-lg" placeholder="Last Name" tabindex="2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input required type="text" id="resphone"  name="resphone" onKeyPress="return chkNumber(this)" maxlength="10" class="form-control input-lg" placeholder="Phone Number" tabindex="3">
                            </div>
                            <div class="form-group">
                                <input required type="email" id="resemail"  name="resemail" class="form-control input-lg" placeholder="Email Address" tabindex="4">
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input required type="password" id="respwd" name="respwd" class="form-control input-lg" placeholder="Password" tabindex="5">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input required type="password" id="respwdconfirm" name="respwdconfirm"  class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-sm-3 col-md-3">
                                    <span class="button-checkbox">
                                        <button type="button" class="btn" data-color="info" tabindex="7" >
                                            <span class="state-icon glyphicon glyphicon-unchecked"></span>I Agree</button>
                                        <input type="checkbox" name="tcr" id="tcr" class="hidden" value="1">
                                    </span>
                                </div>
                                <div class="col-xs-8 col-sm-9 col-md-9">
                                    โปรดอ่าน&nbsp; <a href="#" data-toggle="modal" data-target="#t_and_c_n" style="color:rgba(0,0,0,1)">ข้อกำหนด</a> &nbsp;ก่อนลงทะเบียน
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger">ยกเลิก</button>
                                <button type="submit" class="btn btn-success" name="nextRes" >ส่งข้อมูล</button>
                                <input type="hidden" value="0" id="available" name="available">
                            </div>
                        </form>
                    </div>


                </div>
            </div>

        </div>
        <div class="modal fade" id="t_and_c_n" tabindex="-1" role="dialog" aria-labelledby="ModalCusLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="ModalCusLabel">ข้อกำหนด</h4>
                    </div>
                    <div class="modal-body">
                        <p>ระบบได้ส่งรหัส OTP ทาง SMS ดพื่อให้ท่านนำมาบันทึกเพื่อยืนยันตัวตนในการเข้าสู่ระบบครั้งแรก โปรดนำรหัสดังกล่าวมาบันทึกภายใน 30 วันหลังจากวันลงทะเบียน มิเช่นนั้นการลงทะเบียนครั้งนี้ถือว่าไม่สำเร็จ</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">ฉันยอมรับ</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- END Modal restaurant -->



        <?php show_footer(); ?>

        <script>
            $(function () {
                $('.button-checkbox').each(function () {

                    // Settings
                    var $widget = $(this),
                            $button = $widget.find('button'),
                            $checkbox = $widget.find('input:checkbox'),
                            color = $button.data('color'),
                            settings = {
                                on: {
                                    icon: 'glyphicon glyphicon-check'
                                },
                                off: {
                                    icon: 'glyphicon glyphicon-unchecked'
                                }
                            };

                    // Event Handlers
                    $button.on('click', function () {
                        $checkbox.prop('checked', !$checkbox.is(':checked'));
                        $checkbox.triggerHandler('change');
                        updateDisplay();
                    });
                    $checkbox.on('change', function () {
                        updateDisplay();
                    });

                    // Actions
                    function updateDisplay() {
                        var isChecked = $checkbox.is(':checked');

                        // Set the button's state
                        $button.data('state', (isChecked) ? "on" : "off");

                        // Set the button's icon
                        $button.find('.state-icon')
                                .removeClass()
                                .addClass('state-icon ' + settings[$button.data('state')].icon);

                        // Update the button's color
                        if (isChecked) {
                            $button
                                    .removeClass('btn-default')
                                    .addClass('btn-' + color + ' active');
                        }
                        else {
                            $button
                                    .removeClass('btn-' + color + ' active')
                                    .addClass('btn-default');
                        }
                    }

                    // Initialization
                    function init() {
                        updateDisplay();
                        // Inject the icon if applicable
                        if ($button.find('.state-icon').length == 0) {
                            $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i>');
                        }
                    }
                    init();
                });
            });

            $("#cusregisterform").on("submit", function (e) {

            });


        </script>
    </body>
</html>
