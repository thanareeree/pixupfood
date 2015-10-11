$(document).ready(function () {
    


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


});


