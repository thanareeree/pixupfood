$(document).ready(function (e) {
   

    $('#calendar').fullCalendar({
        header: {
            left: 'prev',
            center: 'title',
            right: 'next today'
        },
        events: {
            url: '/customer/showcalendar.php',
            type: 'POST',
            data: {resid: $(".getResId").val()},
        },
        eventColor: 'orange'
    });

});