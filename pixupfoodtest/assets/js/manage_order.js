var busyFast = false, busyNormal = false;
$(document).ready(function () {
    fetchdataShowFastOrder();
    fetchdataShowNormalOrder();
    countdown();

    setInterval(function () {
        var d = new Date();
        console.log(d.getSeconds());
        if (d.getSeconds() % 5 == 0) {
            fetchdataShowFastOrder();
            fetchdataShowNormalOrder();
        }
    }, 1000);


//view
    $('#showdataFastOrder').on("click", ".fastOrderView", function (e) {
        var id = $(this).attr("data-id");
        $("#showFastOrderId").html(id);

        $.ajax({
            url: "/restaurant-order/request_order/modal-request-fast.php",
            type: "POST",
            data: {"id": id, "type": "fast"},
            dataType: "html",
            success: function (returndata) {
                $("#fastOrderViewBody").html(returndata);
                $("#detailFastOrderModal").modal("show");
            }
        });
    });

    $('#showdataNormalOrder').on("click", ".normalOrderView", function (e) {
        var id = $(this).attr("data-id");
        $("#showOrderId").html(id);

        $.ajax({
            url: "/restaurant-order/request_order/modal-request.php",
            type: "POST",
            data: {"id": id, "type": "normal"},
            dataType: "html",
            success: function (returndata) {
                $("#normalOrderViewBody").html(returndata);
                $("#detailNormalOrderModal").modal("show");

            }
        });
    });

//accept
    $('#showdataFastOrder').on("click", ".acceptFastOrder", function (e) {
        var id = $(this).attr("data-id");
        $("#acceptFastId").html(id);
        $("#acceptFastOrderModal").modal("show");
    });

    $("#acceptFastBtn").on("click", function (e) {
        var type = "accept";
        acceptFastOrder(type);
    });

    $('#showdataNormalOrder').on("click", ".acceptNormalOrder", function (e) {
        var id = $(this).attr("data-id");
        $("#acceptNormalId").html(id);
        $("#acceptNormalOrderModal").modal("show");

    });

    $("#acceptNormalBtn").on("click", function (e) {
        var type = "accept";
        acceptNormalOrder(type);
    });

//ignore
    $('#showdataNormalOrder').on("click", ".ignoreNormalData", function (e) {
        var id = $(this).attr("data-id");
        $("#ignoreNormalId").html(id);
        $("#ignoreNormalOrderModal").modal("show");
    });

    $("#ignoreNormalBtn").on("click", function (e) {
        var type = "ignore";
        ignoreNormalOrder(type);
    });


    $('#showdataFastOrder').on("click", ".ignoreFastOrder", function (e) {
        var id = $(this).attr("data-id");
        $("#ignoreFastId").html(id);
        $("#ignoreFastOrderModal").modal("show");
    });
     $("#ignoreFastBtn").on("click", function (e) {
        var type = "ignore";
        ignoreFastOrder(type);
    });



});

function fetchdataShowFastOrder() {
    if (!busyFast) {
        busyFast = true;
        $.ajax({
            url: "/restaurant/ajax_fetchdataFastOrder.php",
            type: "POST",
            data: {"resid": $('#residValue').val()},
            dataType: "html",
            success: function (returndata) {
                $("#showdataFastOrder").html(returndata);
                busyFast = false;
                var count = $("#fastordercount").val();
                $(".countfast").html(count);
            },
            error: function (data) {
                busyFast = false;
            }
        });
    }
}


function fetchdataShowNormalOrder() {
    if (!busyNormal) {
        busyNormal = true;
        $.ajax({
            url: "/restaurant/ajax_fetchdataNormalOrder.php",
            type: "POST",
            data: {"resid": $('#residValue').val()},
            dataType: "html",
            success: function (returndata) {
                $("#showdataNormalOrder").html(returndata);
                busyNormal = false;
                var count = $("#normalordercount").val();
                $(".countnormal").html(count);
                var all = parseInt($("#normalordercount").val()) + parseInt($("#fastordercount").val());
                $(".countall").html(all);
            },
            error: function (data) {
                busyNormal = false;
            }
        });
    }
}

function acceptFastOrder(type) {
    $("#acceptFastBtn").html("<img src='/assets/images/loader.gif' style='height:20px; width:20px; margin:0 auto;'>");
    $.ajax({
        url: "/restaurant-order/request_order/api/actionFastOrder.php",
        type: "POST",
        data: {"orderid": $('#acceptFastId').html(), "cmd": type},
        dataType: "json",
        success: function (data) {
            if (data.result == "1") {
                $("#acceptFastOrderModal").modal("hide");
                fetchdataShowFastOrder();
                
            } else {
                alert(data.error);
            }
        }
    });
}


function ignoreFastOrder(type) {
    $("#ignoreFastBtn").html("<img src='/assets/images/loader.gif' style='height:20px; width:20px; margin:0 auto;'>");
    $.ajax({
        url: "/restaurant-order/request_order/api/actionFastOrder.php",
        type: "POST",
        data: {"cmd": type, "ignoreNormalId": $('#ignoreFastId').html()},
        dataType: "json",
        success: function (data) {
            if (data.result == "1") {
                $("#ignoreFastOrderModal").modal("hide");
                fetchdataShowFastOrder();
            } else {
                alert(data.error);
            }
        }
    });
}

function acceptNormalOrder(type) {
    $("#acceptNormalBtn").html("<img src='/assets/images/loader.gif' style='height:20px; width:20px; margin:0 auto;'>");
    $.ajax({
        url: "/restaurant-order/request_order/api/actionNormalOrder.php",
        type: "POST",
        data: {"orderid": $('#acceptNormalId').html(), "cmd": type},
        dataType: "json",
        success: function (data) {
            if (data.result == "1") {
                $("#acceptNormalOrderModal").modal("hide");
                fetchdataShowNormalOrder();
            } else {
                alert(data.error);
            }
        }
    });
}


function ignoreNormalOrder(type) {
    $("#ignoreNormalBtn").html("<img src='/assets/images/loader.gif' style='height:5px; margin:0 auto;'>");
    $.ajax({
        url: "/restaurant-order/request_order/api/actionNormalOrder.php",
        type: "POST",
        data: {"cmd": type, "ignoreNormalId": $('#ignoreNormalId').html()},
        dataType: "json",
        success: function (data) {
            if (data.result == "1") {
                $("#ignoreNormalOrderModal").modal("hide");
                fetchdataShowNormalOrder();
            } else {
                alert(data.error);
            }
        }
    });
}

function countdown() {
    $.each($(".timeleft"), function (i, timer) {
        var second = parseInt($(timer).attr("data-second"));
        $(timer).attr("data-second", --second);
        $(timer).html(second);
        if (second < 0) {
            $(timer).parent().parent().remove();
            fetchdataShowFastOrder();
            fetchdataShowNormalOrder();
        }
    });
    //setTimeout(countdown, 1000);
}

function seconds2time(seconds) {
    var hours = Math.floor(seconds / 3600);
    var minutes = Math.floor((seconds - (hours * 3600)) / 60);
    var seconds = seconds - (hours * 3600) - (minutes * 60);
    var time = "";

    if (hours != 0) {
        time = hours + ":";
    }
    if (minutes != 0 || time !== "") {
        minutes = (minutes < 10 && time !== "") ? "0" + minutes : String(minutes);
        time += minutes + ":";
    }
    if (time === "") {
        time = seconds;
    }
    else {
        time += (seconds < 10) ? "0" + seconds : String(seconds);
    }
    return time;
}