var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
    select("body").classList.toggle("toggle-sidebar");
    AJAX_LOAD_MyOrder();
});

function AJAX_LOAD_MyOrder() {
    $.post(baseurl + "order/ajax_load_myorder", function (response) {
        var data = response.split("^");
        $("#myorder_data").dataTable().fnDestroy();
        $("tbody.data-myorder").html(data[1]);
        $("#myorder_data").DataTable();
    });
}

const select = (el, all = false) => {
    el = el.trim();
    if (all) {
        return [...document.querySelectorAll(el)];
    } else {
        return document.querySelector(el);
    }
};