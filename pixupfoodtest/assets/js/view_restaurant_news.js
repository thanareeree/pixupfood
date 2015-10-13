$(document).ready(function (e) {
   fetchCalendar();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev',
            center: 'title',
            right: 'next today'
        },
        events: JSON.parse(json_events),
        lang: 'th',
        eventColor: 'orange',
        eventLimit: true
    });

});


function  fetchCalendar() {
    $.ajax({
        url: '/api/showcalendar.php',
        type: 'POST',
        data: {"resid": $(".getResId").val(), "type": "fetch"},
        async: false,
        success: function (response) {
            json_events = response;
        }
    });
}