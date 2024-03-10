var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
  console.log("report_sale");
});

function get_report() {
  var date_start = document.getElementById("date_start");
  var date_end = document.getElementById("date_end");
  var sale = document.getElementById("sale");

  if (sale.value == 0) {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุพนักงาน.",
      icon: "info",
    });
    return false;
  }

  if (date_start.value == "") {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุวันที่เริมต้น.",
      icon: "info",
    });
    return false;
  }

  if (date_end.value == "") {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุวันที่สิ้นสุด.",
      icon: "info",
    });
    return false;
  }

  $.ajax({
    url: baseurl + "report/get_report_sale",
    type: "POST",
    dataType: "json",
    data: {
      date_start: date_start.value,
      date_end: date_end.value,
      sale: sale.value,
    },
    success: (res) => {
      $("tbody.data_report").html("");
      $("tbody.data_report").html(res.html);
    },
  });
}
