var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
  console.log("setting_bank.js");
  AJAX_LOAD_BANK();
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

function AJAX_LOAD_BANK() {
  $.post(baseurl + "setting/ajax_load_bank", function (response) {
    var data = response.split("^");
    $("#bank_data").dataTable().fnDestroy();
    $("tbody.data-bank").html(data[1]);
    $("#bank_data").DataTable();
  });
}

const save = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  var bank_code = document.getElementById("bank_code");
  var bank_name = document.getElementById("bank_name");
  var bank_branch = document.getElementById("bank_branch");
  var bank_owner = document.getElementById("bank_owner");

  if (
    bank_code.value == "" ||
    bank_name.value == "" ||
    bank_branch.value == "" ||
    bank_owner.value == ""
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
      url: baseurl + "setting/save_bank",
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
  var myImage = document.getElementById("EpreviewImage");

  const bank_id = $(element).data("bank_id");
  const bank_code = $(element).data("bank_code");
  const bank_name = $(element).data("bank_name");
  const bank_branch = $(element).data("bank_branch");
  const bank_owner = $(element).data("bank_owner");
  const bank_status = $(element).data("bank_status");
  const bank_pic = $(element).data("bank_pic");

  document.getElementById("Ebank_id").value = bank_id;
  document.getElementById("Ebank_code").value = bank_code;
  document.getElementById("Ebank_name").value = bank_name;
  document.getElementById("Ebank_owner").value = bank_owner;
  document.getElementById("Ebank_branch").value = bank_branch;
  document.querySelector("#Ebank_status").value = bank_status;
  myImage.src = bank_pic;

  $("#editBank").modal("show");
}

const edit = (ev_form) => {
  var flag = true;

  let formD = new FormData($("#" + ev_form)[0]);

  var bank_code = document.getElementById("Ebank_code");
  var bank_name = document.getElementById("Ebank_name");
  var bank_branch = document.getElementById("Ebank_branch");
  var bank_owner = document.getElementById("Ebank_owner");

  if (
    bank_code.value == "" ||
    bank_name.value == "" ||
    bank_branch.value == "" ||
    bank_owner.value == ""
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
      url: baseurl + "setting/edit_bank",
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

function deleteFunction(id) {
  Swal.fire({
    title: "ลบบัญชีธนาคาร?",
    text: "คุณต้องการลบบัญชีธนาคารใช่ไหม!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "ใช่",
    cancelButtonText: "ไม่ใช่",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: baseurl + "setting/del_bank",
        type: "POST",
        dataType: "json",
        data: { bank_id: id },
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
