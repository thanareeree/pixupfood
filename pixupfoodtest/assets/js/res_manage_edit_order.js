$(document).ready(function () {
    $(".btn-pref .btn").click(function () {
        $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
        $(".tab").addClass("active"); // instead of this do the below 
        $(this).removeClass("btn-default").addClass("btn-warning");
    });

    $('#imagerest').on('change', function (e) {
        var filename = $('#imagerest').val();
        var fname = filename.substring(12);
        var name = "File: " + fname;
        $("#uploadtext").html(name);
        $("#chooseimgbtn").hide();
        $("#uploadimgbtn").show();
    });

    $("#switchClose").click(function (e) {
        $.ajax({
            type: "POST",
            url: "/restaurant/edit-close-restaurant.php",
            data: {"resId": $("#resIdvalue").val(),
                "close": $("#switchClose").val()},
            dataType: "json",
            success: function (data) {
                $("#switchClose").removeAttr("checked");
                if (data.result == "1") {
                    $("#switchClose").attr("checked");
                    document.location.reload();
                } else if (data.result == "0") {
                    $("#switchClose").removeAttr("checked");
                    $
                    //document.location.reload();
                } else {
                    alert("ไม่สามารถบันทึกข้อมูลได้\nError : " + data.error);
                }
            }
        });
    });

    $("#editfoodboxbtn").on("click", function (e) {
        $("#foodboxtypeEdit").show();

    });


});