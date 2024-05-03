var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
    console.log("report_date")
});

function get_report() {
    var date_start = document.getElementById("date_start");
    var date_end = document.getElementById("date_end");

    if (date_start.value == '') {
        Swal.fire({
            title: "ผิดพลาด!",
            text: "โปรดระบุวันที่เริมต้น.",
            icon: "info",
        });
        return false;
    }

    if (date_end.value == '') {
        Swal.fire({
            title: "ผิดพลาด!",
            text: "โปรดระบุวันที่สิ้นสุด.",
            icon: "info",
        });
        return false;
    }

    $.ajax({
        url: baseurl + "report/get_report_date",
        type: "POST",
        dataType: "json",
        data: { date_start: date_start.value, date_end: date_end.value },
        success: (res) => {
            $("tbody.data_report").html('');
            $("tbody.data_report").html(res.html);
        },
    });
}

function get_report_pdf() {
    var date_start = document.getElementById("date_start");
    var date_end = document.getElementById("date_end");

    if (date_start.value == '') {
        Swal.fire({
            title: "ผิดพลาด!",
            text: "โปรดระบุวันที่เริมต้น.",
            icon: "info",
        });
        return false;
    }

    if (date_end.value == '') {
        Swal.fire({
            title: "ผิดพลาด!",
            text: "โปรดระบุวันที่สิ้นสุด.",
            icon: "info",
        });
        return false;
    }

    var data = {
        date_start: date_start.value,
        date_end: date_end.value
    };

    var queryString = Object.keys(data).map(key => key + '=' + encodeURIComponent(data[key])).join('&');


    var url = 'get_report_date_pdf?' + queryString;

    window.open(url, '_blank');
}