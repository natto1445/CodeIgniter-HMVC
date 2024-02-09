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

function add_cart(element) {
  const product_code = $(element).data("product_code");

  $.ajax({
    url: baseurl + "storefront/add_cart_back",
    type: "POST",
    dataType: "json",
    data: { product_code: product_code },
    success: (res) => {
      if (res.add == true) {
        setTimeout(function () {
          window.location.reload();
        }, 100);
      }
      // var spanElement = document.getElementById("count_cart");
      // spanElement.innerHTML = res.count;
    },
  });
}

const update_cart = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  if (flag) {
    $.ajax({
      url: baseurl + "storefront/update_cart_back",
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
        url: baseurl + "storefront/delete_cart_back",
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

function view_cart() {
  $.ajax({
    url: baseurl + "storefront/view_cart_back",
    type: "POST",
    dataType: "json",
    success: (res) => {
      console.log(res);
      var div = document.getElementById("detail_cart");
      div.innerHTML = res.html;
    },
  });
}

function clear_cart() {
  $.ajax({
    url: baseurl + "storefront/clear_cart_back",
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

const save_cart = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  if (flag) {
    Swal.fire({
      title: "บันทึกการสั่งซื้อ ?",
      text: "ทำการบันทึกการสั่งซื้อนี้หรือไม่!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "ใช่",
      cancelButtonText: "ไม่ใช่",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: baseurl + "storefront/save_cart_back",
          type: "POST",
          dataType: "json",
          processData: false,
          contentType: false,
          data: formD,
          success: (res) => {
            if (res.save == true) {
              Swal.fire({
                title: "บันทึกออเดอร์สำเร็จ !",
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
};
