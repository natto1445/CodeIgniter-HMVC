var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
    console.log("report_product_exp");
});

$(document).ready(function () {
    console.log("report_product_exp");

    $.ajax({
        url: baseurl + "report/get_report_product_exp",
        type: "POST",
        dataType: "json",
        data: {},
        success: (res) => {
            $("tbody.data_report").html('');
            $("tbody.data_report").html(res.html);
        },
    });
});

function get_report_pdf() {

    var data = {};

    var queryString = Object.keys(data).map(key => key + '=' + encodeURIComponent(data[key])).join('&');


    var url = 'get_report_product_exp_pdf?' + queryString;

    window.open(url, '_blank');
}