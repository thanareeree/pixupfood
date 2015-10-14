$(document).ready(function () {
    fetchdataShowFastOrder();
    fetchdataShowNormalOrder();




    $('#showdataFastOrder').on("click", ".fastOrderView", function (e) {
        var id = $(this).attr("data-id");
        $("#showorderid").html(id);

        $.ajax({
            url: "/restaurant-order/request_order/modal-request.php",
            type: "POST",
            data: {"id": id, "type": "fast"},
            dataType: "html",
            success: function (returndata) {
                $("#OrderViewBody").html(returndata);
                $("#detailOrderModal").modal("show");
            }
        });
    });

    $('#showdataNormalOrder').on("click", ".normalOrderView", function (e) {
        var id = $(this).attr("data-id");
        $("#showorderid").html(id);

        $.ajax({
            url: "/restaurant-order/request_order/modal-request.php",
            type: "POST",
            data: {"id": id, "type": "normal"},
            dataType: "html",
            success: function (returndata) {
                $("#OrderViewBody").html(returndata);
                $("#detailOrderModal").modal("show");

            }
        });
    });

    $('#showdataFastOrder').on("click", ".acceptFastOrder", function (e) {
        var id = $(this).attr("data-id");
        $("#acceptId").html(id);
        $("#acceptOrderModal").modal("show");
    });

    $('#showdataNormalOrder').on("click", ".acceptNormalOrder", function (e) {
        var id = $(this).attr("data-id");
        $("#acceptId").html(id);
        $("#acceptOrderModal").modal("show");
        
    });
    
    $("#acceptBtn").on("click", function (e){
        var type = "accept";
        actionNormalOrder(type);
    });


    $('#showdataFastOrder').on("click", ".ignoreFastOrder", function (e) {
        var id = $(this).attr("data-id");
        $("#ignoreId").html(id);
        $("#ignoreOrderModal").modal("show");
    });

    $('#showdataNormalOrder').on("click", ".ignoreNormalData", function (e) {
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


function actionNormalOrder(type) {
    $.ajax({
        url: "/restaurant-order/request_order/api/actionNormalOrder.php",
        type: "POST",
        data: {"orderid": $('#acceptId').html(), "cmd": type},
        dataType: "json",
        success: function (data) {
            if (data.result == "1") {
                 $("#acceptOrderModal").modal("hide");
                 fetchdataShowNormalOrder();
            } else {
                alert(data.error);
            }

           
        }
    });
}