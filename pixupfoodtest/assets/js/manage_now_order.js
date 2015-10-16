$(document).ready(function () {
    $(".btn-pref .btn").click(function () {
        $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
        $(this).removeClass("btn-default").addClass("btn-warning");
    });


    fetchdataShowNowOrder();
    fetchdataShowFastNowOrder();


    $('#nowOrderView').on("click", function (e) {
        /*var viewid = $(this).attr("id");
         var id = viewid.replace("nowOrderView", "");
         $("#showorderid").html(id);*/

        $.ajax({
            url: "/restuarant/order-detail-now-modal.php",
            type: "POST",
            data: {"id": id},
            dataType: "html",
            success: function (returndata) {
                $("#showModalDetail").html(returndata);
                $("#detail").modal("show");
            }
        });
    });


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
}

function fetchdataShowFastNowOrder(){
    $.ajax({
        url: "/restaurant-order/now/ajaxFetchNowFastOrderTable.php",
        type: "POST",
        data: {"resid": $('#residValue').val()},
        dataType: "html",
        success: function (returndata) {
            $("#showdataNowFastOrder").html(returndata);
        }
    });
}

