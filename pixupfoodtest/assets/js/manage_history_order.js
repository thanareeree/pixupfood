
$(document).ready(function () {
  

    fetchdataShowNowOrder();
    fetchdataShowFastNowOrder();

    $('#showdataNowNormalOrder').on("click", ".normalOrderView", function (e) {
        var id = $(this).attr("data-id");
        $("#showOrderId").html(id);

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
        $("#showFastOrderId").html(id);

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

function fetchdataShowNowOrder() {
    $.ajax({
        url: "/restaurant-order/history/ajaxFetchHistoryNormalOrderTable.php",
        type: "POST",
        data: {"resid": $('#residValue').val()},
        dataType: "html",
        success: function (returndata) {
            $("#showdataNowNormalOrder").html(returndata);
        }
    });
    // setTimeout(fetchdataShowNowOrder, 5000);
}

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


