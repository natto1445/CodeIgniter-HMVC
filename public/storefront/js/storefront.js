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

function add_cart() {
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
