var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
  console.log("order");
  AJAX_LOAD_OrderBack();
});

function AJAX_LOAD_OrderBack() {
  $.post(baseurl + "order/ajax_load_orderfront", function (response) {
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

function statusOrder(element) {
  const id_order = $(element).data("id_order");
  const status_order = $(element).data("status_order");
  const order_no = $(element).data("order_no");

  document.getElementById("id_order").value = id_order;
  document.getElementById("order_no").value = order_no;
  document.querySelector("#status_order").value = status_order;

  $("#statusOrder").modal("show");
}

const update_Status = (ev_form) => {
  var flag = true;
  let formD = new FormData($("#" + ev_form)[0]);

  var status_order = document.getElementById("status_order");
  var fileInput = document.getElementById('slip_deli');

  if (status_order.value == 5) {
    if (fileInput.files.length < 1) {
      Swal.fire({
        title: "ผิดพลาด!",
        text: "โปรดทำการอัพโหลดสลิปจัดส่ง",
        icon: "info",
      });
      return false;
    }
  }

  $.ajax({
    url: baseurl + "order/update_status_orderfont",
    type: "POST",
    dataType: "json",
    processData: false,
    contentType: false,
    data: formD,
    success: (res) => {
      if (res.suc == true) {
        Swal.fire({
          title: "อัพเดทสถานะออเดอร์สำเร็จ !",
          icon: "success",
          showConfirmButton: false,
        });
        setTimeout(function () {
          window.location.reload();
        }, 1000);
      }
    },
  });
};

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
        url: baseurl + "order/cancel_order_front",
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

function showslip_noline(id) {
  $.ajax({
    url: baseurl + "order/ajax_slip_orderfront",
    type: "POST",
    dataType: "json",
    data: { id: id },
    success: (res) => {
      var div = document.getElementById("imageContainer");
      var address_order = document.getElementById("address_order");
      console.log(res.address)
      div.innerHTML = res.pic;
      address_order.value = res.address;
    },
  });

  $("#show_slip").modal("show");
}

function showslip_delivery(id) {
  $.ajax({
    url: baseurl + "order/ajax_slip_orderfront_deli",
    type: "POST",
    dataType: "json",
    data: { id: id },
    success: (res) => {
      var div = document.getElementById("imageContainer_deli");
      div.innerHTML = res.pic;
    },
  });

  $("#show_slip_deli").modal("show");
}
