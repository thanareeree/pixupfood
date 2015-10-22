$(document).ready(function () {
    $(".unfav").on("click", function (e) {
        var favid = $(this).attr("data-id");
          console.log(favid);
        $.ajax({
            url: "/customer/unfavorite.php?favid=" + favid,
            type: "GET",
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    document.location.reload();
                    console.log(menuid);
                } else {
                    alert(data.error);
                }

            }
        });
    });
});