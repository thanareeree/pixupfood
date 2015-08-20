<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        <link rel="stylesheet" href="../assets/thaisansneue/fontface.css">
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
        <?php
        include './navbar.php';
        show_navbar();
        ?>
        <!-- start contact -->
        <section id="loreg">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.6s">
                            <h2 class="text-uppercase">สมัครสมาชิก</h2><br><br>
                            <div class="col-md-4" style="margin-top:13px;">
                                <a href="#" data-toggle="modal" data-target="#ModalCus">
                                    <img src="../assets/images/bar/userl.png" style="width:104px; height:104px;"><br><br>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#ModalCus">
                                    <p style="margin-left:15px;font-weight:bold"> CUSTOMERS </p>
                                </a>
                            </div>
                            <div class="col-md-1" style="margin-top:13px;"></div>
                            <div class="col-md-4" style="margin-top:13px;">
                                <a href="#" data-toggle="modal" data-target="#ModalRes">
                                    <img src=../assets/images/bar/restaurant.png style="width:104px; height:104px;"><br><br>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#ModalRes">
                                    <p style="margin-left:15px;font-weight:bold"> RESTAURANTS </p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeInRight" data-wow-delay="0.6s">
                            <h2 class="text-uppercase">Login</h2>
                            <div class="contact-form">
                                <form action="#" method="post">
                                    <div class="col-md-4" style="margin-top:13px;font-weight:bold;font-size:18px;">
                                        USERNAME &nbsp; &nbsp;:
                                    </div>
                                    <div class="col-md-8">
                                        <input required type="text" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="col-md-4" style="margin-top:13px;font-weight:bold;font-size:18px;">
                                        PASSWORD &nbsp; &nbsp;:
                                    </div>
                                    <div class="col-md-8">
                                        <input required type="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <input type="submit" class="form-control text-uppercase" value="Login">
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
                        <form action="../register/customer-save.php" id="cusregisterform" name="cusregisterform" method="post" onclick="return checkCheckBox(f)">
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
                                        <input required type="text" name="cusfname" id="cusfname" class="form-control input-lg" placeholder="First Name" tabindex="1" value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input required type="text" name="cuslname" id="cuslname" class="form-control input-lg" placeholder="Last Name" tabindex="2" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="cusphone" type="text" required class="form-control input-lg" id="cusphone" placeholder="Phone Number" value="" tabindex="3" onKeyPress="return chkNumber(this)" maxlength="10">
                            </div>
                            <div class="form-group">
                                <input required type="email" name="cusemail" id="cusemail" class="form-control input-lg" placeholder="Email Address" tabindex="4" value="">
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input required type="password" name="cuspwd" id="cuspwd" class="form-control input-lg" placeholder="Password" tabindex="5" value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input required type="password" name="cuspwdconfirm" id="cuspwdconfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="6" value="">
                                        <input type="hidden" value="0" id="available" name="available">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-sm-3 col-md-3 form-group">
                                    <span class="button-checkbox">
                                        <button type="button" class="btn" data-color="info" tabindex="7">
                                            <span class="state-icon glyphicon glyphicon-unchecked"></span>I Agree</button>
                                        <input type="checkbox" name="tcr" id="tcr" class="hidden" value="1">
                                    </span>
                                </div>
                                <div class="col-xs-8 col-sm-9 col-md-9">
                                    โปรดอ่าน<a href="#" data-toggle="modal" data-target="#t_and_c_m" style="color:rgba(0,0,0,1)">ข้อกำหนด</a>ก่อนทำการลงทะเบียน
                                </div>
                            </div>
                            <div class="modal-footer form-group">
                                <span id="msgotp" style="display: none">ระบบได้ส่งรหัส OTP ไปแล้ว กรุณานำมากรอกรหัสภายใน 7 วัน </span>
                                <input type="submit" class="btn btn-success btn-lg" value="ส่งข้อมูล">               
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
                        <p>หลังจากที่คุณลุฏค้าลงทะเบียนเพื่อเข้าใจเว็บ pixupfood.com ท่านจะได้รหัส OTP ทาง SMS กรุณานำรหัสดังกล่าวมาบันทึกที่เว็บไซต์เมื่อเข้าสู้ระบบครั้งแรก</p>
                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <!--  Modal customer   OTP -->
        <div class="modal fade" data-backdrop="static" ata-keyboard="false"  id="otpmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">กรุณากรอกรหัส OTP 4 หลัก</h4>
                    </div>
                    <div class="modal-body">
                        <p>You are going to delete<br><br>
                        <div class="input-group">
                            <input type="text" id="otpinput" class="form-control" placeholder="OTP password" >   
                        </div>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="cancelbtn" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                        <button type="button" id="loginbtn" class="btn btn-success">เข้าสู่ระบบ</button>
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
                                    By clicking <strong class="label label-primary">Confirm</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m_r" style="color:rgba(0,0,0,1)">Terms and Conditions</a> set out by this site, including our Cookie Use.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="nextRes" >Confirm</button>
                                <input type="hidden" value="0" id="available" name="available">
                            </div>
                        </form>
                    </div>


                </div>
            </div>

        </div>


        <!-- END Modal restaurant -->

        <?php show_footer(); ?>
        <!-- script references -->
        <script src="../assets/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.js"></script>
        <script>
                                    $("#menu-toggle").click(function (e) {
                                        e.preventDefault();
                                        $("#wrapper").toggleClass("toggled");
                                    });
        </script>
        <script src="../assets/js/jquery.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/jquery.singlePageNav.min.js"></script>
        <script src="../assets/js/custom.js"></script>
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
                                        $("#msgotp").show().fadeIn(10000);
                                        alert($("#cusregisterform").serializeArray()); 
                                      /*  $.ajax({
                                            type: "POST",
                                            url: "../register/customer-save.php",
                                            data: $("#cusregisterform").serializeArray(),
                                            cache: false,
                                            dataType: "json",
                                            success: function (data) {
                                                if (data.result == "1") {
                                                    document.location = "../view/search.php";
                                                } else {
                                                    alert("ไม่สามารถบันทึกข้อมูลได้\nError : " + data.error + "\n\nถ้าเป็นข้อผิดพลาดของโปรแกรมโปรดบันทึกหน้าจอนี้และติดต่อทีมงาน");
                                                    
                                                }
                                            }
                                        }); */



                                    });

                                    $("#loginbtn").on("click", function (e) {
                                        $.post("login_after_otp.php",
                                                {
                                                    email: $("#cusemail").val(),
                                                    password: $("#cuspwd").val()
                                                },
                                        function (data, status) {
                                            alert("Data: " + data + "\nStatus: " + status);
                                        });
                                    });
        </script>
    </body>
</html>
