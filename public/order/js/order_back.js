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

function editOrder(element) {
  const id_order = $(element).data("id_order");
  console.log(id_order);

  $("#editOrder").modal("show");
}

function cancelOrder(id) {
  Swal.fire({
    title: "ยกเลิกออเดอร์ ?",
    text: "คุณต้องการยกเลิกใช่ไหม!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "ใช่",
    cancelButtonText: "ไม่ใช่",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: baseurl + "order/cancel_order_back",
        type: "POST",
        dataType: "json",
        data: { order_id: id },
        success: (res) => {
          if (res.cancel == true) {
            Swal.fire({
              title: "ยกเลิกสำเร็จ !",
              icon: "success",
              showConfirmButton: false,
            });
            setTimeout(function () {
              window.location.reload();
            }, 1000);
          }
        },
      });
    }
  });
}
