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

function previewpic(event) {
  var input = event.target;
  var preview = document.getElementById("previewImage");
  var container = document.getElementById("imageContainer");

  var reader = new FileReader();

  reader.onload = function () {
    preview.src = reader.result;
    preview.style.display = "block";
    container.style.height = "auto";
  };

  if (input.files && input.files[0]) {
    reader.readAsDataURL(input.files[0]);
  }
}

function pay_order(order_id, order_no, order_total) {
  document.getElementById("order_id").value = order_id;
  document.getElementById("order_no").value = order_no;
  document.getElementById("total").value = order_total;
  console.log(order_total);
  document.getElementById("total_order").innerHTML = order_total;

  $("#pay_order").modal("show");
}

const confirm_order = async (ev_form) => {
  var flag = true;
  console.log("test");
  let formD = new FormData($("#" + ev_form)[0]);

  var name_order = document.getElementById("name_order");
  var address_order = document.getElementById("address_order");
  var phone_order = document.getElementById("phone_order");
  var fileInput = document.getElementById("slip_order");

  if (fileInput.files.length < 1) {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดทำการอัพโหลดสลิป",
      icon: "info",
    });
    return false;
  }

  if (name_order.value == "") {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุชื่อนาม-สกุล.",
      icon: "info",
    });
    return false;
  }

  if (address_order.value == "") {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุที่อยู่.",
      icon: "info",
    });
    return false;
  }

  if (phone_order.value == "") {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุเบอร์โทร.",
      icon: "info",
    });
    return false;
  }
  let isItem = await checkStock(formD);
  if (isItem.save) {
    $.ajax({
      url: baseurl + "storefront/confirm_order_last",
      type: "POST",
      dataType: "json",
      processData: false,
      contentType: false,
      data: formD,
      success: (res) => {
        if (res.save == true) {
          Swal.fire({
            title: "ทำการชำระเงินสำเร็จ !",
            icon: "success",
            showConfirmButton: false,
          });
          setTimeout(function () {
            window.location.reload();
          }, 1000);
        }
      },
    });
  } else {
    Swal.fire({
      title: isItem.message,
      icon: "error",
      showConfirmButton: false,
    });
  }
};

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

async function checkStock(formD) {
  let data = { save: false, message: "เกิดข้อผิดพลาด" };
  await $.ajax({
    url: baseurl + "order/check_stock",
    type: "POST",
    dataType: "json",
    processData: false,
    contentType: false,
    data: formD,
    success: (res) => {
      data = res;
    },
  });
  return data;
}