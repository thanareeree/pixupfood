$(document).ready(function () {
  //showNormalOrder();
  //showFastOrder();


    $('#showNormalOrder').on("click", ".normalOrderView", function (e) {
        var id = $(this).attr("data-id");
         var no = $(this).attr("data-no");
        $("#showOrderId").html(no);

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
    //slip normal 1
    $('#showNormalOrder').on("click", ".uploadSlip1", function (e) {
        var id = $(this).attr("data-id");
        $("#uploadOrderId").html(id);
        $.ajax({
            url: "/customer-profile/tracking/upload-tranfer-modal.php",
            type: "POST",
            data: {"id": id},
            dataType: "html",
            success: function (returndata) {
                $("#upload").html(returndata);
                $("#transfSlip1").modal("show");

            }
        });
    });
        //slip normal 2   
     $('#showNormalOrder').on("click", ".uploadSlip2", function (e) {
        var id = $(this).attr("data-id");
        $("#uploadOrderId").html(id);
        $.ajax({
            url: "/customer-profile/tracking/upload-slip-n2-modal.php",
            type: "POST",
            data: {"id": id},
            dataType: "html",
            success: function (returndata) {
                $("#upload").html(returndata);
                $("#transfSlip1").modal("show");

            }
        });
    });
    
     //slip fast 1
    $('#showFastOrder').on("click", ".uploadSlip1", function (e) {
        var id = $(this).attr("data-id");
        $("#uploadOrderId").html(id);
        $.ajax({
            url: "/customer-profile/tracking/upload-slip-f1-modal.php",
            type: "POST",
            data: {"id": id},
            dataType: "html",
            success: function (returndata) {
                $("#upload").html(returndata);
                $("#transfSlip1").modal("show");

            }
        });
    });
        //slip fast 2   
     $('#showFastOrder').on("click", ".uploadSlip2", function (e) {
        var id = $(this).attr("data-id");
        $("#uploadOrderId").html(id);
        $.ajax({
            url: "/customer-profile/tracking/upload-slip-f2-modal.php",
            type: "POST",
            data: {"id": id},
            dataType: "html",
            success: function (returndata) {
                $("#upload").html(returndata);
                $("#transfSlip1").modal("show");

            }
        });
    });


   $('#showFastOrder').on("click", ".fastOrderView", function (e) {
        var id = $(this).attr("data-id");
        var no = $(this).attr("data-no");
        $("#showFastOrderId").html(no);

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
    
    $(".cancelFastOrderBtn").on("click", function (e){
        var fasid = $("#showFastOrderId").html();
         $.ajax({
            url: "/customer-profile/tracking/cancel-order-fast.php",
            type: "POST",
            data: {"fastno": fasid},
            dataType: "json",
            success: function (returndata) {
              if(returndata.result == 1){
                   $("#detailFastOrderModal").modal("hide");
                   $("#msgModal").modal("show");
                   //document.location.reload();
               }else{
                     alert(returndata.error);
               }

            }
        });
        //alert(fasid);
    });
    
    
    $(".cancelNormalOrderBtn").on("click", function (e){
        var normalid = $("#showOrderId").html();
         $.ajax({
            url: "/customer-profile/tracking/cancel-order-normal.php",
            type: "POST",
            data: {"normalno": normalid},
            dataType: "json",
            success: function (returndata) {
              if(returndata.result == 1){
                   $("#detailNormalOrderModal").modal("hide");
                   $("#msgModal").modal("show");
                   //document.location.reload();
               }else{
                     alert(returndata.error);
               }

            }
        });
      
    });
    
    
});


function showNormalOrder() {
    $.ajax({
        url: "/customer-profile/tracking/table.php",
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#showNormalOrder').html(data);
        }
    });
}

function showFastOrder() {
    $.ajax({
        url: "/customer-profile/tracking/table-fast.php",
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#showFastOrder').html(data);
        }
    });
}

