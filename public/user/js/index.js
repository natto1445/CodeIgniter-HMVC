var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
  AJAX_LOAD_AllUser();
});

function AJAX_LOAD_AllUser() {
  $.post(baseurl + "user/ajax_load_user", function (response) {
    var data = response.split("^");
    $("#user_data").dataTable().fnDestroy();
    $("tbody.data-user").html(data[1]);
    $("#user_data").DataTable();
  });
}

const edit = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  var repass = document.getElementById("repass");
  var Eusr_password = document.getElementById("Eusr_password");
  var Eusr_password_c = document.getElementById("Eusr_password_c");

  if (repass.checked) {
    if (Eusr_password.value != Eusr_password_c.value) {
      Swal.fire({
        title: "ผิดพลาด!",
        text: "รหัสผ่านไม่ตรงกัน.",
        icon: "info",
      });
      return false;
    }
  }

  if (flag) {
    $.ajax({
      url: baseurl + "user/edit_user",
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

const save_register = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  var pass = document.getElementById("usr_password");
  var pass_c = document.getElementById("usr_password_c");

  if (pass.value != pass_c.value) {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "รหัสผ่านไม่ตรงกัน.",
      icon: "error",
    });
    return false;
  }

  if (flag) {
    $.ajax({
      url: baseurl + "login/register_user",
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

function editFunction(element) {
  const usr_id = $(element).data("usr_id");
  const usr_name = $(element).data("usr_name");
  const usr_fname = $(element).data("usr_fname");
  const usr_lname = $(element).data("usr_lname");
  const usr_mail = $(element).data("usr_mail");
  const usr_tel = $(element).data("usr_tel");
  const auth = $(element).data("auth");

  document.getElementById("Eusr_id").value = usr_id;
  document.getElementById("Eusr_name").value = usr_name;
  document.getElementById("Eusr_fname").value = usr_fname;
  document.getElementById("Eusr_lname").value = usr_lname;
  document.getElementById("Eusr_mail").value = usr_mail;
  document.getElementById("Eusr_tel").value = usr_tel;

  document.querySelector("#Eauth").value = auth;
  $("#editUser").modal("show");
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
        url: baseurl + "user/del_user",
        type: "POST",
        dataType: "json",
        data: { user_id: id },
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
