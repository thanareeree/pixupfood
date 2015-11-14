
$(document).ready(function () {

    //fetchdataShowFastNowOrder();

    $('#showdataIgnoreOrder').on("click", ".normalOrderView", function (e) {
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


    $('#showdataIgnoreOrder').on("click", ".fastOrderView", function (e) {
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
        url: "/restaurant-order/ignore/ajaxFetchIgnoreTable.php",
        type: "POST",
        data: {"resid": $('#residValue').val()},
        dataType: "html",
        success: function (returndata) {
            $("#showdataIgnoreOrder").html(returndata);

        }
    });
    // setTimeout(fetchdataShowFastNowOrder, 5000);
}


