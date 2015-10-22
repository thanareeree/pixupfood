$(document).ready(function () {
    showShopList();
   
});

function showShopList() {
    $.ajax({
        url: "/customer-profile/cart/table.php",
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#showshoplist').html(data);
              $('[data-toggle="tooltip"]').tooltip();
            blindDelete();
        }
    });


}


function blindDelete() {
    $('#showshoplist').on('click', '.remove_cart', function (e) {
        var orderDetailId = $(this).attr("id");
        var id = orderDetailId.replace("remove_cart", "");
        $.ajax({
            url: "/order/normal/removeOrderDetail.php",
            type: "POST",
            data: {"id": id},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    showShopList();
                } else {
                    alert(data.error);
                }
            }
        });
    });
}