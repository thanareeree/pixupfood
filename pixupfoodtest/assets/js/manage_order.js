$(document).ready(function () {
    fetchdataShowFastOrder();
    fetchdataShowNormalOrder();



//view
    $('#showdataFastOrder').on("click", ".fastOrderView", function (e) {
        var id = $(this).attr("data-id");
        $("#showFastOrderId").html(id);

        $.ajax({
            url: "/restaurant-order/request_order/modal-request.php",
            type: "POST",
            data: {"id": id, "type": "fast"},
            dataType: "html",
            success: function (returndata) {
                $("#fastOrderViewBody").html(returndata);
                $("#detailFastOrderModal").modal("show");
            }
        });
    });

    $('#showdataNormalOrder').on("click", ".normalOrderView", function (e) {
        var id = $(this).attr("data-id");
        $("#showOrderId").html(id);

        $.ajax({
            url: "/api/normal-order-modal.php",
            type: "POST",
            data: {"id": id, "type": "normal"},
            dataType: "html",
            success: function (returndata) {
                $("#normalOrderViewBody").html(returndata);
                $("#detailNormalOrderModal").modal("show");

            }
        });
    });
    
//accept
    $('#showdataFastOrder').on("click", ".acceptFastOrder", function (e) {
        var id = $(this).attr("data-id");
        $("#acceptFastId").html(id);
        $("#acceptFastOrderModal").modal("show");
    });


    $('#showdataNormalOrder').on("click", ".acceptNormalOrder", function (e) {
        var id = $(this).attr("data-id");
        $("#acceptNormalId").html(id);
        $("#acceptNormalOrderModal").modal("show");
        
    });
    
    $("#acceptNormalBtn").on("click", function (e){
        var type = "accept";
        acceptNormalOrder(type);
    });

//ignore
    $('#showdataNormalOrder').on("click", ".ignoreNormalData", function (e) {
        var id = $(this).attr("data-id");
        $("#ignoreNormalId").html(id);
        $("#ignoreNormalOrderModal").modal("show");
    });
    
    $("#ignoreNormalBtn").on("click", function (e){
        var type = "ignore";
        ignoreNormalOrder(type);
    });

    
    $('#showdataFastOrder').on("click", ".ignoreFastOrder", function (e) {
        var id = $(this).attr("data-id");
        $("#ignoreId").html(id);
        $("#ignoreOrderModal").modal("show");
    });



});

function fetchdataShowFastOrder() {
    $.ajax({
        url: "/restaurant/ajax_fetchdataFastOrder.php",
        type: "POST",
        data: {"resid": $('#residValue').val()},
        dataType: "html",
        success: function (returndata) {
            $("#showdataFastOrder").html(returndata);
        }
    });
}


function fetchdataShowNormalOrder() {
    $.ajax({
        url: "/restaurant/ajax_fetchdataNormalOrder.php",
        type: "POST",
        data: {"resid": $('#residValue').val()},
        dataType: "html",
        success: function (returndata) {
            $("#showdataNormalOrder").html(returndata);
        }
    });
}

function acceptNormalOrder(type) {
    $("#acceptNormalBtn").html("<img src='/assets/images/loader.gif' style='width:100%;height:5px; margin:0 auto;'>");
    $.ajax({
        url: "/restaurant-order/request_order/api/actionNormalOrder.php",
        type: "POST",
        data: {"orderid": $('#acceptNormalId').html(), "cmd": type},
        dataType: "json",
        success: function (data) {
            if (data.result == "1") {
                 $("#acceptNormalOrderModal").modal("hide");
                 fetchdataShowNormalOrder();
            } else {
                alert(data.error);
            }
        }
    });
}


function ignoreNormalOrder(type) {
    $("#ignoreNormalBtn").html("<img src='/assets/images/loader.gif' style='height:5px; margin:0 auto;'>");
    $.ajax({
        url: "/restaurant-order/request_order/api/actionNormalOrder.php",
        type: "POST",
        data: { "cmd": type, "ignoreNormalId":$('#ignoreNormalId').html()},
        dataType: "json",
        success: function (data) {
            if (data.result == "1") {
                  $("#ignoreNormalOrderModal").modal("hide");
                 fetchdataShowNormalOrder();
            } else {
                alert(data.error);
            }
        }
    });
}