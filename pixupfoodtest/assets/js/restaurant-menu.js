$(document).ready(function () {
    $("#addbtn").on("click", function (e) {
        $("#addMenuForm").show();
        $("#addNewMenuForm").show();
        $("#addbtn").hide();
        $("#closebtn").show();
    });
    $("#closebtn").on("click", function (e) {
        $("#addMenuForm").hide();
        $("#addNewMenuForm").hide();
        $("#addbtn").show();
        $("#closebtn").hide();
        document.location.reload();
    });

    $('#select_type').on('change', function (e) {
        $("#type").show();
        if ($("#select_type").val() == 'ชนิดข้าว') {
            $("#riceList").show();
            $("#menuList").hide();
            $("#singleMenu").hide();
            $("#snackList").hide();
            $("#drinkList").hide();
            $("#riceList").attr("required");
        } else if ($("#select_type").val() == 'กับข้าว') {
            $("#riceList").hide();
            $("#menuList").show();
            $("#singleMenu").hide();
            $("#snackList").hide();
            $("#drinkList").hide();
            $("#menuList").attr("required");
        } else if ($("#select_type").val() == 'อาหารจานเดียว') {
            $("#riceList").hide();
            $("#menuList").hide();
            $("#singleMenu").show();
            $("#snackList").hide();
            $("#drinkList").hide();
            $("#singleMenu").attr("required");
        } else if ($("#select_type").val() == 'ขนม') {
            $("#riceList").hide();
            $("#menuList").hide();
            $("#singleMenu").hide();
            $("#snackList").show();
            $("#drinkList").hide();
            $("#snackList").attr("required");
        } else if ($("#select_type").val() == 'เครื่องดื่ม') {
            $("#riceList").hide();
            $("#menuList").hide();
            $("#singleMenu").hide();
            $("#snackList").hide();
            $("#drinkList").show();
            $("#drinkList").attr("required");
        } else {
            $("#riceList").hide();
            $("#menuList").hide();
            $("#singleMenu").hide();
            $("#snackList").hide();
            $("#drinkList").hide();
            $("#type").hide();
        }

    });

    $("#typefood-add").on("change", function (e) {
        if ($("#typefood-add").val() == "ชนิดข้าว" || $("#typefood-add").val() == "ขนม" || $("#typefood-add").val() == "เครื่องดื่ม") {
            $("#typeselect").hide();
            $(".foodtypelist").hide();
        } else {
            $("#typeselect").show();
            $(".foodtypelist").show();
        }
    });

    $("#savebtn").on("click", function (e) {
        var menuid = $("#menuList").val();
        var riceid = $("#riceList").val();
        var singleid = $("#singleMenu").val();
        var snackid = $("#snackList").val();
        var drinkid = $("#drinkList").val();
        var price = $("#priceinput").val();
        var resid = $("#residValue").val();
        $("#showerror").html("");
        $("#savabtn").attr("disabled");
        $("#savabtn").html("<img src='/assets/images/loader.gif' style='height:15px; margin:0 auto;'>");
        $.ajax({
            url: "/restaurant/menu-add.php",
            type: "POST",
            data: {"menuid": menuid, "riceid": riceid, "singleid": singleid,
                "menusetid": menuid, "price": price, "resid": resid,
                "snackid": snackid, "drinkid": drinkid},
            dataType: "json",
            success: function (data) {
                $("#savebtn").removeAttr("disabled");
                if (data.result == 1) { //สำเร็จ
                    $("#duplicateMenu").html("");
                    $("#addMenuRes").trigger("reset");
                     $("#duplicateMenu").html(' <div class="alert alert-success" role="alert" style="margin-top:25px;margin-right: 165px;">' +
                            '<p ><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                            '&nbsp;บันทึกเมนูเรียบร้อยเเล้ว</p></div>').fadeIn(500);
                    
                } else if (data.result == 2) {
                    $("#duplicateMenu").html(' <div class="alert alert-danger" role="alert" style="margin-top:25px;margin-right: 165px;">' +
                            '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                            '&nbsp;ร้านของท่านมีเมนูอาหารนี้เเล้ว กรุณาเลือกรายการใหม่อีกครั้ง</p></div>');
                    $("#addMenuRes").trigger("reset");
                }else if (data.result == 3) {
                     $("#duplicateMenu").html("");
                    $("#addMenuRes").trigger("reset");
                    $("#duplicateMenu").html(' <div class="alert alert-danger" role="alert" style="margin-top:25px;margin-right: 165px;">' +
                            '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                            '&nbsp;'+data.reason+'</p></div>');
                    $("#addMenuRes").trigger("reset");
                }else{
                    $("#duplicateMenu").html(' <div class="alert alert-danger" role="alert" style="margin-top:25px;margin-right: 165px;">' +
                            '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                            '&nbsp;'+data.reason+'</p></div>');
                    $("#addMenuRes").trigger("reset");
                }
            }
        });
        e.preventDefault();

        return false;
    });

    $("#searchtext").on("keyup", function (e) {
        if (e.keyCode == 13) {
            $("#searchbyname").click();
        }
    });

    $("#searchbyname").on("click", function (e) {
        var searchmenuname = $("#searchtext").val();
        var resid = $("#restaurantid").val();

        $.ajax({
            url: "/restaurant/menu-searchbyname.php",
            type: "POST",
            dataType: "html",
            data: {"resid": resid, "searchname": searchmenuname},
            success: function (data, textStatus, jqXHR) {
                $("#showmenudata").html(data);
                $('#close-searchbtn').show();
            }
        });
    });

    $('#close-searchbtn').on('click', function (e) {
        $('#searchtext').val("");
        $("#showmenudata").html("");
        $('#close-searchbtn').hide();
    });

    /*$('input[type=file]').on('change', function (e) {
     var filename = $('.imagerest').val();
     var fname = filename.substring(12);
     var name = "File: " + fname;
     $("#uploadtext").html(name);
     });*/

    $("input[type=checkbox]").click(function (e) {
        if ($(this).is(":checked")) {
            $(this).value("1");
        } else {
            $(this).value("0");
        }
    });



});