var baseurl = $("meta[name^=baseUrl]").attr("content");

var type_product = document.getElementById("type_product");
var orderby = document.getElementById("orderby");

$(document).ready(function () {
  select("body").classList.toggle("toggle-sidebar");
  AJAX_LOAD_Allproduct("0", "0");
});

type_product.addEventListener("change", function () {
  var val = type_product.value;
  var od = orderby.value;

  AJAX_LOAD_Allproduct(val, od);
});

orderby.addEventListener("change", function () {
  var val = type_product.value;
  var od = orderby.value;

  AJAX_LOAD_Allproduct(val, od);
});

function AJAX_LOAD_Allproduct(val, od) {
  $.ajax({
    url: baseurl + "storefront/get_product_wheretype",
    type: "POST",
    dataType: "json",
    data: { type: val, order: od },
    success: (res) => {
      var div = document.getElementById("list_product");
      div.innerHTML = res.html;
    },
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

function add_cart(element) {
  const product_code = $(element).data("product_code");

  $.ajax({
    url: baseurl + "storefront/add_cart_front",
    type: "POST",
    dataType: "json",
    data: { product_code: product_code },
    success: (res) => {
      if (res.noses == true) {
        Swal.fire({
          title: "โปรดเข้าสู่ระบบ !",
          icon: "error",
          showConfirmButton: false,
        });
        setTimeout(function () {
          window.location.reload();
        }, 1000);
      } else {
        var spanElement = document.getElementById("count_cart_front");
        spanElement.innerHTML = res.count;
      }
    },
  });
}

function view_cart() {
  $.ajax({
    url: baseurl + "storefront/view_cart_front",
    type: "POST",
    dataType: "json",
    success: (res) => {
      var div = document.getElementById("detail_cart");
      div.innerHTML = res.html;
    },
  });
}

function view_cart_c() {
  $("#confirmorder").modal("hide");
  $("#viewcartfront").modal("show");

  $.ajax({
    url: baseurl + "storefront/view_cart_front",
    type: "POST",
    dataType: "json",
    success: (res) => {
      var div = document.getElementById("detail_cart");
      div.innerHTML = res.html;
    },
  });
}

function delete_cart(element) {
  const product_code = $(element).data("product_code");

  Swal.fire({
    title: "ลบสินค้านี้ ?",
    text: "คุณต้องการลบใช่ไหม!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "ใช่",
    cancelButtonText: "ไม่ใช่",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: baseurl + "storefront/delete_cart_front",
        type: "POST",
        dataType: "json",
        data: { product_code: product_code },
        success: (res) => {
          if (res.delete == true) {
            Swal.fire({
              title: "ลบสินค้าสำเร็จ !",
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

const save_cart = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  console.log("save_cart_font");

  $.ajax({
    url: baseurl + "storefront/save_cart_font",
    type: "POST",
    dataType: "json",
    processData: false,
    contentType: false,
    data: formD,
    success: (res) => {
      console.log(res.setcookie);
      if (res.setcookie == true) {
        $("#viewcartfront").modal("hide");
        $("#confirmorder").modal("show");

        document.getElementById("total_order").innerHTML = number_format(
          res.total,
          ".",
          ","
        );
      } else if (res.no == true) {
        Swal.fire({
          title: "ผิดพลาด!",
          text: "คุณยังไม่มีสินค้า.",
          icon: "info",
        });
      }
    },
  });
};

const confirm_order = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  var name_order = document.getElementById("name_order");
  var address_order = document.getElementById("address_order");
  var phone_order = document.getElementById("phone_order");

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

  $.ajax({
    url: baseurl + "storefront/confirm_order",
    type: "POST",
    dataType: "json",
    processData: false,
    contentType: false,
    data: formD,
    success: (res) => {
      if (res.save == true) {
        Swal.fire({
          title: "สั่งซื้อสำเร็จ !",
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

function number_format(number, decimals, decimalSeparator, thousandsSeparator) {
  decimals = typeof decimals !== "undefined" ? decimals : 2;
  decimalSeparator =
    typeof decimalSeparator !== "undefined" ? decimalSeparator : ".";
  thousandsSeparator =
    typeof thousandsSeparator !== "undefined" ? thousandsSeparator : ",";

  var fixedNumber = number.toFixed(decimals);
  var parts = fixedNumber.split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator);

  return parts.join(decimalSeparator);
}

const update_cart = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  if (flag) {
    $.ajax({
      url: baseurl + "storefront/update_cart_front",
      type: "POST",
      dataType: "json",
      processData: false,
      contentType: false,
      data: formD,
      success: (res) => {
        if (res.update == true) {
          Swal.fire({
            title: "แก้ไขตะกร้าสำเร็จ !",
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
};

function clear_cart() {
  $.ajax({
    url: baseurl + "storefront/clear_cart_front",
    type: "POST",
    dataType: "json",
    success: (res) => {
      if (res.clear == true) {
        Swal.fire({
          title: "ล้างตะกร้าสำเร็จ !",
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
