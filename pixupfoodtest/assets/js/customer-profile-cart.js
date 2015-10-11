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
        }
    });


}