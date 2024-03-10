var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
    console.log("report_date")
});

function get_report() {
    var date_start = document.getElementById("date_start");
    var date_end = document.getElementById("date_end");

    console.log(date_start.value)
    console.log(date_end.value)

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
            console.log(res.html)
            $("#report_data").dataTable().fnDestroy();
            $("tbody.data_report").html(res.html);
            $("#report_data").DataTable();

        },
    });

    // $.post(baseurl + "product/ajax_load_product", function (response) {
    //     var data = response.split("^");
    //     $("#product_data").dataTable().fnDestroy();
    //     $("tbody.data-product").html(data[1]);
    //     $("#product_data").DataTable();
    // });
}