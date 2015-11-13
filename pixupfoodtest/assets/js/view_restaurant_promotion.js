$(document).ready(function (e) {
    fetchCalendar();

    $('#pinBoot').pinterest_grid({
        no_columns: 4,
        padding_x: 10,
        padding_y: 10,
        margin_bottom: 50,
        single_column_breakpoint: 700
    });

    $('#calendar').fullCalendar({
        header: {
            left: 'prev',
            center: 'title',
            right: 'next today'
        },
        events: JSON.parse(json_events),
        lang: 'th',
        eventColor: 'orange',
        eventLimit: true,
         eventAfterRender: function (event, element, view) {
            if (event.status ==0) {
                //event.color = "#FFB347"; //Em andamento
                element.css('background-color', 'red'); 
                element.css('border-color', 'red');
            }
        }
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