$(document).ready(function () {
    var textAreas = document.getElementsByTagName('textarea');

    Array.prototype.forEach.call(textAreas, function (elem) {
        elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
    });


    $("#imgpro").on("change", function (e) {
        var imgsize = $("#imgpro")[0].files[0].size;
        var imgtype = $("#imgpro")[0].files[0].type;
        switch (imgtype) {
            case 'image/png':
            case 'image/pjpeg':
            case 'image/jpeg':
                break;
            default :
                $("#output").html("Error: <b>" + imgtype + "</b>  Unsupport file type!! <br>");
                $("#sendbtn").attr("disabled", "disabled");
        }
        if (imgsize > 1048576) {
            $("#output").html("Size: <b>" + imgsize + "</b> too big file!!");
            $("#updateprobtn").attr("disabled", "disabled");
        } else {
            $("#output").html(" ");
            $("#updateprobtn").removeAttr("disabled");
        }
    });


});