var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
  console.log("order");
  AJAX_LOAD_OrderBack();
});

function AJAX_LOAD_OrderBack() {
  $.post(baseurl + "order/ajax_load_orderback", function (response) {
    var data = response.split("^");
    $("#order_data").dataTable().fnDestroy();
    $("tbody.data-order").html(data[1]);
    $("#order_data").DataTable();
  });
}
