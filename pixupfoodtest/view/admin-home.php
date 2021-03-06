<?php
session_start();
include '../template/navbar-admin.php';
include '../dbconn.php';
?>


<html>
    <head>
        <meta charset="UTF-8">

        <?php addlink("::Admin Management::"); ?>
    </head>
    <body>
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
                    <ul class="nav navbar-nav navbar-right" id="navright-before" >
                        <form class="navbar-form navbar-right" method="post"style="margin: 20px -5px;">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" id="usernameinput" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="pwdinput" placeholder="Password">
                            </div>
                            <button type="button" class="btn btn-primary" id="loginbtn">Login</button>
                        </form>
                    </ul>               
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <script src="/assets/js/jquery-2.1.4.min.js"></script>
        <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function (e) {
                // $("#navright-before").show();
                $("#loginbtn").on("click", function (e) {
                    $.ajax({
                        url: "/admin/login.php",
                        type: "POST",
                        data: {"username": $("#usernameinput").val(),
                            "password": $("#pwdinput").val()},
                        dataType: "html",
                        success: function (returndata) {

                            if (returndata == "ok") {
                               document.location = "/view/admin-index.php";
                            } else {
                                alert("error");
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>


