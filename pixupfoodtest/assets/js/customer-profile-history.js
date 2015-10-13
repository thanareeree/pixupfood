$(document).ready(function () {
    showHistoryOrder();

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