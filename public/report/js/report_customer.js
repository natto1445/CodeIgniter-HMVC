var baseurl = $("meta[name^=baseUrl]").attr("content");

$(document).ready(function () {
  console.log("report_customer");
});

function get_report() {
  var date_start = document.getElementById("date_start");
  var date_end = document.getElementById("date_end");
  var customer = document.getElementById("customer");

  if (customer.value == 0) {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุลูกค้า.",
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
    url: baseurl + "report/get_report_customer",
    type: "POST",
    dataType: "json",
    data: {
      date_start: date_start.value,
      date_end: date_end.value,
      customer: customer.value,
    },
    success: (res) => {
      $("tbody.data_report").html("");
      $("tbody.data_report").html(res.html);
    },
  });
}

function get_report_pdf() {
  var date_start = document.getElementById("date_start");
  var date_end = document.getElementById("date_end");
  var customer = document.getElementById("customer");

  if (customer.value == 0) {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุลูกค้า.",
      icon: "info",
    });
    return false;
  }

  if (date_start.value == '') {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุวันที่เริมต้น.",
      icon: "info",
    });
    return false;
  }

  if (date_end.value == '') {
    Swal.fire({
      title: "ผิดพลาด!",
      text: "โปรดระบุวันที่สิ้นสุด.",
      icon: "info",
    });
    return false;
  }

  var data = {
    date_start: date_start.value,
    date_end: date_end.value,
    customer: customer.value
  };

  var queryString = Object.keys(data).map(key => key + '=' + encodeURIComponent(data[key])).join('&');


  var url = 'get_report_customer_pdf?' + queryString;

  window.open(url, '_blank');
}
