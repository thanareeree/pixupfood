$(document).ready(function () {
    showNormalOrder();
    showFastOrder();


    $('#showNormalOrder').on("click", ".normalOrderView", function (e) {
        var id = $(this).attr("data-id");
        $("#showOrderId").html(id);

        $.ajax({
            url: "/api/normal-order-show-customer.php",
            type: "POST",
            data: {"id": id, "type": "normal"},
            dataType: "html",
            success: function (returndata) {
                $("#normalOrderViewBody").html(returndata);
                $("#detailNormalOrderModal").modal("show");

            }
        });
    });
    //slip normal 1
    $('#showNormalOrder').on("click", ".uploadSlip1", function (e) {
        var id = $(this).attr("data-id");
        $("#uploadOrderId").html(id);
        $.ajax({
            url: "/customer-profile/tracking/upload-tranfer-modal.php",
            type: "POST",
            data: {"id": id},
            dataType: "html",
            success: function (returndata) {
                $("#upload").html(returndata);
                $("#transfSlip1").modal("show");

            }
        });
    });
        //slip normal 2   
     $('#showNormalOrder').on("click", ".uploadSlip2", function (e) {
        var id = $(this).attr("data-id");
        $("#uploadOrderId").html(id);
        $.ajax({
            url: "/customer-profile/tracking/upload-slip-n2-modal.php",
            type: "POST",
            data: {"id": id},
            dataType: "html",
            success: function (returndata) {
                $("#upload").html(returndata);
                $("#transfSlip1").modal("show");

            }
        });
    });

   $('#showFastOrder').on("click", ".fastOrderView", function (e) {
        var id = $(this).attr("data-id");
        $("#showOrderId").html(id);

        $.ajax({
            url: "/api/fast-order-show-customer-modal.php",
            type: "POST",
            data: {"id": id},
            dataType: "html",
            success: function (returndata) {
                $("#fastOrderViewBody").html(returndata);
                $("#detailFastOrderModal").modal("show");

            }
        });
    });
});


function showNormalOrder() {
    $.ajax({
        url: "/customer-profile/tracking/table.php",
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#showNormalOrder').html(data);
        }
    });
}

function showFastOrder() {
    $.ajax({
        url: "/customer-profile/tracking/table-fast.php",
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#showFastOrder').html(data);
        }
    });
}

