$(document).ready(function () {
    $(".btn-pref .btn").click(function () {
        $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
        $(".tab").addClass("active"); // instead of this do the below 
        $(this).removeClass("btn-default").addClass("btn-warning");
    });



    $("#promotionselect").on("change", function (e) {
        $.ajax({
            url: "/restaurant-setting/promotion-select.php",
            type: "POST",
            data: {"promotionid": $("#promotionselect").val()},
            dataType: "html",
            success: function (data) {
                $("#showdetailpromotion").html(data);
            }
        });
    });

     $(".remove").click(function (e) {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "/restaurant-setting/delete-promotion.php?proid=" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if(data.result == '1'){
                            document.location.reload();
                        }else{
                            alert(data.error);
                        }
                    }
                });
            });
    /*$("#promotion").on('submit', function (e) {
        $.ajax({
            url: "/restaurant/add-promotion.php",
            type: "POST",
            data: $("#promotionselect").val(),
            dataType: "html",
            success: function (data) {
                if (data.result == 1) {
                    alert(data);
                } else {
                    $("#showerror").html(data.error);
                }
            }
        });
        e.preventDefault();
        return false;
    });*/
});

