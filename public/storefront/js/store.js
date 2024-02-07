var baseurl = $("meta[name^=baseUrl]").attr("content");

var type_product = document.getElementById("type_product");
var orderby = document.getElementById("orderby");

$(document).ready(function () {
  document.getElementById("barcode").focus();
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

function add_cart(id) {
  $.ajax({
    url: baseurl + "storefront/add_cart",
    type: "POST",
    dataType: "json",
    data: {},
    success: (res) => {
      if (res.noses == true) {
        Swal.fire({
          title: "ไม่สำเร็จ!",
          text: "โปรดทำการเข้าสู่ระบบก่อน.",
          icon: "error",
        });
      }
    },
  });
}
