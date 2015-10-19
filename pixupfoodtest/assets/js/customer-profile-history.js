$(document).ready(function () {
    showHistoryOrder();
    showFastHistoryOrder();

    $('#showHistoryOrder').on("click", ".normalOrderView", function (e) {
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


function showHistoryOrder() {
    $.ajax({
        url: "/customer-profile/history/table.php",
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#showHistoryOrder').html(data);
        }
    });
}



function showFastHistoryOrder() {
    $.ajax({
        url: "/customer-profile/history/table-fast.php",
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#showFastOrder').html(data);
        }
    });
}