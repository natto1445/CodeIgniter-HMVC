var baseurl = $("meta[name^=baseUrl]").attr("content");

var type_product = document.getElementById("type_product");
var orderby = document.getElementById("orderby");
var customer = document.getElementById("customer");
var search = document.getElementById("search_product");

$(document).ready(function () {
  console.log(search.value);
  document.getElementById("barcode").focus();
  AJAX_LOAD_Allproduct("0", "0", "");

  $("#customer").select2({
    dropdownParent: $("#viewcart"),
  });

  $("#customer").on("change", function () {
    var customer_id = $(this).val();
    console.log(customer_id);

    $.ajax({
      url: baseurl + "storefront/get_point_customer",
      type: "POST",
      dataType: "json",
      data: { customer_id: customer_id },
      success: (res) => {
        var havepoint = document.getElementById("havepoint");
        havepoint.value = res.point;
      },
    });
  });
});

var inputField = document.getElementById("barcode");

inputField.addEventListener("keyup", function () {
  if (inputField.value.length >= 5) {
    var barcode = document.getElementById('barcode').value;

    $.ajax({
      url: baseurl + "storefront/add_cart_back_barcode",
      type: "POST",
      dataType: "json",
      data: { product_code: barcode },
      success: (res) => {
        if (res.add == true) {
          var spanElement = document.getElementById("count_cart_back");
          spanElement.innerHTML = res.count;

          Swal.fire({
            title: "พบรายการสินค้า !",
            icon: "success",
            showConfirmButton: false,
          });
          setTimeout(function () {
            window.location.reload();
          }, 500);
        }
      },
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  var search = document.getElementById("search_product");
  var val = type_product.value;
  var od = orderby.value;

  if (search) {
    search.addEventListener("keyup", function () {
      if (search.value.length >= 3) {
        $.ajax({
          url: baseurl + "storefront/get_product_wheretype",
          type: "POST",
          dataType: "json",
          data: { type: val, order: od, search_product: search.value },
          success: (res) => {
            var div = document.getElementById("list_product");
            div.innerHTML = res.html;
          },
        });
      } else {
        $.ajax({
          url: baseurl + "storefront/get_product_wheretype",
          type: "POST",
          dataType: "json",
          data: { type: val, order: od, search_product: "" },
          success: (res) => {
            var div = document.getElementById("list_product");
            div.innerHTML = res.html;
          },
        });
      }
    });
  }
});

type_product.addEventListener("change", function () {
  var val = type_product.value;
  var od = orderby.value;

  AJAX_LOAD_Allproduct(val, od, "");
});

orderby.addEventListener("change", function () {
  var val = type_product.value;
  var od = orderby.value;

  AJAX_LOAD_Allproduct(val, od, "");
});

function AJAX_LOAD_Allproduct(val, od, s) {
  $.ajax({
    url: baseurl + "storefront/get_product_wheretype",
    type: "POST",
    dataType: "json",
    data: { type: val, order: od, search_product: s },
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
      var spanElement = document.getElementById("count_cart_back");
      spanElement.innerHTML = res.count;
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

const save_cart = async (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  var customer = document.getElementById("customer");
  var havepoint = document.getElementById("havepoint");
  var usepoint = document.getElementById("usepoint");

  if (parseInt(usepoint.value) > parseInt(havepoint.value)) {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "คะแนนมีไม่เพียงพอ.",
      icon: "info",
    });
    flag = false;
    return false;
  }

  if (customer.value == 0) {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุลูกค้า.",
      icon: "info",
    });
    return false;
  }
  console.log("test");
  if (flag) {
    await Swal.fire({
      title: "บันทึกการสั่งซื้อ ?",
      text: "ทำการบันทึกการสั่งซื้อนี้หรือไม่!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "ใช่",
      cancelButtonText: "ไม่ใช่",
    }).then(async (result) => {
      if (result.isConfirmed) {
        let isItem = await checkStock(formD);
        console.log("isItem");
        if (isItem.save) {
          $.ajax({
            url: baseurl + "storefront/save_cart_back",
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            data: formD,
            success: (res) => {
              if (res.save == true) {
                window.open(baseurl + "order/view_receipt?order=" + res.od_id);
                Swal.fire({
                  title: "บันทึกออเดอร์สำเร็จ !",
                  icon: "success",
                  showConfirmButton: false,
                });
                setTimeout(function () {
                  window.location.reload();
                }, 1000);
              } else if (res.no == true) {
                Swal.fire({
                  title: "ผิดพลาด!",
                  text: "คุณยังไม่มีสินค้า.",
                  icon: "info",
                });
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
      }
    });
  }
};

async function checkStock(formD) {
  let data = { save: false, message: "เกิดข้อผิดพลาด" };
  await $.ajax({
    url: baseurl + "storefront/check_stock_back",
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
