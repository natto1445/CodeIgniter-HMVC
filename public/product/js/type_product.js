var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
  console.log("type_product.js");
  AJAX_LOAD_AllType();
});

function AJAX_LOAD_AllType() {
  $.post(baseurl + "product/ajax_load_type", function (response) {
    var data = response.split("^");
    $("#type_data").dataTable().fnDestroy();
    $("tbody.data-type").html(data[1]);
    $("#type_data").DataTable();
  });
}

const save = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  var name_type = document.getElementById("name_type");

  if (name_type.value == "") {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุประเภทสินค้า.",
      icon: "info",
    });
    return false;
  }

  if (flag) {
    $.ajax({
      url: baseurl + "product/add_type",
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

  var Ename_type = document.getElementById("Ename_type");

  if (Ename_type.value == "") {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุประเภทสินค้า.",
      icon: "info",
    });
    return false;
  }

  if (flag) {
    $.ajax({
      url: baseurl + "product/edit_type",
      type: "POST",
      dataType: "json",
      processData: false,
      contentType: false,
      data: formD,
      success: (res) => {
        if (res.update == true) {
          Swal.fire({
            title: "แก้ไขข้อมูลสำเร็จ !",
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
  const id_type = $(element).data("id_type");
  const code_type = $(element).data("code_type");
  const name_type = $(element).data("name_type");
  const status_type = $(element).data("status_type");

  document.getElementById("Eid_type").value = id_type;
  document.getElementById("Ecode_type").value = code_type;
  document.getElementById("Ename_type").value = name_type;
  document.querySelector("#Estatus_type").value = status_type;

  $("#editType").modal("show");
}

function deleteFunction(id) {
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
