var busyFast = false, busyNormal = false
$(document).ready(function () {
    $(".btn-pref .btn").click(function () {
        $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
        $(this).removeClass("btn-default").addClass("btn-warning");
    });


    fetchdataShowNowOrder();
    fetchdataShowFastNowOrder();

    $('#showdataNowNormalOrder').on("click", ".normalOrderView", function (e) {
        var id = $(this).attr("data-id");
        $("#showOrderId").html(id);

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
        $("#showFastOrderId").html(id);

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

    $('#showdataNowNormalOrder').on("change", ".statusselect", function (e) {
        var id = $(this).attr("data-id");
        var statusid = $(this).val();
        $.ajax({
            url: "/restaurant-order/now/change-status-normal.php",
            type: "POST",
            data: {"id": id, "statusid": statusid},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    fetchdataShowNowOrder();

                } else {
                     $("#errorMessage").html(data.error);
                    $("#errorModal").modal("show");
                     fetchdataShowNowOrder();
                }
            }
        });
    });
    
    $('#showdataNowFastOrder').on("change", ".statusselect", function (e) {
        var id = $(this).attr("data-id");
        var statusid = $(this).val();
        $.ajax({
            url: "/restaurant-order/now/change-status-fast.php",
            type: "POST",
            data: {"id": id, "statusid": statusid},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    fetchdataShowNowOrder();

                } else {
                     $("#errorMessage").html(data.error);
                    $("#errorModal").modal("show");
                     fetchdataShowNowOrder();
                }
            }
        });
    });




});

function fetchdataShowNowOrder() {
    $.ajax({
        url: "/restaurant-order/now/ajaxFetchNowNormalOrderTable.php",
        type: "POST",
        data: {"resid": $('#residValue').val()},
        dataType: "html",
        success: function (returndata) {
            $("#showdataNowNormalOrder").html(returndata);
        }
    });
     //setTimeout(fetchdataShowNowOrder, 1000);
}

function fetchdataShowFastNowOrder() {
    $.ajax({
        url: "/restaurant-order/now/ajaxFetchNowFastOrderTable.php",
        type: "POST",
        data: {"resid": $('#residValue').val()},
        dataType: "html",
        success: function (returndata) {
            $("#showdataNowFastOrder").html(returndata);
            changeStatus();
        }
    });
     //setTimeout(fetchdataShowFastNowOrder, 1000);
}

function changeStatus() {

}

