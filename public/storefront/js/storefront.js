var baseurl = $("meta[name^=baseUrl]").attr("content");

var type_product = document.getElementById("type_product");
var orderby = document.getElementById("orderby");

$(document).ready(function () {
  select("body").classList.toggle("toggle-sidebar");
  AJAX_LOAD_Allproduct("0", "0");
});

type_product.addEventListener("change", function () {
  var val = type_product.value;
  var od = orderby.value;

  AJAX_LOAD_Allproduct(val, od);
});

orderby.addEventListener("change", function () {
  var val = type_product.value;
  var od = orderby.value;

  AJAX_LOAD_Allproduct(val, od);
});

function AJAX_LOAD_Allproduct(val, od) {
  $.ajax({
    url: baseurl + "storefront/get_product_wheretype",
    type: "POST",
    dataType: "json",
    data: { type: val, order: od },
    success: (res) => {
      var div = document.getElementById("list_product");
      div.innerHTML = res.html;
    },
  });
}

const select = (el, all = false) => {
  el = el.trim();
  if (all) {
    return [...document.querySelectorAll(el)];
  } else {
    return document.querySelector(el);
  }
};

function add_cart(element) {
  const product_code = $(element).data("product_code");

  $.ajax({
    url: baseurl + "storefront/add_cart_front",
    type: "POST",
    dataType: "json",
    data: { product_code: product_code },
    success: (res) => {
      var spanElement = document.getElementById("count_cart_front");
      spanElement.innerHTML = res.count;
    },
  });
}
