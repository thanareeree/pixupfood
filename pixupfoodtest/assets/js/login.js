$(document).ready(function (e) {
    $("#loginform").on("submit", function (e) {
        var email = $("#loginemail").val();
        var password = $("#password").val();
        $("#showerror").html("");
        $("#submitbtn").attr("disabled");
        $("#submitbtn").html("<img src='/assets/images/loader.gif' style='height:15px; margin:0 auto;'>");
        $.ajax({
            url: "/api/loginsession.php",
            type: "POST",
            data: {"loginemail": email, "password": password},
            dataType: "json",
            success: function (data) {
                $("#submitbtn").removeAttr("disabled");
                if (data.result == 0) {
                    $("#showerror").html(data.reason);
                    $("#submitbtn").html("Sign In");
                } else if (data.result == 1) {
                    document.location = data.redirectTo;
                } else if (data.result == 2) {
                    $("#logindiv").html('<li><a href="../api/logout.php" class="nav-link">'+data.name+'</a></li>'+
                    '<li class="dropdown open">'+
                        '<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                            '<img src="../assets/images/bar/user.png" style="width:40px;height:40px;"/>'+
                        '</a>'+
                        '<ul class="dropdown-menu" style="padding: 0px">'+
                            '<li>'+
                                '<div class="middlePage1">'+
                                    '<div class="panel panel-info">'+
                                        '<div class="panel-body">'+
                                            '<div class="row">'+
                                                '<div class="col-md-5" style="border-right:1px solid #ccc;height:auto;">'+
                                                    '<div class="row">'+
                                                        '<div class="col-md-12">'+
                                                            '<a href="cus_customer_profile.php">'+
                                                                '<img src="'+data.img+'" style="max-width: 110px; max-height: 110px">'+
                                                            '</a>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-7">'+
                                                   '<form class="form-horizontal">'+
                                                        '<fieldset>'+
                                                           '<br><br> <br><br>'+
                                                            '<a href="/api/logout.php">'+
                                                                '<button id="logoutbutton" type="button" class="btn btn-danger btn-sm pull-right" style="margin-left: 15px;">Logout</button>'+
                                                            '</a>'+
                                                            '<a href="/view/cus_customer_profile.php">'+
                                                                '<button id="profilebutton" class="btn btn-info btn-sm pull-right" type="button">Profile</button>'+
                                                            '</a>'+
                                                        '</fieldset></form></div></div></div></div></div></li></ul></li>');
                document.location.reload();
                }
            }
        });
        e.preventDefault();
        return false;
    });
});