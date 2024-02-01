var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
  console.log("product.js");
  AJAX_LOAD_Allproduct();
});

function AJAX_LOAD_Allproduct() {
  $.post(baseurl + "product/ajax_load_product", function (response) {
    var data = response.split("^");
    $("#product_data").dataTable().fnDestroy();
    $("tbody.data-product").html(data[1]);
    $("#product_data").DataTable();
  });
}

const save = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  var code_type = document.getElementById("code_type");
  var name_product = document.getElementById("name_product");

  if (code_type.value == "0") {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุประเภทสินค้า.",
      icon: "info",
    });
    return false;
  }

  if (name_product.value == "") {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุชื่อสินค้า.",
      icon: "info",
    });
    return false;
  }

  if (flag) {
    $.ajax({
      url: baseurl + "product/add_product",
      type: "POST",
      dataType: "json",
      processData: false,
      contentType: false,
      data: formD,
      success: (res) => {
        if (res.save == true) {
          Swal.fire({
            title: "บันทึกข้อมูลสำเร็จ !",
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

function deleteProduct(id) {
  Swal.fire({
    title: "ลบประเภทสินค้า?",
    text: "คุณต้องการลบประเภทสินค้านี้ใช่ไหม!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "ใช่",
    cancelButtonText: "ไม่ใช่",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: baseurl + "product/del_type",
        type: "POST",
        dataType: "json",
        data: { type_id: id },
        success: (res) => {
          if (res.del == true) {
            Swal.fire({
              title: "สำเร็จ!",
              text: "ทำการลบข้อมูลเรียบร้อย.",
              icon: "success",
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
