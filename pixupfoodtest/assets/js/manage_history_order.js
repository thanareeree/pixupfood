var month = "0";

$(document).ready(function () {

    $("#monthselect").on("change", function (e) {
        month = $(this).val();
        $.ajax({
            url: "/restaurant-order/history/ajaxFetchSelectMonthTable.php",
            type: "POST",
            data: {"month": month},
            dataType: "html",
            success: function (returndata) {
                $("#showdataNowFastOrder").html(returndata);
                $('#historyDataTable').DataTable();
            }
        });
    });

 fetchdataShowFastNowOrder();

    $('#showdataNowFastOrder').on("click", ".normalOrderView", function (e) {
        var id = $(this).attr("data-id");
        var no = $(this).attr("data-no");
        $("#showOrderId").html(no);

        $.ajax({
            url: "/restaurant-order/history/normal-modal.php",
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
            url: "/restaurant-order/history/fast-modal.php",
            type: "POST",
            data: {"id": id, "type": "fast"},
            dataType: "html",
            success: function (returndata) {
                $("#fastOrderViewBody").html(returndata);
                $("#detailFastOrderModal").modal("show");

            }
        });
    });

});


function fetchdataShowFastNowOrder() {
    $.ajax({
        url: "/restaurant-order/history/ajaxFetchHistoryFastOrderTable.php",
        type: "POST",
        data: {"resid": $('#residValue').val()},
        dataType: "html",
        success: function (returndata) {
            $("#showdataNowFastOrder").html(returndata);
        
        }
    });
    // setTimeout(fetchdataShowFastNowOrder, 5000);
}


