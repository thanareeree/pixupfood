$(document).ready(function () {
  showNormalOrder();
 showFastOrder();

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