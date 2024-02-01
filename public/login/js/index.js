var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
  console.log("login.js");
  select("body").classList.toggle("toggle-sidebar");
});

const select = (el, all = false) => {
  el = el.trim();
  if (all) {
    return [...document.querySelectorAll(el)];
  } else {
    return document.querySelector(el);
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

const login = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  var usr_name = document.getElementById("usr_name");
  var usr_pass = document.getElementById("usr_pass");

  console.log(usr_name.value);
  console.log(usr_pass.value);

  if (usr_name.value == "" || usr_pass.value == "") {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุชื่อผู้ใช้และรหัสผ่าน.",
      icon: "info",
    });
    return false;
  }

  if (flag) {
    $.ajax({
      url: baseurl + "login/check",
      type: "POST",
      dataType: "json",
      processData: false,
      contentType: false,
      data: formD,
      success: (res) => {
        console.log(res);
        if (res.failed == true) {
          Swal.fire({
            title: "ผิดพลาด !",
            text: "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง.",
            icon: "error",
            showConfirmButton: false,
          });
        } else if (res.success == true) {
          Swal.fire({
            title: "สำเร็จ !",
            text: "ยินดีต้อนรับ.",
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
