var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
  console.log("setting_store.js");
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

const save_store = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  var store_code = document.getElementById("store_code");
  var store_name = document.getElementById("store_name");
  var store_address = document.getElementById("store_address");
  var store_tel = document.getElementById("store_tel");

  if (
    store_code.value == "" ||
    store_name.value == "" ||
    store_address.value == "" ||
    store_tel.value == ""
  ) {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุข้อมูลให้ครบ.",
      icon: "info",
    });
    return false;
  }

  if (flag) {
    $.ajax({
      url: baseurl + "setting/save_store",
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
