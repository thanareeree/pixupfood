var busyFast = false, busyNormal = false
var type = "all";
var mesid = "";
$(document).ready(function () {
    mesid = $("#messengerselect").val();

    $(".btn-pref .btn").click(function () {
        $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
        $(this).removeClass("btn-default").addClass("btn-warning");
    });
    /* $("#nowtable").dataTable(function (e){
     
     });*/


    //fetchdataShowNowOrder();
    fetchdataShowFastNowOrder();

    $('#showdataNowFastOrder').on("click", ".normalOrderView", function (e) {
        var id = $(this).attr("data-id");
        var no = $(this).attr("data-no");
        $("#showOrderId").html(no);

        $.ajax({
            url: "/restaurant-order/now/normal-modal.php",
            type: "POST",
            data: {"id": id, "type": "normal"},
            dataType: "html",
            success: function (returndata) {
                $("#normalOrderViewBody").html(returndata);
                $("#detailNormalOrderModal").modal("show");

            }
        });
    });

    $('#showdataNowFastOrder').on("click", ".fastOrderView", function (e) {
        var id = $(this).attr("data-id");
        var no = $(this).attr("data-no");
        $("#showFastOrderId").html(no);

        $.ajax({
            url: "/restaurant-order/now/fast-modal.php",
            type: "POST",
            data: {"id": id, "type": "normal"},
            dataType: "html",
            success: function (returndata) {
                $("#fastOrderViewBody").html(returndata);
                $("#detailFastOrderModal").modal("show");

            }
        });
    });

    $('#showdataNowFastOrder').on("change", ".nowstatusselect", function (e) {
        var id = $(this).attr("data-id");
        var statusid = $(this).val();
        $.ajax({
            url: "/restaurant-order/now/change-status-normal.php",
            type: "POST",
            data: {"id": id, "statusid": statusid},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    fetchdataShowFastNowOrder();

                } else if (data.result == "0") {
                    $("#messengerNormalModal").modal("show");
                    $("#messNormalId").html(data.orderid);
                    fetchdataShowFastNowOrder();
                } else {
                    $("#errorMessage").html(data.error);
                    $("#errorModal").modal("show");
                    fetchdataShowFastNowOrder();
                }
            }
        });
    });

    $('#showdataNowFastOrder').on("change", ".faststatusselect", function (e) {
        var id = $(this).attr("data-id");
        var statusid = $(this).val();
        $.ajax({
            url: "/restaurant-order/now/change-status-fast.php",
            type: "POST",
            data: {"id": id, "statusid": statusid},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    fetchdataShowFastNowOrder();

                } else if (data.result == "0") {
                    $("#messengerFastModal").modal("show");
                    fetchdataShowFastNowOrder();
                    $("#messFastId").html(data.orderid);

                } else {
                    $("#errorMessage").html(data.error);
                    $("#errorModal").modal("show");
                    fetchdataShowFastNowOrder();
                }
            }
        });
    });

    $("#savemessengerFast").on("click", function (e) {
        var id = $('#messFastId').html();
        var messselect = $("#messengerselect").val();
        $.ajax({
            url: "/restaurant-order/now/save-messenger-fast.php",
            type: "POST",
            data: {"orderid": id, "messselect": messselect},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    fetchdataShowFastNowOrder();
                    fetchdataShowOrder(type);
                    $("#messengerFastModal").modal("hide");
                } else {
                    $("#messengerFastModal").modal("hide");
                    $("#errorMessage").html(data.error);
                    $("#errorModal").modal("show");
                    fetchdataShowFastNowOrder();
                    fetchdataShowOrder(type);
                }
            }
        });
    });

    $("#savemessengerNormal").on("click", function (e) {
        var id = $('#messNormalId').html();
        var messselect = $("#messengerselect").val();
        $.ajax({
            url: "/restaurant-order/now/save-messenger-normal.php",
            type: "POST",
            data: {"orderid": id, "messselect": messselect},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    fetchdataShowFastNowOrder();
                    fetchdataShowOrder(type);
                    $("#messengerNormalModal").modal("hide");
                } else {
                    $("#messengerNormalModal").modal("hide");
                    $("#errorMessage").html(data.error);
                    $("#errorModal").modal("show");
                    fetchdataShowFastNowOrder();
                    fetchdataShowOrder(type);
                }
            }
        });
    });

    function fetchMessengerData(id) {
        $.ajax({
            url: "/restaurant-order/now/select-messenger.php",
            type: "POST",
            data: {"messselect": mesid},
            dataType: "html",
            success: function (returndata) {
                $("#messenData").html(returndata);
                $("#messenFastData").html(returndata);
            }
        });
    }
    fetchMessengerData(mesid);

    $(".messengerselect").on("change", function (e) {
        mesid = $(this).val();
        fetchMessengerData(mesid);

    });

    $('#showdataNowTypeOrder').on("click", ".normalOrderView", function (e) {
        var id = $(this).attr("data-id");
        var no = $(this).attr("data-no");
        $("#showOrderId").html(no);

        $.ajax({
            url: "/restaurant-order/now/normal-modal.php",
            type: "POST",
            data: {"id": id, "type": "normal"},
            dataType: "html",
            success: function (returndata) {
                $("#normalOrderViewBody").html(returndata);
                $("#detailNormalOrderModal").modal("show");

            }
        });
    });

    $('#showdataNowTypeOrder').on("click", ".fastOrderView", function (e) {
        var id = $(this).attr("data-id");
        var no = $(this).attr("data-no");
        $("#showFastOrderId").html(no);

        $.ajax({
            url: "/restaurant-order/now/fast-modal.php",
            type: "POST",
            data: {"id": id, "type": "normal"},
            dataType: "html",
            success: function (returndata) {
                $("#fastOrderViewBody").html(returndata);
                $("#detailFastOrderModal").modal("show");

            }
        });
    });

    $('#showdataNowTypeOrder').on("change", ".nowstatusselect", function (e) {
        var id = $(this).attr("data-id");
        var statusid = $(this).val();
        $.ajax({
            url: "/restaurant-order/now/change-status-normal.php",
            type: "POST",
            data: {"id": id, "statusid": statusid},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    fetchdataShowOrder(type);

                } else if (data.result == "0") {
                  
                    $("#messNormalId").html(data.orderid);
                    $('#messengerNormalModal').modal({
                        backdrop: 'static',
                         keyboard: false
                    });  
                    $("#messengerNormalModal").modal("show");
                    fetchdataShowOrder(type);
                } else {
                    $("#errorMessage").html(data.error);
                    $("#errorModal").modal("show");
                    fetchdataShowOrder(type);
                }
            }
        });
    });

    $('#showdataNowTypeOrder').on("change", ".faststatusselect", function (e) {
        var id = $(this).attr("data-id");
        var statusid = $(this).val();
        $.ajax({
            url: "/restaurant-order/now/change-status-fast.php",
            type: "POST",
            data: {"id": id, "statusid": statusid},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    fetchdataShowOrder(type);

                } else if (data.result == "0") {
                   
                    fetchdataShowOrder(type);
                    $("#messFastId").html(data.orderid);
                    $('#messengerFastModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                     $("#messengerFastModal").modal("show");


                } else {
                    $("#errorMessage").html(data.error);
                    $("#errorModal").modal("show");
                    fetchdataShowOrder(type);
                }
            }
        });
    });

    $("#prepaybtn").click(function (e) {
        type = "prepay";
        fetchdataShowOrder(type);
    });
    $("#inbtn").click(function (e) {
        type = "int";
        fetchdataShowOrder(type);
    });
    $("#diffpaybtn").click(function (e) {
        type = "diffpay";
        fetchdataShowOrder(type);
    });
    $("#delibtn").click(function (e) {
        type = "deli";
        fetchdataShowOrder(type);
    });
    $("#allbtn").click(function (e) {
        type = "all";
        fetchdataShowOrder(type);
    });



});

function fetchdataShowOrder(t) {
    $.ajax({
        url: "/restaurant-order/now/ajaxFetchNowOrderTable.php",
        type: "POST",
        data: {"type": t},
        dataType: "html",
        success: function (returndata) {
            $("#showdataNowTypeOrder").html(returndata);
            $("#showdataNowTypeOrder").show();
            $("#showdataNowFastOrder").hide();
        }
    });
    // setTimeout(fetchdataShowOrder, 10000);
}

function fetchdataShowFastNowOrder() {
    $.ajax({
        url: "/restaurant-order/now/ajaxNowOrder.php",
        type: "POST",
        data: {"resid": $('#residValue').val()},
        dataType: "html",
        success: function (returndata) {
            $("#showdataNowFastOrder").html(returndata);
        }
    });
    setTimeout(fetchdataShowFastNowOrder, 10000);
}
