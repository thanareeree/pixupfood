$(document).ready(function () {


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
    fetchdataShowFastOrder();

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
    fetchdataShowNormalOrder();


    $('#showdataFastOrder').on("click", ".fastOrderView", function (e) {
        var viewid = $(this).attr("id");
        var id = viewid.replace("fastOrderView", "");
        $("#showorderid").html(id);

        $.ajax({
            url: "/restuarant/ajax-detailOrder-modal.php",
            type: "POST",
            data: {"id": id},
            dataType: "html",
            success: function (returndata) {
                $("#fastOrderViewBody").html(returndata);
                $("#detailOrderModal").modal("show");
            }
        });
    });

    $('#showdataNormalOrder').on("click", ".normalOrderView", function (e) {
        var viewid = $(this).attr("id");
        var id = viewid.replace("normalOrderView", "");
        $("#showorderid").html(id);

        $.ajax({
            url: "/restuarant/ajax-detailOrder-modal.php",
            type: "POST",
            data: {"id": id},
            dataType: "html",
            success: function (returndata) {
                $("#fastOrderViewBody").html(returndata);
                $("#detailOrderModal").modal("show");
            }
        });
    });


});