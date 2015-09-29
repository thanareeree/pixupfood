$(document).ready(function () {
    $(".btn-pref .btn").click(function () {
        $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
        $(this).removeClass("btn-default").addClass("btn-warning");
    });

    function fetchdataShowNowOrder() {
        $.ajax({
            url: "/restaurant/.php",
            type: "POST",
            data: {"resid": $('#residValue').val()},
            dataType: "html",
            success: function (returndata) {
                $("#showdataNowOrder").html(returndata);
            }
        });
    }
    fetchdataShowNowOrder();



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

    


});

