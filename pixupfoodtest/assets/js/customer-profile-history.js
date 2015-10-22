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
    

    $('#showFastOrder').on("click", ".fastReview", function (e) {
        var id = $(this).attr("data-id");
        $("#restId").html(id);
        var name = $(this).attr("data-name");
        $("#restaurantName").html(name);
        $("#reviewNormalModal").modal("show");

    });
    
    $('#showHistoryOrder').on("click", ".normalReview", function (e) {
        var id = $(this).attr("data-id");
        $("#restId").html(id);
        var name = $(this).attr("data-name");
        $("#restaurantName").html(name);
        $("#reviewNormalModal").modal("show");

    });

    var star = "";
    $(".star-1").change(function (e) {
        star = "1";
    });

    $(".star-2").change(function (e) {
        star = "2";
    });

    $(".star-3").change(function (e) {
        star = "3";
    });

    $(".star-4").change(function (e) {
        star = "4";
    });

    $(".star-5").change(function (e) {
        star = "5";
    });

    $('#saveReviewBtn').on("click", function (e) {
        var resid = $("#restId").html();
        $.ajax({
            url: "/customer-profile/history/save-review.php",
            type: "POST",
            data: {"resid": resid, "score": star, "detail": $("#reviewinput").val()},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    $("#ratingsForm").trigger("reset");
                    $("#reviewNormalModal").modal("hide");
                } else {
                    alert(data.error);

                }


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