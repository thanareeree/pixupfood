$(document).ready(function () {
    var textAreas = document.getElementsByTagName('textarea');

    Array.prototype.forEach.call(textAreas, function (elem) {
        elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
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
    
    $("#canceleditpro").click(function (e){
       $("#editprofilemodal").modal("hide");
       $("#cuseditform").trigger("reset");
    });
    
    
    $("#oldpwd").on("keyup", function (e) {
        $.ajax({
            type: "POST",
            url: "/customer/check-password-customer.php",
            data: {"oldpwd": $("#oldpwd").val()},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    $(".errorPasswordNotFound").show();
                     // $("#pwdshow").html(data.pwd);
                    $(".errorConfirmpwd").hide();
                     $("#newpwd").attr("disabled", "disabled");
                     $("#confirmnewpwd").attr("disabled", "disabled");
                    $("#confirmbtn").attr("disabled", "disabled");
                } else if (data.result == "0") {
                       $(".errorPasswordNotFound").hide();
                       $("#confirmnewpwd").removeAttr("disabled");
                       $("#newpwd").removeAttr("disabled");
                       $("#confirmbtn").removeAttr("disabled");
                }
            }
        });
    });
    
    $("#confirmnewpwd").on("keyup", function (e) {
        checkPasswordMatching();
    });
    $("#cancelpwd").click(function (e){
       $("#chpassform").modal("hide");
       $("#pwdform").trigger("reset");
       $(".errorConfirmpwd").hide();
    });
    
     $("#confirmbtn").click(function (e){
         $.ajax({
            type: "POST",
            url: "/customer/change-password.php",
            data: {"newpwd": $("#newpwd").val()},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    alert(data.error);
                } else if (data.result == "0") {
                     //  $("#chpassform").hide();
                     document.location.reload();
                }
            }
        });
    });
    

});


function checkPasswordMatching() {
    var pwd = $("#newpwd").val();
    var confirmpwd = $("#confirmnewpwd").val();
    if (pwd != confirmpwd) {
        $(".errorConfirmpwd").show();
        $("#confirmbtn").attr("disabled", "disabled");
    } else {
        $(".errorConfirmpwd").hide();
        $("#confirmbtn").removeAttr("disabled");
    }
}