var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
  console.log("product.js");
  AJAX_LOAD_Allproduct();

  var price = document.getElementById("price");
  var discount_per = document.getElementById("discount_per");
  var discount_bath = document.getElementById("discount_bath");

  $("#price").on("change", function () {
    const cal = (discount_per.value / 100) * price.value;
    discount_bath.value = cal.toFixed(2);
  });

  $("#discount_per").on("change", function () {
    const cal = (discount_per.value / 100) * price.value;
    discount_bath.value = cal.toFixed(2);
  });

  $("#discount_bath").on("change", function () {
    const cal = (discount_bath.value * 100) / price.value;
    discount_per.value = cal.toFixed(2);
  });

  var Eprice = document.getElementById("Eprice");
  var Ediscount_per = document.getElementById("Ediscount_per");
  var Ediscount_bath = document.getElementById("Ediscount_bath");

  $("#Eprice").on("change", function () {
    const cal = (Ediscount_per.value / 100) * Eprice.value;
    Ediscount_bath.value = cal.toFixed(2);
  });

  $("#Ediscount_per").on("change", function () {
    const cal = (Ediscount_per.value / 100) * Eprice.value;
    Ediscount_bath.value = cal.toFixed(2);
  });

  $("#Ediscount_bath").on("change", function () {
    const cal = (Ediscount_bath.value * 100) / Eprice.value;
    Ediscount_per.value = cal.toFixed(2);
  });
});

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

function Epreviewpic(event) {
  var input = event.target;
  var preview = document.getElementById("EpreviewImage");
  var container = document.getElementById("EimageContainer");

  var previewbarcode = document.getElementById("previewbarcode");
  var barcodeContainer = document.getElementById("barcodeContainer");

  var reader = new FileReader();

  reader.onload = function () {
    preview.src = reader.result;
    preview.style.display = "block";
    container.style.height = "auto";
  };

  reader.onload = function () {
    previewbarcode.src = reader.result;
    previewbarcode.style.display = "block";
    barcodeContainer.style.height = "auto";
  };

  if (input.files && input.files[0]) {
    reader.readAsDataURL(input.files[0]);
  }
}

function cal() {
  var price = document.getElementById("price");
  var discount_per = document.getElementById("discount_per");
  var discount_bath = document.getElementById("discount_bath");

  const cal = (discount_per.value / 100) * price.value;
  discount_bath.value = cal.toFixed(2);
}

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

const edit = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  var code_type = document.getElementById("Ecode_type");
  var name_product = document.getElementById("Ename_product");

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
      url: baseurl + "product/edit_product",
      type: "POST",
      dataType: "json",
      processData: false,
      contentType: false,
      data: formD,
      success: (res) => {
        if (res.update == true) {
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

function editFunction(element) {
  var myImage = document.getElementById("EpreviewImage");
  var previewbarcode = document.getElementById("previewbarcode");

  const id_product = $(element).data("id_product");
  const product_pic = $(element).data("product_pic");
  const barcode = $(element).data("barcode");

  $.ajax({
    url: baseurl + "product/get_product_id",
    type: "POST",
    dataType: "json",
    data: { id_product: id_product },
    success: (res) => {
      var id_product = res.data[0]["id_product"];
      var code_type = res.data[0]["code_type"];
      var cost = res.data[0]["cost"];
      var date_exp = res.data[0]["date_exp"];
      var detail = res.data[0]["detail"];
      var discount_bath = res.data[0]["discount_bath"];
      var discount_per = res.data[0]["discount_per"];
      var minstock = res.data[0]["minstock"];
      var name_product = res.data[0]["name_product"];
      var num = res.data[0]["num"];
      var price = res.data[0]["price"];
      var product_code = res.data[0]["product_code"];
      var status = res.data[0]["status_product"];
      var unit = res.data[0]["unit"];

      document.querySelector("#Eid_product").value = id_product;
      document.querySelector("#Ecode_type").value = code_type;
      document.getElementById("Eproduct_code").value = product_code;
      document.getElementById("Ename_product").value = name_product;
      document.getElementById("Enum").value = num;
      document.getElementById("Eminstock").value = minstock;
      document.getElementById("Ecost").value = cost;
      document.getElementById("Eprice").value = price;
      document.getElementById("Ediscount_per").value = discount_per;
      document.getElementById("Ediscount_bath").value = discount_bath;
      document.getElementById("Eunit").value = unit;
      document.querySelector("#Estatus").value = status;
      document.getElementById("Edate_exp").value = date_exp.split(" ")[0];
      document.getElementById("Edetail").value = detail;
      myImage.src = product_pic;
      previewbarcode.src = barcode;
    },
  });

  $("#editProduct").modal("show");
}

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
        url: baseurl + "product/del_product",
        type: "POST",
        dataType: "json",
        data: { product_id: id },
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


function download_barcode() {

  var product_code = document.getElementById("Eproduct_code");

  var imageSrc = document.getElementById('previewbarcode').src;

  var downloadLink = document.createElement('a');
  downloadLink.href = imageSrc;

  downloadLink.download = 'barcode' + product_code.value + '.jpg';

  document.body.appendChild(downloadLink);

  downloadLink.click();

  document.body.removeChild(downloadLink);
}